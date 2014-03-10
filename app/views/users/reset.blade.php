@extends('layouts.master')
@section('content')

{{ Form::open(array('action' => 'RemindersController@PostReset')) }}
{{Form::email('email', $value = null, $attributes = array())}}
{{Form::text('password')}}
{{Form::text('password_confirmation')}}
{{Form::hidden('token',$token)}}
{{Form::submit('重置密码')}}
{{ Form::close() }}
@stop
