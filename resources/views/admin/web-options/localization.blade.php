@extends('admin.layout.master')

@section('meta-title', trans('back.localization_settings'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.localization_settings') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.adjust_localization_settings') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- ZIPS -->
                <!-- Form -->
                {{ Form::open(['route' => 'admin.settings.importZips', 'class' => 'form-horizontal', 'files' => true, 'id' => 'zip-import']) }}

                <h3 class="header smaller lighter blue" style="display:none;">
                    {{ trans('back.import_zips') }}
                </h3>

                <!-- Files Select Field-->
                <div class="form-group" style="display:none;">
                    <div class="col-sm-9 col-sm-offset-3">

                        <p>{{ Form::file('zips_file') }}</p>

                        <!-- check box 'captcha_user_login'-->
                        <div class="form-group">
                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('truncate_zips', '1', true, ['class' => 'ace']); }}
                                        <span class="lbl"> {{ trans('back.clear_previous_data') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            {{ trans('back.import_zips') }}
                        </button>
                    </div>
                </div>

                {{ Form::close() }}
                <!-- End of form -->
                <!-- ./ZIPS -->


                <!-- Form -->
                {{ Form::model(appCon(), ['route' => 'admin.settings.local.update', 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

                <h3 class="header smaller lighter red">
                    {{ trans('back.localization_settings') }}
                </h3>

                <!-- text field for 'curr_symb'-->
                <div class="form-group">
                    {{ Form::label('curr_symb', trans('back.currency_symbol').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::text('curr_symb', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- select box for 'mileage_units'-->
                <div class="form-group">
                    {{ Form::label('mileage_units', trans('back.mileage_units').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::select('mileage_units', [
                        'mi' => trans('back.miles'),
                        'km' => trans('back.kilometers')
                        ], null, ['class'=>'form-control']); }}
                    </div>
                </div>

                <!-- text field for 'locality'-->
                <div class="form-group">
                    {{ Form::label('locality', trans('back.locality').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::text('locality', null, ['class' => 'form-control']) }}
                    </div>
                </div>


                <!-- text field for 'zip_format'-->
                <div class="form-group">
                    {{ Form::label('zip_format', trans('back.zip_format').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::text('zip_format', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- select box for 'price_format'-->
                <div class="form-group">
                    {{ Form::label('price_format', trans('back.price_format').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::select('price_format', [
                        'before' => '$100',
                        'after' => '100$'
                        ], null, ['class'=>'form-control']); }}
                    </div>
                </div>

                <!-- text field for 'date_format'-->
                <div class="form-group">
                    {{ Form::label('date_format', trans('back.date_format').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::text('date_format', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="col-sm-offset-3 col-xs-12">
			<span class="help-block no-margin-bottom">
                {{ trans('back.date_time_format_explanation', ['format' => date(appCon()->date_format, time())]) }}
			</span>
                    </div>
                </div>

                <!-- text field for 'time_format'-->
                <div class="form-group">
                    {{ Form::label('time_format', trans('back.time_format').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::text('time_format', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="col-sm-offset-3 col-xs-9">
			<span class="help-block no-margin-bottom">
                {{ trans('back.date_time_format_explanation', ['format' => date(appCon()->time_format, time())]) }}
			</span>
                    </div>
                </div>


                <!-- submit for button -->
                <div class="clearfix form-actions">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            {{ trans('back.submit') }}
                        </button>
                    </div>
                </div>

                {{ Form::close() }}
                <!-- End of form -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

@stop


@section('additional-scripts')
    <script>
        $( document ).ready( function() {

            //validation
            $( '#form-val' ).validate({
                rules: {
                    curr_symb: {
                        required: true
                    },
                    locality: {
                        required: true
                    },
                    zip_format: {
                        required: true
                    },
                    date_format: {
                        required: true
                    },
                    time_format: {
                        required: true
                    }
                },

                messages: {
                    curr_symb: {
                        required: "{{ trans('back.currency_symbol') . trans('back.required_not_empty') }}"
                    },
                    locality: {
                        required: "{{ trans('back.locality') . trans('back.required_not_empty') }}"
                    },
                    zip_format: {
                        required: "{{ trans('back.zip_format') . trans('back.required_not_empty') }}"
                    },
                    date_format: {
                        required: "{{ trans('back.date_format') . trans('back.required_not_empty') }}"
                    },
                    time_format: {
                        required: "{{ trans('back.time_format') . trans('back.required_not_empty') }}"
                    }
                }
            });


            //validation 2 (website logo)
            $( '#zip-import' ).validate({
                rules: {
                    zips_file: {
                        required: true
                    }
                },

                messages: {
                    zips_file: {
                        required: "{{ trans('back.select_file_to_upload') }}"
                    }
                }
            });

        })
    </script>
@stop