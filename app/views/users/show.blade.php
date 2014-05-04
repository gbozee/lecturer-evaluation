@extends('layouts.main')
@section('angular-module')
    ng-app="app"
@stop

@section('scripts')  
    <script>
        var user = {{ $user }};
        $SERVER_INFO = {
            user:user,
        };
        console.log($SERVER_INFO);
    </script>  
    {{HTML::script('js/lib/jquery.min.js')}}
    {{HTML::style('css/toastr.min.css')}}
    {{HTML::script('js/lib/toastr.min.js')}}
    {{HTML::script('js/lib/lodash.min.js')}}
    {{HTML::script('js/lib/angular.js')}}
    {{HTML::script('js/lib/d3.min.js')}}
    {{HTML::script('js/lib/reusable-chart.js')}}
    {{HTML::script('js/lib/angular-route.js')}}
    {{HTML::script('js/lib/angular-resource.js')}}
    {{HTML::script('js/lib/ui-bootstrap-custom-tpls-0.10.0.min.js')}}
    {{HTML::script('js/app.js')}}
    {{HTML::script('js/services.js')}}
    {{HTML::script('js/directives.js')}}

@stop

@section('content')

<div class="col-md-12">
    <h1>Welcome {{$user->first_name . " ". $user->last_name}} ({{$user->matric_no}})</h1>
</div>
<div ng-view>   
</div>
@stop