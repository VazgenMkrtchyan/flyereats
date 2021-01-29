@extends('email-templates.layout.master')

@section('subject', 'Password Reset')

@section('content')
	To reset your password, complete this form: <br>
	<a href="{{ URL::to('password/reset', array($token)) }}" target="_blank">{{ URL::to('password/reset', array($token)) }}</a>.
	<br><br>
@stop