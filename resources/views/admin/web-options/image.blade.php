@extends('admin.layout.master')

@section('meta-title', trans('back.image_settings'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.image_settings') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.adjust_image_settings') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                {{ Form::model(appCon(), ['route' => 'admin.settings.image.update', 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

                <h3 class="header smaller lighter red">
                    {{ trans('back.listing_photo_size') }}
                </h3>

                <!-- text field for 'size_photo_x'-->
                <div class="form-group">
                    {{ Form::label('size_photo_x', trans('back.width').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-sm-5">
                        {{ Form::text('size_photo_x', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- text field for 'size_photo_y'-->
                <div class="form-group">
                    {{ Form::label('size_photo_y', trans('back.height').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-sm-5">
                        {{ Form::text('size_photo_y', null, ['class' => 'form-control']) }}
                    </div>
                </div>


                <h3 class="header smaller lighter purple">
                    {{ trans('back.listing_thumbnail_size') }}
                </h3>

                <!-- text field for 'size_thumb_x'-->
                <div class="form-group">
                    {{ Form::label('size_thumb_x', trans('back.width').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-sm-5">
                        {{ Form::text('size_thumb_x', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- text field for 'size_thumb_y'-->
                <div class="form-group">
                    {{ Form::label('size_thumb_y', trans('back.height').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-sm-5">
                        {{ Form::text('size_thumb_y', null, ['class' => 'form-control']) }}
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

            //VALIDATION
            $( '#form-val' ).validate({
                rules: {
                    size_photo_x: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    size_photo_y: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    size_thumb_x: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    size_thumb_y: {
                        required: true,
                        number: true,
                        min: 0
                    }
                }
            });

        })
    </script>
@stop