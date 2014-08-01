<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    {{HTML::style('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}
    {{HTML::style('/asset/main.css')}}
	{{HTML::script('/bower_components/jquery/dist/jquery.min.js')}}
</head>

<body>
<div class="navbar-wrapper">
    <div class="container">
        @if (!Request::is('user/login'))
        <div class="navbar navbar-inverse navbar-static-top" role="navigation">
            @include('partials.header')
        </div>
        @endif
        <div>
            @if (Session::get('error'))
            <li class="bg-danger">{{Session::get('error')}}</li>
            @elseif (Session::get('info'))
            <li class="bg-success">{{Session::get('info')}}</li>
            @endif
        </div>


        <div class="container-fluid">
            <div class="col-sm-12 col-md-12 col-lg-12">
                @yield('content')
            </div>
        </div>
    </div>
</div>


</body>
</html>
