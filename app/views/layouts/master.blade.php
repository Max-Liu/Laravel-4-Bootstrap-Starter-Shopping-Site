
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

    <!-- global CSS -->
    @section('css')
    <link href="{{asset('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/asset/main.css')}}" rel="stylesheet">
    @show

	<!-- Custom styles for this template -->
	<!--	<link href="dashboard.css" rel="stylesheet">-->

	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

	<![endif]-->
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
            @endif
            @foreach($errors->all('<li class="bg-danger">:message</li>') as $message)
                    {{$message}}
            @endforeach
        </div>

        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
