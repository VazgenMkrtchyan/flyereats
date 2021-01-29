@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_edit_profile')))

@section('content')

        <!--email changed notify-->
<div class="alert alert-success" role="alert" id="alert-email-changed" style="display: none">
    {{ trans('front.email_changed') }}
</div>

<!--email changed but need to be confirmed notify-->
<div class="alert alert-warning" role="alert" id="alert-email-change-confirm" style="display: none">
    {{ trans('front.email_change_after') }}
</div>

<h1><i class="fa fa-user"></i> {{ trans('front.your_profile') }}</h1>

<!-- Form -->
{{ Form::model($user, ['route' => 'profile.update', 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'form-val']) }}

        <!-- select box for 'user_group_id'-->
<div class="form-group">
    {{ Form::label('type', trans('front.user_group').': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
    <div class="col-sm-6 col-md-4">
        {{ Form::select('user_group_id', $details['UserGroups'], null, ['class'=>'form-control', 'disabled']); }}
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
        {{ Form::text('username', null, ['class' => 'form-control', 'disabled']) }}
    </div>
</div>

<!-- password -->
<div class="form-group">
    {{ Form::label('password', trans('front.new_password').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
    <div class="col-sm-6 col-md-4">
        {{ Form::password('password', ['class' => 'form-control']) }}
    </div>
</div>

<!-- password confirmation-->
<div class="form-group">
    {{ Form::label('password_confirmation', trans('front.password_confirmation').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
    <div class="col-sm-6 col-md-4">
        {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'Email'-->
<div class="form-group">
    {{ Form::label('email', trans('front.email').': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
    <div class="col-sm-6 col-md-4">
        {{ Form::email('email', null, ['class' => 'form-control', 'disabled']) }}
        <div><a href="#" data-toggle="modal" data-target="#modal-change-email">{{ trans('front.change_email') }}</a></div>
    </div>
</div>

<!-- text field for 'Phone'-->
<div class="form-group">
    {{ Form::label('phone', trans('front.phone').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
    <div class="col-sm-6 col-md-4">
        {{ Form::text('phone', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'state_id'-->
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
    <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
        <div class="checkbox">
            <label>
                {{ Form::checkbox('show_phone', '1', null); }}
                {{ trans('front.show_phone') }}
            </label>
        </div>
    </div>
</div>

<!-- submit button -->
<div class="form-group margin-t-30">
    <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
        <button class="btn-main" type="submit">
            {{ trans('front.UPDATE_PROFILE') }}
        </button>
    </div>
</div>

<!-- Cancel Button -->
<div class="form-group">
    <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
        <a href="{{ route('account_summary') }}">
            <button class="btn-main btn-grey" type="button">
                {{ trans('front.CANCEL') }}
            </button>
        </a>
    </div>
</div>

{{ Form::close() }}
        <!-- End of form -->

@stop

@section('modals')
        <!--modals-->
@include('front.user-profile.partials.modal-change-email')
@stop

@section('additional-scripts')
    @include('front.user-profile.js.js-edit')
@stop