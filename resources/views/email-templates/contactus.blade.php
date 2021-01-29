@extends('email-templates.layout.master')


@section('content')

	<strong>Name:</strong> {{ $data['name'] }} <br>
	<strong>Subject:</strong> {{ $data['subject'] }} <br>
	<strong>E-mail:</strong> {{ $data['email'] }} <br>
	<strong>Message:</strong> {{ $data['message'] }} <br>

@stop