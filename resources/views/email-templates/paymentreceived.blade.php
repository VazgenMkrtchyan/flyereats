@extends('email-templates.layout.master')

@section('subject', $subject)

@section('content')
	Dear {{ $user->first_name }}, <br><br>

	thank you for your payment of {{ format_price($payment->amount) }}.
	<br><br>
@stop