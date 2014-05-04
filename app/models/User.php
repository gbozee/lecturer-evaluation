<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    protected $fillable = ['matric_no','password','email','level','first_name','last_name','programme','department'];

    public function questionnaires(){
        return $this->hasMany('QAnswer');
    }

    public function courses(){
        return $this->belongsToMany('Course');
    }


    public static function courseDoesNotExists($array,$id){
        foreach($array as $course){
            if($course->id == (int)$id){
                return false;
            }
        }
        return true;
    }

    public static $rules = [
        'matric_no' => 'required',
        'email' => 'required',
        'password' => 'required'
    ];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

    public function isAdmin(){
        return $this->is_admin;
    }

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

    public function isValid(){
        $validation = Validator::make($this->attributes,static::$rules);

        if($validation->passes()){
            return true;
        }
        $this->errors = $validation->messages();
        return false;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

    public function getLecturers(){
        $result = $result = Lecturer::join('course_lecturer','course_lecturer.lecturer_id','=','lecturers.id')
            ->leftJoin('course_user','course_user.course_id','=','course_lecturer.course_id')
            ->where('course_user.user_id','=',$this->id)->groupBy('lecturers.name')->get(['name','score']);

        return $result;
    }

    public static  function DefaultQuestionnaireResult($index,$questionnaire){
        $temp_user = static::find($index);
        $user_courses = $temp_user->courses()->with('lecturers')->get();
        foreach ($user_courses as $course) {
            User::createQuestionnaireForCourse($course,$temp_user->id,$questionnaire->id);
        }

    }

    public static function createQuestionnaireForCourse($course,$user_id,$questionnaire_id){
        foreach ($course->lecturers as $lecturer) {
            $input = [
                'user_id' => $user_id,
                'lecturer_id' => $lecturer->id,
                'questionnaire_id'=>$questionnaire_id,
                'course_id'=>$course->id,
            ];
            QAnswer::populateDefaultResult($input);

        }
    }

    static public function addCourse($user,$courses){
        foreach ($courses as $course_id) {
            if(User::courseDoesNotExists($user->courses,$course_id)){
                $course = Course::with('lecturers')->find($course_id);
                $user->courses()->attach($course->id);
                $questionnaire = Questionnaire::with('questions')->first();
                User::createQuestionnaireForCourse($course,$user->id,$questionnaire->id);
            }
        }
    }

    static public function removeCourse($user,$course_id){
        var_dump($course_id);
        $user->courses()->detach((int)$course_id);
        $q_for_course = QAnswer::where('user_id','=',$user->id)->where('course_id','=',$course_id)->get();
        foreach ($q_for_course as $q) {
            Answer::deleteAllAnswers($q);
            $q->delete();
        }
    }
}