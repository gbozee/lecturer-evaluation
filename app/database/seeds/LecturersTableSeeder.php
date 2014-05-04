<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class LecturersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
        DB::table('lecturers')->delete();
        Eloquent::unguard();

        $l1 = Lecturer::create([
            'name'=>$faker->name,
        ]);
        $l1->courses()->attach(1);

        $l2 = Lecturer::create([
            'name'=>$faker->name,
        ]);
        $l2->courses()->attach(2);
        $l2->courses()->attach(3);
        $l2->courses()->attach(9);

        $l3 = Lecturer::create([
            'name'=>$faker->name,
        ]);
        $l3->courses()->attach(4);
        $l3->courses()->attach(3);

        $l4 = Lecturer::create([
            'name'=>$faker->name,
        ]);
        $l4->courses()->attach(5);
        $l4->courses()->attach(1);

        $l5 = Lecturer::create([
            'name'=>$faker->name,
        ]);
        $l5->courses()->attach(7);
        $l5->courses()->attach(8);

        $l6 = Lecturer::create([
            'name'=>$faker->name,
        ]);
        $l6->courses()->attach(6);
        $l6->courses()->attach(2);

//        $courses = Course::all();
//        $courses1 = $courses->first();
//        $courses2 = $courses->last();
//        $lecturers = Lecturer::all();
//        $lecturerA = $lecturers->first();
//        $lecturerA->courses()->attach($courses1->id);
//        $lecturerB = $lecturers->last();
//        $lecturerB->courses()->attach($courses2->id);

	}

}