<h3 class="header smaller lighter red">
    {{ trans('back.user_settings') }}
</h3>

<!-- select box for 'user_group_id'-->
<div class="form-group">
    {{ Form::label('user_group_id', trans('back.user_group').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('user_group_id', ['' => trans('back.-user_group-')] + $details['UserGroups'], null, ['class'=>'form-control']); }}
    </div>
</div>


@if (appCon()->membershipPlansBased())

    <div class="form-group"><!-- select box for 'membership_plan_id'-->
        {{ Form::label('membership_plan_id', trans('back.membership_plan').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
        <div class="col-xs-10 col-sm-5">
            {{ Form::select('membership_plan_id', ['' => trans('back.-select_user_group-')], null, ['class'=>'form-control']); }}
        </div>
    </div>

    <div id="expiration-settings" style="display: none;">

        <div class="form-group load-settings">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="button" class="btn btn-white btn-pink btn-inverse btn-sm" id="loadMembershipPlan" disabled="disabled" value="{{ $user->membership_plan_id or '' }}">{{ trans('back.load_membership_plan_settings') }}</button>
                <img src="{{ asset('templates/misc/loadingAJAX.gif') }}" style="width: 25px; display: none" id="membershipPlanApiLoading">
                <span id="membershipPlanLoaded" style="color: green; display: none;">{{ trans('back.membership_plan_settings_loaded') }}</span>
            </div>
        </div>

        <!-- text field for 'expires_on'-->
        <div class="form-group">
            {{ Form::label('expires_on', trans('back.expiration_date').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
            <div class="col-xs-10 col-sm-5">
                <div class="input-group">
                    {{ Form::text('expires_on',
                    (isset($user) AND $user->expires_on) ? $user->expires_on->format('Y-m-d') : null,
                    ['class' => 'form-control date-picker', 'data-date-format' => 'yyyy-mm-dd']) }}

                    <span class="input-group-addon">
			<i class="fa fa-calendar bigger-110"></i>
			</span>
                </div>
                ({{ trans('back.leave_empty_to_never_expire') }})
            </div>
        </div>

    </div>

@endif


<div class="form-group"><!-- select box for 'st_moderation'-->
    {{ Form::label('st_moderation', trans('back.moderation_status').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('st_moderation', [
        'approved' => trans('back.approved'),
        'pending' => trans('back.pending'),
        'rejected' => trans('back.rejected')
        ], null, ['class'=>'form-control']); }}
    </div>
</div>


<h3 class="header smaller lighter green">
    {{ trans('back.user_details') }}
</h3>


<!-- text field for 'First_name'-->
<div class="form-group">
    {{ Form::label('first_name', trans('back.first_name').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('first_name', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'Last_name'-->
<div class="form-group">
    {{ Form::label('last_name', trans('back.last_name').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('last_name', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'Username'-->
<div class="form-group">
    {{ Form::label('username', trans('back.username').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('username', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'Password'-->
<div class="form-group">
    {{ Form::label('password', trans('back.password').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::password('password', ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'Password_confirmation'-->
<div class="form-group">
    {{ Form::label('password_confirmation', trans('back.password_confirmation').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'Email'-->
<div class="form-group">
    {{ Form::label('email', trans('back.email').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('email', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- select box for 'email_confirmed'-->
<div class="form-group">
    {{ Form::label('st_email_confirmed', trans('back.email_status').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('st_email_confirmed', [
        '1' => trans('back.confirmed'),
        '0' => trans('back.unconfirmed')
        ], null, ['class'=>'form-control']); }}
    </div>
</div>

<!-- text field for 'Phone'-->
<div class="form-group">
    {{ Form::label('phone', trans('back.phone').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('phone', null, ['class' => 'form-control']) }}
    </div>
</div>


<h3 class="header smaller lighter purple">
    {{ trans('back.user_address') }}
</h3>

<!-- select box for 'state_id'-->
<div class="form-group">
    {{ Form::label('state_id', appCon()->locality . ': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('state_id', ['' => trans('fromDB.-select_state-')] + $details['States'], null, ['class'=>'form-control']); }}
    </div>
</div>

<!-- text field for 'city'-->
<div class="form-group">
    {{ Form::label('city', trans('back.city').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('city', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'addr_1'-->
<div class="form-group">
    {{ Form::label('addr_1', trans('back.address_line').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('addr_1', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'Zip'-->
<div class="form-group">
    {{ Form::label('zip', appCon()->zip_format . ': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('zip', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- check box 'show_phone'-->
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <div class="checkbox">
            <label>
                {{ Form::checkbox('show_phone', '1', null, ['class' => 'ace']); }}
                <span class="lbl"> {{ trans('back.show_user_phone_info') }}</span>
            </label>
        </div>
    </div>
</div>


<div class="clearfix form-actions">
    <div class="col-sm-offset-3 col-sm-9">
        <!-- submit button -->
        <button class="btn btn-info" type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            {{ trans('back.submit') }}
        </button>

        &nbsp; &nbsp; &nbsp;

        <!-- cancel button -->
        <a href="{{ route('admin.users.index', Session::get('user_search_url')) }}">
            <button class="btn btn-danger" type="button">
                <i class="ace-icon fa fa-times bigger-110"></i>
                {{ trans('back.cancel') }}
            </button>
        </a>

    </div>
</div>


@section('additional-scripts')
    @include('admin.users.js.js-create-edit')
@stop