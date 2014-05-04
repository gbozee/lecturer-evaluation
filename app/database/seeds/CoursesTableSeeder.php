<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CoursesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
        DB::table('courses')->delete();
		foreach(range(1, 10) as $index)
		{
			Course::create([
				'code'=>$faker->numerify($string = '###'),
				'title'=>$faker->sentence($nbWords = 2),
				'units'=>$faker->randomDigit,
				'level'=>$faker->randomElement($array = array ('100','200','300','400','500')),
				'option'=>$faker->randomElement($array = array ('compulsory','elective')) // array('c')
			]);
		}
	}

}