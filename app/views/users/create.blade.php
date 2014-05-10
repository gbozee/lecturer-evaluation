@extends('layouts.main')

@section('content')
<div class="col-md-4 col-md-offset-4">
	{{ Form::open(array('route'=>'users.store', 'class'=>'form-horizontal' ,'role' => 'form')) }}
    <h2 class="form-signup-heading">Please Register</h2>
 
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
 
 		<div class="form-group">
 			{{Form::label('matric_no','Matric No')}}
 			{{ Form::text('matric_no', null, array('class'=>'form-control', 'placeholder'=>'Matric No')) }}
 			
    </div>

    <div class="form-group">
        {{ Form::label('first_name','First Name') }}
        {{ Form::text('first_name',null,array('class'=>'form-control','placeholder'=>'First Name')) }}
    </div>


    <div class="form-group">
        {{ Form::label('last_name','Last Name') }}
        {{ Form::text('last_name',null,array('class'=>'form-control','placeholder'=>'Last Name') )}}
    </div>

    <div class="form-group">
        {{Form::label('programme','Programme')}}
        {{Form::select('programme', array('Computer Science' => 'Computer Science', 'Industrial Mathematics' => 'Industrial Mathematics',), 'Computer Science')}}
    </div>
    <div class="form-group">
        {{Form::label('department','Department')}}
        {{Form::text('department',"Mathematical Sciences",array('class'=>'form-control','placeholder'=>'Department'))}}
    </div>
    <div class="form-group">
        {{ Form::label('level','Level') }}
        {{Form::select('level', array('100' => '100', '200' => '200','300'=>'300', '400'=>'400','500'=>'500'), '100')}}
    </div>

    <div class="form-group">
    	{{Form::label('email','Email')}}
    	{{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}
    	
    </div>
    <div class="form-group">
    	{{Form::label('password','Password')}}
    	{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
    	
    </div>
    
    {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}
</div>
	
@stop
