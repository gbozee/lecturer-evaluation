<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('matric_no',15)->unique();
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('password');
            $table->string('email')->unique();
            $table->string('remember_token');
            $table->string('programme');
            $table->boolean('is_admin');
            $table->string('department');
            $level = array('100','200','300','400','500');
            $table->enum('level',$level);
            $table->timestamps();
        });

        Schema::create('courses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code',10);
            $table->string('title',50);
            $level = array('100','200','300','400','500');
            $table->enum('level',$level);
            $table->integer('units');
            $type = array('compulsory','elective');
            $table->enum('option',$type);
            $table->timestamps();
        });


        Schema::create('lecturers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name',70);
            $table->decimal('score',8,4);
            $table->double('assessment_score',8,4);
            $table->double('opinion_score',8,4);
            $table->double('comment_score',8,4);
            $table->timestamps();
        });

        Schema::create('questionnaires', function(Blueprint $table) {
            $table->increments('id');
            $table->string('programme');
            $table->enum('semester',array('first','second'));
            $table->string('session',10);
            $table->timestamps();
        });

        Schema::create('questions',function(Blueprint $table){
            $table->increments('id');
            $types = array('comment','assessment','opinion');
            $table->enum('type',$types);
            $table->string('question')->nullable(false);
            $table->integer('questionnaire_id');
//            $table->integer('questionnaire_id')->unsigned();
//            $table->foreign('questionnaire_id')->references('id')->on('questionnaires');
            $table->timestamps();
        });

        Schema::create('q_answers',function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('lecturer_id');
//            $table->integer('lecturer_id')->unsigned();
//            $table->foreign('lecturer_id')->references('id')->on('lecturers');
            $table->integer('questionnaire_id');
//            $table->integer('questionnaire_id')->unsigned();
//            $table->foreign('questionnaire_id')->references('id')->on('questionnaires');
            $table->integer('course_id');
//            $table->integer('course_id')->unsigned();
//            $table->foreign('course_id')->references('id')->on('courses');
            $table->boolean('completed');
            $table->timestamps();
        });

        Schema::create('answers',function(Blueprint $table){
            $table->increments('id');
            $table->integer('question_id');
            $table->string('answer');
            $table->integer('score');
            $table->integer('q_answer_id');
            $table->timestamps();
        });


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('answers');
        Schema::drop('q_answers');
        Schema::drop('questions');
        Schema::drop('questionnaires');
		Schema::drop('courses');
		Schema::drop('lecturers');
        Schema::drop('users');
	}

}
