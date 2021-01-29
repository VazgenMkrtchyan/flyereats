@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_remind_password')))

@section('content')

    <h1>{{ trans('front.need_to_reset') }}</h1>

    <!-- Form -->
    {{ Form::open(['route' => 'password.postRemind', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

    <!-- text field for 'Email'-->
    <div class="form-group">
        {{ Form::label('email', trans('front.email').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::email('email', null, ['class' => 'form-control']) }}
        </div>
    </div>

    @if (appCon()->captcha_reset_pass)
        <div class="form-group">
            <div class='col-sm-3 col-md-2 control-label'></div>
            <div class="col-sm-6 col-md-4">
                {{ Recaptcha::render(['callback' => 'recaptchaCallback']) }}
                <input type="hidden" name="hiddenRecaptcha" id="hiddenRecaptcha">
            </div>
        </div>
    @endif

    <div class="form-group margin-t-30">
        <!-- submit for button -->
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
            <button class="btn-main" type="submit">
                {{ trans('front.REMIND') }}
            </button>
        </div>
    </div>

    {{ Form::close() }}
    <!-- End of form -->

@stop


@section('additional-scripts')
    @include('front.password.js.js-remind')
@stop
