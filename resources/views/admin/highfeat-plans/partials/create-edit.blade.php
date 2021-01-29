
<!-- select box for 'for'-->
<div class="form-group">
    {{ Form::label('for', trans('back.plan_for').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('for', ['highlighting' => 'Highlighting', 'sold' => 'Sold'], null, ['class'=>'form-control', isset($highfeatPlan) ? 'disabled' : '']); }}
    </div>
</div>

<!-- select box for 'user_group_id'-->
<div class="form-group">
    {{ Form::label('user_group_id', trans('back.user_group').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('user_group_id', $details['UserGroups'], null, ['class'=>'form-control', isset($highfeatPlan) ? 'disabled' : '']); }}
    </div>
</div>


<!-- text field for 'duration'-->
<div class="form-group">
    {{ Form::label('exp_period', trans('back.duration_days').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('duration', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'price'-->
<div class="form-group">
    {{ Form::label('price', trans('back.price').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('price', null, ['class' => 'form-control']) }}
        ({{ trans('back.leave_empty_for_free') }})
    </div>
</div>

<!-- text field for 'order'-->
<div class="form-group">
    {{ Form::label('order', trans('back.order').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('order', null, ['class' => 'form-control']) }}
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
        <a href="{{ route('admin.highfeat-plans.index') }}">
            <button class="btn btn-danger" type="button">
                <i class="ace-icon fa fa-times bigger-110"></i>
                {{ trans('back.cancel') }}
            </button>
        </a>
    </div>
</div>


@section('additional-scripts')
    @include('admin.highfeat-plans.js.js-create-edit')
@stop