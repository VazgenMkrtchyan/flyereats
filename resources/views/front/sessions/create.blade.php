@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_sign_in')))

@section('content')

    @if (Session::has('inactiveUser'))
        @include('front.sessions.partials.alert-account-inactive')
    @endif

    @if (Session::has('registeredUser'))
        @include('front.sessions.partials.alert-registration-success')
    @endif

    @if(demo_mode_on())
        <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>

            <p class="text-center">
                <strong>{{ trans('back.demo_credentials') }}:</strong><br>
                {{ trans('back.username') }}: user<br>
                {{ trans('back.password') }}: user
            </p>
        </div>
    @endif

    <h1>{{ trans('front.login_to_acc') }}</h1>

    <!-- Form -->
    {{ Form::open(['route' => 'sessions.store', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

            <!-- text field for 'Username'-->
    <div class="form-group">
        {{ Form::label('username', trans('front.username').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::text('username', null, ['class' => 'form-control']) }}
        </div>
    </div>

    <!-- password -->
    <div class="form-group">
        {{ Form::label('password', trans('front.password').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::password('password', ['class' => 'form-control']) }}
        </div>
    </div>

    @if (appCon()->captcha_user_login)
        <div class="form-group">
            <div class='col-sm-3 col-md-2 control-label'></div>
            <div class="col-sm-6 col-md-4">
                {{ Recaptcha::render(['callback' => 'recaptchaCallback']) }}
                <input type="hidden" name="hiddenRecaptcha" id="hiddenRecaptcha">
            </div>
        </div>
    @endif


    <div class="form-group">
        <!-- check box 'Remember_me'-->
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-9">
            <a href="{{ route('password.getRemind') }}">{{ trans('front.forgot_password') }}</a>
        </div>
    </div>


    <!-- submit for button -->
    <div class="form-group margin-t-30">
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
            <button class="btn-main" type="submit">
                {{ trans('front.LOGIN') }}
            </button>
        </div>
    </div>


    {{ Form::close() }}

@stop


@section('additional-scripts')
    @include('front.sessions.js.js-create')
@stop