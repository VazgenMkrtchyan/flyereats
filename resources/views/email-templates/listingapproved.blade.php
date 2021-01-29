@extends('email-templates.layout.master')

@section('subject', $subject)

@section('content')
	Your listing (id #{{ $listing->id }}) was successfully approved. <br>
	<strong>Listing URL:</strong> <a href="{{ $listing->present()->seoUrl }}" target="_blank">{{ $listing->present()->seoUrl }}</a>
	<br><br>
@stop