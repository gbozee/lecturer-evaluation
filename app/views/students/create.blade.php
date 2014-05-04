@extends('layouts.main')

@section('content')
<div class="col-md-4 col-md-offset-4">
    {{Form::open(array('route' => 'questions.store', 'class'=>'form-horizontal','role'=>'form'))}}
    <h2 class="form-signin-heading">Create Question</h2>

    <div class="form-group">
        {{Form::label('question','Question')}}
        {{Form::textarea('question',null,array('class' => 'form-control', 'placeholder' => 'Question Content'))}}
        {{ $errors->first('question','<span class="error">:message</span> ') }}
    </div>
    <div class="form-group">
        {{Form::label('type','Question Type')}}
        {{Form::select('type', array('comment' => 'comment', 'assessment' => 'assessment','opinion'=>'opinion'), 'comment')}}
    </div>
    {{ Form::hidden('questionnaire_id',$questionnaire_id) }}
    {{Form::submit('Submit', array('class'=>'btn btn-large btn-primary btn-block'))}}


    {{Form::close()}}

</div>

@stop