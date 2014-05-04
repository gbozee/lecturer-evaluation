<?php

class Answer extends \Eloquent {
	protected $fillable = ['question_id','answer','q_answer_id','score'];

    public function questionnaire(){
        return $this->belongsTo('QuestionnaireAnswer');
    }

    public function question(){
        return $this->belongsTo('Question')->select(['id', 'question', 'type']);
    }

    public static function deleteAllAnswers($questionnaire)
    {
        $answers = static::where('q_answer_id','=',$questionnaire->id)->get();
        foreach ($answers as $answer) {
            $answer->delete();
        }

    }




}