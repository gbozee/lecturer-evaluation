<!DOCTYPE html>
<html lang="en" @yield('angular-module')>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lecturer Assessment</title>
    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('css/style.css')}}
    @yield('scripts')
</head>

<body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <ul class="nav navbar-nav">
                    @if(!Auth::guest())  
                    <li>                                  
                        {{HTML::link('logout','Logout')}} </li>
                    @if(Auth::user()->isAdmin())
                        <li>{{HTML::link('admin','Admin')}}</li>
                    @endif
                    @else 
                    <li>{{ HTML::link('login', 'Login') }}</li>
                    <li>{{ HTML::link('register', 'Register') }}</li>
                    @endif                    
                </ul>
            </div>
    </div>

    @if(Session::get('flash_message'))
    <div class="flash">
        {{Session::get('flash_message')}}        
    </div>
    @endif  
    <div class="container">
        @if(Session::has('message'))
        <p class="alert">{{ Session::get('message') }}</p>
        @endif

        @yield('content')    
    </div>

</body>
</html>