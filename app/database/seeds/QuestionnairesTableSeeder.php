<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class QuestionnairesTableSeeder extends Seeder {


	public function run()
	{
        Eloquent::unguard();
        DB::table('questionnaires')->delete();
        DB::table('questions')->delete();

        $questionnaire = Questionnaire::create([
            'programme' => 'Computer Science',
            'semester' => "first",
            'session' => "2013/2014"
        ]);

        Question::create([
            'type'=>'comment',
            'question'=>"Indicate the weekness of the course?",
            'questionnaire_id'=>$questionnaire->id
        ]);
        Question::create([
            'type'=>'opinion',
            'question'=>"The lecturer was punctual in attendance",
            'questionnaire_id'=>$questionnaire->id
        ]);
        Question::create([
            'type'=>'assessment',
            'question'=>"Overall assessment of the lecturer",
            'questionnaire_id'=>$questionnaire->id

        ]);
        Question::create([
            'type'=>'comment',
            'question'=>"indicate the strengths of the lecturer",
            'questionnaire_id'=>$questionnaire->id
        ]);
        Question::create([
            'type'=>'opinion',
            'question'=>"The lecturer explains difficult topics clearly",
            'questionnaire_id'=>$questionnaire->id
        ]);




	}

}