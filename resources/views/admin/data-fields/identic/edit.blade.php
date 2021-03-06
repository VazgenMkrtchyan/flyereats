@extends('admin.layout.master')

@section('meta-title', trans('back.edit_data_field_title'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.data_fields_for', ['for' => $name]) }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.edit') }}
            </small>

        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                {{ Form::model($value, ['route' => ['admin.data_solo.update', 'dataField' => $dataField, 'id' => $value->id], 'class' => 'form-horizontal', 'id' => 'form-val', 'method' => 'PATCH']) }}

                <!-- text field for 'Name'-->
                <div class="form-group">
                    {{ Form::label('name', trans('back.name').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- text field for 'Order'-->
                <div class="form-group">
                    {{ Form::label('order', trans('back.order').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::text('order', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <!--BUTTONS-->
                <div class="clearfix form-actions">
                    <div class="col-sm-offset-3 col-sm-9">

                        <!-- submit button -->
                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            {{ trans('back.submit') }}
                        </button>

                        &nbsp; &nbsp; &nbsp;

                        <!-- cancel button -->
                        <a href="{{ route('admin.data_solo.index', $dataField) }}" class="btn btn-danger">
                            <i class="ace-icon fa fa-times bigger-110"></i>
                            {{ trans('back.cancel') }}
                        </a>

                    </div>
                </div>

                {{ Form::close() }}
                <!-- End of form -->

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_identifier -->
    {{ Form::hidden('nav_li_identifier', 'admin.data_solo.' . $dataField) }}
@stop


@section('additional-scripts')
    @include('admin.data-fields.identic.js.js-create-edit')
@stop