@extends('email-templates.layout.master')

@section('subject', $subject)

@section('content')
	Thank you for registering at <a href="{{ url('/') }}" target="_blank">{{ url('/') }}</a>. <br><br>
	Your username: <strong>{{ $user->username }}</strong> <br>
	You can login at <a href="{{ route('sessions.create') }}" target="_blank">{{ route('sessions.create') }}</a>
	<br><br>
@stop