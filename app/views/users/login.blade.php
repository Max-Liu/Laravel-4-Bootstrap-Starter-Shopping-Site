@extends('layouts.master')
@section('css')
@parent
<link href="/asset/users/css/login.css" rel="stylesheet">
@stop

@section('content')

<form class="form-signin" role="form" method="post" action="/user/login">
    <h2 class="form-signin-heading">Please sign in</h2>
@if (Session::get('error'))
    <p class="bg-danger">{{Session::get('error')}}</p>
@endif
    <input type="email" class="form-control" placeholder="Email address" name="email" required autofocus>
    <input type="password" class="form-control" placeholder="Password" name="password" required>
    <label class="checkbox">
    <input type="checkbox" value="remember-me"> Remember me
    </label>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
@stop