<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class QAnswersTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();
        DB::table('q_answers')->delete();

        $user = User::find(1);
        $questionnaire = Questionnaire::with('questions')->find(1);

        User::DefaultQuestionnaireResult($user->id,$questionnaire);


    }

}