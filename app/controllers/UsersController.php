<?php

class UsersController extends \BaseController {
        /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
        return View::make('users.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        // $programmes = Programme::orderBy('name')->lists('name','id');
		// return View::make('users.create',compact('programmes'));
		return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		 $validator = Validator::make($input = Input::all(),
		 	['matric_no'=>'required','password'=>'required','email'=>'required']);
        if($validator->fails())
            return Redirect::back()
                ->withInput()
                ->withErrors($validator->messages);

		 
		$user = User::create($input);		 
	
		Auth::login($user);
		
     	return Redirect::route('users.show',array('id'=>$user->id))
				->with('flash_message','Welcome new user!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::with('courses')->find($id);
//		$courses = Course::with('lecturers')->where('level','<=',$user->level)->get();
		$questionnaire = Questionnaire::with('questions')->first();
//        $q_results = QuestionnaireAnswer::where('user_id','=',$id)->get();
        return View::make('users.show',compact('user','questionnaire'));
	
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		
		return View::make('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}