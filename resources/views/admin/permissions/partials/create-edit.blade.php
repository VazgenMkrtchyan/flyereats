<!-- text field for 'route_names'-->
<div class="form-group">
    {{ Form::label('route_names', trans('back.route_names').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('route_names', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'description'-->
<div class="form-group">
    {{ Form::label('description', trans('back.description').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('description', null, ['class' => 'form-control']) }}
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
        <a href="{{ route('admin.permissions.index', $parent->id) }}">
            <button class="btn btn-danger" type="button">
                <i class="ace-icon fa fa-times bigger-110"></i>
                {{ trans('back.cancel') }}
            </button>
        </a>

    </div>
</div>



@section('additional-scripts')
    @include('admin.permissions.js.js-create-edit')
@stop