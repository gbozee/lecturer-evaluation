<?php

class Questionnaire extends \Eloquent {
	protected $fillable = ['programme','semester','session'];

    public static $rules = [
        'programme' => 'required',
        'semester' => 'required',
		'session' => 'required'
    ];

    public function questions(){
        return $this->hasMany('Question');
    }


}