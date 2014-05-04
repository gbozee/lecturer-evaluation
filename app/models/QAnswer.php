<?php

class QAnswer extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'q_answers';

    protected $fillable = ['lecturer_id','course_id','user_id','questionnaire_id'];


    public function questionnaire(){
        return $this->hasOne('Questionnaire');
    }



    public function user(){
        return $this->belongsTo('User');
    }

    public function lecturer(){
        return $this->belongsTo('Lecturer')->select(['id','name','assessment_score','opinion_score','comment_score']);
    }

    public function course(){
        return $this->belongsTo('Course')->select(['id','code']);
    }

    public function answers(){
        return $this->hasMany('Answer')->select(['q_answer_id','question_id','answer','score']);
    }

    public static function getUserQuestionnaires($user){
        $result = static::where('user_id','=',$user->id)
                    ->with(array('answers','answers.question','lecturer','course'))
                    ->get(['id','lecturer_id','course_id','completed']);
        return $result;
    }

    public static function populateDefaultResult($input){
        $qa1 = QAnswer::create([
            'user_id' => $input['user_id'],
            'lecturer_id' => $input['lecturer_id'],
            'questionnaire_id'=>$input['questionnaire_id'],
            'course_id'=>$input['course_id'],
            'completed'=>false
        ]);
        $questionnaire = Questionnaire::with('questions')->find($input['questionnaire_id']);
        foreach ($questionnaire->questions as $question) {
            Answer::create([
                'question_id'=>$question->id,
                'answer'=>'',
                'score'=>0,
                'q_answer_id'=>$qa1->id,
            ]);
        }
    }
    public function getCompletedAttribute($completed)
    {
        return (bool) $completed;
    }



}