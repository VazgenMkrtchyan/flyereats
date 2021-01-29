@extends('email-templates.layout.master')

@section('subject', $subject)

@section('content')
    Dear {{ $user->first_name }}, <br><br>

    Your Membership Plan has expired.<br><br>
    <br><br>
@stop