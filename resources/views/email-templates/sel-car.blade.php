@extends('email-templates.layout.master')


@section('content')

	<strong>Vehicle type:</strong> {{ $data['type'] }} <br>
	<strong>Make:</strong> {{ $data['make'] }} <br>
	<strong>Model:</strong> {{ $data['model'] }} <br>
	<strong>Vehicle registration:</strong> {{ $data['registration'] }} <br>
	<strong>Mileage:</strong> {{ $data['mile'] }} <br>
	<strong>Service history:</strong> {{ $data['history'] }} <br>
	<strong>Name:</strong> {{ $data['name'] }} <br>
	<strong>Phone:</strong> {{ $data['phone'] }} <br>
	<strong>E-mail:</strong> {{ $data['email'] }} <br>

@stop