<?php

class Question extends \Eloquent {
	protected $fillable = ['question','type','questionnaire_id'];



    public function questionnaire(){
        return $this->belongsTo('Questionnaire');
    }


}