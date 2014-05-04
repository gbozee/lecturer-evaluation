<?php

class Questionnaire extends \Eloquent {
	protected $fillable = ['question','type'];

    public static $rules = [
        'question' => 'required',
        'type' => 'required'
    ];

    public function questions(){
        return $this->hasMany('Question');
    }


}