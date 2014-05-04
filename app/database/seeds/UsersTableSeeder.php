<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

        DB::table('users')->delete();

        Eloquent::unguard();
        DB::table('users')->delete();

			$abiola = User::create([
                'matric_no'=>'070407043',
                'first_name'=>'abiola',
                'last_name'=>'oyeniyi',
                'is_admin' =>true,
                'level'=>'300',
                'programme' => 'Computer Science',
                'department' => 'Mathematical Sciences',
                'email'=>'gbozee@gmail.com',
                'password'=>'1234'
			]);
//            User::addCourse($abiola,[1,2,3,9]);
//			$abiola->courses()->attach(1);
//			$abiola->courses()->attach(2);
//			$abiola->courses()->attach(3);
//			$abiola->courses()->attach(9);

			$u2 = User::create([
                'matric_no'=>'070407044',
                'first_name'=>'tola',
                'last_name'=>'oyeniyi',
                'level'=>'400',
                'programme' => 'Computer Science',
                'department' => 'Mathematical Sciences',
                'email'=>'tolly@gmail.com',
                'password'=>'1234'
			]);

//        User::addCourse($u2,[3,4,8]);
//            $u2->courses()->attach(3);
//            $u2->courses()->attach(4);
//            $u2->courses()->attach(8);

			$u3 = User::create([
                'matric_no'=>'070407048',
                'first_name'=>'tomi',
                'last_name'=>'oyeniyi',
                'level'=>'200',
                'programme' => 'Computer Science',
                'department' => 'Mathematical Sciences',
                'email'=>'tmosco@gmail.com',
                'password'=>'1234'
			]);
//        User::addCourse($u3,[5,6,7,1]);
//            $u3->courses()->attach(5);
//            $u3->courses()->attach(6);
//            $u3->courses()->attach(7);
//            $u3->courses()->attach(1);

	}

}