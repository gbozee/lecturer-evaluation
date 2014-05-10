@extends('layouts.main')


@section('scripts')  
    @yield('custom_scripts')
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
    @yield('custom_angular_script')
@stop

