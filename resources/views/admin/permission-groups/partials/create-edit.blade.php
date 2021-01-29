<!-- text field for 'name'-->
<div class="form-group">
    {{ Form::label('name', trans('back.group_name').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'Identifier'-->
<div class="form-group">
    {{ Form::label('identifier', trans('back.identifier').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('identifier', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'order'-->
<div class="form-group">
    {{ Form::label('order', trans('back.order').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('order', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- check box 'system_protected'-->
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <div class="checkbox">
            <label>
                {{ Form::checkbox('system_protected', '1', true, ['class' => 'ace']); }}
                <span class="lbl"> {{ trans('back.delete_protected') }}</span>
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
        <a href="{{ route('admin.permission-groups.index') }}">
            <button class="btn btn-danger" type="button">
                <i class="ace-icon fa fa-times bigger-110"></i>
                {{ trans('back.cancel') }}
            </button>
        </a>

    </div>
</div>


@section('additional-scripts')
    @include('admin.permission-groups.js.js-create-edit')
@stop