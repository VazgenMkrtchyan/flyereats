<h3 class="header smaller lighter purple">
    User Group Info
</h3>

<!-- text field for 'Name'-->
<div class="form-group">
    {{ Form::label('name', trans('back.user_group_name').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
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

<!-- check box 'display_company'-->
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <div class="checkbox">
            <label>
                {{ Form::checkbox('display_company', '1', null, ['class' => 'ace']); }}
                <span class="lbl"> {{ trans('back.display_company_profile') }}</span>
            </label>
        </div>
    </div>
</div>

<!-- check box 'display'-->
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <div class="checkbox">
            <label>
                {{ Form::checkbox('display', '1', null, ['class' => 'ace']); }}
                <span class="lbl"> {{ trans('back.display_among_browse_listings') }}</span>
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
        <a href="{{ route('admin.user-groups.index') }}">
            <button class="btn btn-danger" type="button">
                <i class="ace-icon fa fa-times bigger-110"></i>
                {{ trans('back.cancel') }}
            </button>
        </a>

    </div>
</div>


@section('additional-scripts')
    @include('admin.user-groups.js.js-create-edit')
@stop