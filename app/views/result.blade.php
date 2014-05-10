@extends('layouts.angular')

@section('angular-module')
    ng-app="result"
@stop


@section('custom_scripts')  
    <script>
    	var LEResults = {{$lecturers}};
       console.log(LEResults);
    </script> 
    @section('custom_angular_script')
    	{{HTML::script('js/result.js')}}
    @stop     
    
@stop

@section('content')


<div class="col-md-12">
    <h1>All Lecturers Evaluation Graph</h1>
</div>
<div>
	<div ng-controller="ResultCtrl">
    <chart value="myChart" type="Bar"></chart>
</div>   
</div>
@stop