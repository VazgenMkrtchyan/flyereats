@extends('email-templates.layout.master')

@section('subject', $subject)

@section('content')
    <a href="{{ url('/') }}" target="_blank">{{ url('/') }}</a> website type has been changed.<br>
    <strong>All your listings were archived.</strong> <br>
    You can login at <a href="{{ route('sessions.create') }}" target="_blank">{{ route('sessions.create') }}</a> and <strong>restore</strong> your listings!
    <br><br>
@stop