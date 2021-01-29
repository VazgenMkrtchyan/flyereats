@extends('email-templates.layout.master')

@section('subject', $subject)

@section('content')
	To change your email, click on the link below: <br>
	<a href="{{ route('email.confirm', $token) }}" target="_blank">{{ route('email.confirm', $token) }}</a>
	<br><br>
@stop