@extends('email-templates.layout.master')

@section('subject', $subject)

@section('content')
	<strong>Name:</strong> {{ $data['name'] }} <br>
	<strong>E-mail:</strong> {{ $data['email'] }} <br>

	<strong>Message:</strong> {{ $data['message'] }}
	<br><br>
	<strong>Listing URL:</strong> <a href="{{ $listing->present()->seoUrl }}" target="_blank">{{ $listing->present()->seoUrl }}</a>
	<br><br>
@stop