@extends('email-templates.layout.master')

@section('subject', $subject)

@section('content')
	Dear {{ $user->first_name }}, <br><br>

	Your account at <a href="{{ url('/') }}" target="_blank">{{ url('/') }}</a> has been approved. You may login at: <br>
	<a href="{{ route('sessions.create') }}" target="_blank">{{ route('sessions.create') }}</a>
	<br><br>
@stop