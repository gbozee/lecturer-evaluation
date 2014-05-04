<?php

class Course extends \Eloquent {
	protected $fillable = ['code','title','units','level','option'];

    public function lecturers(){
        return $this->belongsToMany('Lecturer');
    }

    public function programmes(){
        return $this->belongsToMany('Programme');
    }
}