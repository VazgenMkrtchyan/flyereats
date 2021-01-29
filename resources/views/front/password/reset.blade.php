@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_reset_password')))

@section('content')

<h1>{{ trans('front.reset_password') }}</h1>

<!-- Form -->
{{ Form::open(['route' => 'password.postReset', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

{{ Form::hidden('token', $token) }}

<!-- text field for 'Email'-->
<div class="form-group">
	{{ Form::label('email', trans('front.email').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
	<div class="col-sm-6 col-md-4">
		{{ Form::email('email', null, ['class' => 'form-control']) }}
	</div>
</div>

<!-- text field for 'Password'-->
<div class="form-group">
	{{ Form::label('password', trans('front.password').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
	<div class="col-sm-6 col-md-4">
		{{ Form::password('password', ['class' => 'form-control']) }}
	</div>
</div>

<!-- text field for 'Password_confirmation'-->
<div class="form-group">
	{{ Form::label('password_confirmation', trans('front.password_confirmation').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
	<div class="col-sm-6 col-md-4">
		{{ Form::password('password_confirmation', ['class' => 'form-control']) }}
	</div>
</div>

<!-- submit for button -->
<div class="form-group margin-t-30">
    <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
        <button class="btn-main" type="submit">
            {{ trans('front.RESET_PASSWORD') }}
        </button>
    </div>
</div>

{{ Form::close() }}
<!-- End of form -->

@stop


@section('additional-scripts')
    @include('front.password.js.js-reset')
@stop