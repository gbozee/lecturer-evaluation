@extends('layouts.main')

@section('content')
<div class="col-md-4 col-md-offset-4">
    {{Form::open(array('route' => 'sessions.store', 'class'=>'form-horizontal','role'=>'form'))}}
    <h2 class="form-signin-heading">Please Login</h2>

    <div class="form-group">
        {{Form::label('matric_no','Matric No')}}
        {{Form::text('matric_no',null,array('class' => 'form-control', 'placeholder' => 'Matric No'))}}
    </div>
    <div class="form-group">
        {{Form::label('password','Password')}}
        {{Form::password('password',array('class'=>'form-control', 'placeholder'=>'Password')) }}
    </div>
    {{Form::submit('login', array('class'=>'btn btn-large btn-primary btn-block'))}}


    {{Form::close()}}

</div>

@stop