@extends('email-templates.layout.master')

@section('subject', $subject)

@section('content')
	To confirm your account, click on the link below: <br>
	<a href="{{ route('account.confirm', $token) }}" target="_blank">{{ route('account.confirm', $token) }}</a>
	<br><br>
@stop