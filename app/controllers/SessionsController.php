<?php

class SessionsController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('sessions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//validate
		// $input = Input::all();
		$user = array(
			'matric_no' => Input::get('matric_no'),
			'password' => Input::get('password'),
		);
	
		$attempt = Auth::attempt($user);

		if($attempt)
			// return Redirect::intended('/')
			return Redirect::route('users.show',array('id'=>Auth::user()->id))
				->with('flash_message','You have been logged in!');

		return Redirect::back()->withInput()->with('flash_message','Invalid credentials');
	}


	
	public function destroy()
	{
		Auth::logout();

		return Redirect::route('users.index')
			->with('flash_message','You have been logged out!');
	}

}