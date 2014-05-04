<?php

class Lecturer extends \Eloquent {
	protected $fillable = ['name','assessment_score','opinion_score','comment_score'];

    public function courses(){
        return $this->belongsToMany('Course');
    }

    public function  updateScore($score){
        $this->score = $this->score + $score;
        $this->save();
    }
}