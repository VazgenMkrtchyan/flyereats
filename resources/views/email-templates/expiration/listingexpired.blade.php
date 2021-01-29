@extends('email-templates.layout.master')

@section('subject', $subject)

@section('content')
    Dear {{ $user->first_name }}, <br><br>

    Your listing (id #{{ $listing->id }}) has expired.<br><br>
    <strong>Listing URL:</strong> {{ $listing->present()->seoUrl }}
    <br><br>
@stop