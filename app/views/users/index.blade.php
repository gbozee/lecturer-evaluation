@extends('layouts.main')

@section('content')
<div class="jumbotron">
    <h1>Welcome to Lecturer Evaluation</h1>
</div>
<div class="well">
@if(Auth::check())
    <a class="btn-primary btn btn-lg" href="/users/{{Auth::user()->id}}">Begin Evaluation</a>
    
@else
    <a href="/login" class="btn-primary btn bnt-lg">Login</a>
@endif
</div>

@stop