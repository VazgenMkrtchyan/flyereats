@extends('email-templates.layout.master')

@section('subject', $subject)

@section('content')
    Dear {{ $user->first_name }}, <br><br>

    Your Membership Plan will expire in 7 days.<br><br>
    <br><br>
@stop