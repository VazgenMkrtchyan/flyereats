<!-- User Group Info -->
<div class="form-group">
    {{ Form::label('user_group_id', trans('back.plan_for_user_group').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
            {{ Form::select('user_group_id',
            ['' => trans('back.-select_user_group-')] + $details['UserGroups'],
            null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'Name'-->
<div class="form-group">
    {{ Form::label('name', trans('back.membership_plan_name').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'description'-->
<div class="form-group">
    {{ Form::label('description', trans('back.description').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) }}
    </div>
</div>

<!-- text field for 'price'-->
<div class="form-group">
    {{ Form::label('price', trans('back.price').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('price', null, ['class' => 'form-control']) }}
        ({{ trans('back.enter_0_for_free') }})
    </div>
</div>

<!-- text field for 'duration'-->
<div class="form-group">
    {{ Form::label('duration', trans('back.duration_days').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('duration', null, ['class' => 'form-control']) }}
        ({{ trans('back.enter_0_for_unlimited') }})
    </div>
</div>

<!-- text field for 'max_listings'-->
<div class="form-group">
    {{ Form::label('max_listings', trans('back.max_listings').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('max_listings', null, ['class' => 'form-control']) }}
        ({{ trans('back.enter_0_for_unlimited') }})
    </div>
</div>

<!-- text field for 'max_photos'-->
<div class="form-group">
    {{ Form::label('max_photos', trans('back.max_pictures').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('max_photos', null, ['class' => 'form-control']) }}
        ({{ trans('back.enter_0_for_unlimited') }})
    </div>
</div>

<!-- text field for 'order'-->
<div class="form-group">
    {{ Form::label('order', trans('back.order').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('order', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- check box 'auto_conf'-->
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <div class="checkbox">
            <label>
                {{ Form::checkbox('auto_conf', '1', null, ['class' => 'ace']); }}
                <span class="lbl"> {{ trans('back.automatically_confirm_listing_membership') }}</span>
            </label>
        </div>
    </div>
</div>

<!-- check box 'usable_once'-->
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <div class="checkbox">
            <label>
                {{ Form::checkbox('usable_once', '1', null, ['class' => 'ace']); }}
                <span class="lbl"> {{ trans('back.usable_once') }}</span>
            </label>
        </div>
    </div>
</div>

<div class="clearfix form-actions">
    <div class="col-sm-offset-3 col-sm-9">
        <!-- submit for button -->
        <button class="btn btn-info" type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            {{ trans('back.submit') }}
        </button>

        &nbsp; &nbsp; &nbsp;

        <!-- cancel button -->
        <a href="{{ route('admin.membership-plans.index') }}">
            <button class="btn btn-danger" type="button">
                <i class="ace-icon fa fa-times bigger-110"></i>
                {{ trans('back.cancel') }}
            </button>
        </a>
    </div>
</div>


@section('additional-scripts')
    @include('admin.membership-plans.js.js-create-edit')
@stop