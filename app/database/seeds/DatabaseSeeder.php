<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('CoursesTableSeeder');
		 //$this->call('LecturersTableSeeder');
		 //$this->call('QuestionnairesTableSeeder');
		 $this->call('UsersTableSeeder');
//         $this->call('QAnswersTableSeeder');
	}

}