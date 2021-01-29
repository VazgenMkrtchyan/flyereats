@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_create_account')))

@section('content')

    <h1><i class="fa fa-user-plus"></i> {{ trans('front.registration_form') }}</h1>

    <!-- Form -->
    {{ Form::open(['route' => 'register.post', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

    <!-- select box for 'user_group_id'-->
    <div class="form-group">
        {{ Form::label('user_group_id', trans('front.user_group').': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::select('user_group_id', ['' => trans('front.-select-')] + $details['UserGroups'], null, ['class'=>'form-control']); }}
        </div>
    </div>

    <!-- text field for 'First_name'-->
    <div class="form-group">
        {{ Form::label('first_name', trans('front.first_name').': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::text('first_name', null, ['class' => 'form-control']) }}
        </div>
    </div>

    <!-- text field for 'Last_name'-->
    <div class="form-group">
        {{ Form::label('last_name', trans('front.last_name').': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::text('last_name', null, ['class' => 'form-control']) }}
        </div>
    </div>

    <!-- text field for 'Username'-->
    <div class="form-group">
        {{ Form::label('username', trans('front.username').': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::text('username', null, ['class' => 'form-control']) }}
        </div>
    </div>

    <!-- password -->
    <div class="form-group">
        {{ Form::label('password', trans('front.password').': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::password('password', ['class' => 'form-control']) }}
        </div>
    </div>

    <!-- password confirmation-->
    <div class="form-group">
        {{ Form::label('password_confirmation', trans('front.password_confirmation').': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
        </div>
    </div>

    <!-- text field for 'Email'-->
    <div class="form-group">
        {{ Form::label('email', trans('front.email').': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::email('email', null, ['class' => 'form-control']) }}
        </div>
    </div>

    <!-- text field for 'Phone'-->
    <div class="form-group">
        {{ Form::label('phone', trans('front.phone').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::text('phone', null, ['class' => 'form-control']) }}
        </div>
    </div>

    <!-- select box for 'state_id'-->
    <div class="form-group">
        {{ Form::label('state_id', appCon()->locality . ': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::select('state_id', ['' => '-SELECT STATE-'] + $details['States'], null, ['class'=>'form-control']); }}
        </div>
    </div>

    <!-- text field for 'city'-->
    <div class="form-group">
        {{ Form::label('city', trans('front.city').': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::text('city', null, ['class' => 'form-control']) }}
        </div>
    </div>

    <!-- text field for 'addr_1'-->
    <div class="form-group">
        {{ Form::label('addr_1', trans('front.address_line').': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::text('addr_1', null, ['class' => 'form-control']) }}
        </div>
    </div>

    <!-- text field for 'Zip'-->
    <div class="form-group">
        {{ Form::label('zip', appCon()->zip_format . ': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::text('zip', null, ['class' => 'form-control']) }}
        </div>
    </div>

    <!-- check box 'Show_phone'-->
    <div class="form-group">
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-9">
            <div class="checkbox">
                <label>
                    {{ Form::checkbox('show_phone', '1', null); }}
                    {{ trans('front.show_phone') }}
                </label>
            </div>
        </div>
    </div>


    @if (appCon()->captcha_register)
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
                {{ trans('front.REGISTER') }}
            </button>
        </div>
    </div>


    {{ Form::close() }}
    <!-- End of form -->

@stop


@section('additional-scripts')
    @include('front.register.js.js-create')
@stop