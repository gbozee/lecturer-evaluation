<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//Event::listen('illuminate.query',function($query){
//    var_dump($query);
//});
Route::group(array('before' => 'auth'), function()
{
  Route::resource('questionnaires','QuestionnairesController');
  
  // ...
});

Route::get('sampledata',function(){

    return Course::with('lecturers')->get();
});
Route::get('/testing',function(){
    $user = User::first();
    $u_questionnaire = QAnswer::getUserQuestionnaires($user);
    $reg_courses = Course::where('level','<=',$user->level)->get(['code','title','level']);
    $courses = $user->courses()->with('lecturers')->get();
    return $u_questionnaire;
//    return $user->with('courses')->get();
});
Route::get('questionnaire_result/{id}',function($id){
    $user = User::find($id);
    return $user->getLecturers();
});
Route::post('/saveResult/{id}',function($questionnaire_id){
    $questionnaire = QAnswer::find($questionnaire_id);
    $lecturer = Lecturer::find(Input::get('lecturer_id'));
    $q_answers = Answer::where('q_answer_id',"=",$questionnaire->id)->get();
    $answers = Input::get('answers');

    for ($x=0; $x<$q_answers->count(); $x++) {
        $q_answers[$x]->update([
            'question_id'=>$answers[$x]['question_id'],
            'answer' => $answers[$x]['answer'],
            'score' => $answers[$x]['score']
        ]);
    }
    $questionnaire->completed = Input::get('completed');
    $questionnaire->save();
    $score = $questionnaire->answers()->sum('score');
    $lecturer->updateScore($score);
    return $questionnaire;

});
Route::get('questionnaire-details/{id}',function($id){
    $user = User::find($id);
    $questionnaires = QAnswer::getUserQuestionnaires($user);
    return $questionnaires;
});
Route::get('serverInfo/{id}',function($id){
    $user = User::with('courses')->find($id);
    $q = Questionnaire::with('questions')->first();

    $courses = Course::with('lecturers')->
		where('level','<=',$user->level)->
		get(['id','units','code','option','title','level']);
//    $questionnaires = QAnswer::getUserQuestionnaires($user);

    $response['user'] = json_decode($user->toJson());
    $response['courses']=json_decode($courses->toJson());
    $response['questionnaire']=json_decode($q->toJson());
    return Response::json($response);
});
Route::get('users/{id}/register/{course}',function($id,$course){
    $user = User::find($id);
    User::addCourse($user,[$course]);

    return Response::json(array('success'=>true));
});
Route::get('users/{id}/unregister/{course_id}',function($id,$course_id){
    $user = User::find($id);
    User::removeCourse($user,$course_id);
    return Response::json(array('success'=>true));
});
Route::get('/login','SessionsController@create');
Route::get('/logout','SessionsController@destroy');
Route::get('/register','UsersController@create');
Route::get('/','UsersController@index');
Route::resource('users','UsersController',array('only'=>array('index','create','store','show','destroy')));
Route::resource('sessions','SessionsController',array('only' =>array('index','create','store','destroy')));

Route::get('lecturers_result', array('before' => 'admin','as' => 'evalutaion', function()
{
    $lecturers = Lecturer::all();
    return View::make('result',compact('lecturers'));
}));

Route::get('admin_login',array('as'=>'admin_login',function(){
    return View::make('admin.create');
}));

