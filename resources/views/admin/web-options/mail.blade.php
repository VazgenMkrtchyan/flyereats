@extends('admin.layout.master')

@section('meta-title', trans('back.mail_settings'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.mail_settings') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.adjust_mail_settings') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                {{ Form::open(['route' => 'admin.settings.mail.update', 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

                <h3 class="header smaller lighter red">
                    {{ trans('back.general_mail_settings') }}
                </h3>

                <!-- text field for 'Cont_email'-->
                <div class="form-group">
                    {{ Form::label('cont_email', trans('back.contact_us_email').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::email('cont_email', appCon()->cont_email, ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- text field for 'from_email'-->
                <div class="form-group">
                    {{ Form::label('from_email', trans('back.from_email').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::email('from_email', config('mail.from')['address'], ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- text field for 'from_name'-->
                <div class="form-group">
                    {{ Form::label('from_name', trans('back.from_name').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::text('from_name', config('mail.from')['name'], ['class' => 'form-control']) }}
                    </div>
                </div>

                <h3 class="header smaller lighter green">
                    {{ trans('back.smtp_settings') }}
                </h3>

                <!-- text field for 'Smtp_host'-->
                <div class="form-group">
                    {{ Form::label('smtp_host', trans('back.smtp_host').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::text('smtp_host', config('mail.host'), ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- text field for 'Smtp_user'-->
                <div class="form-group">
                    {{ Form::label('smtp_user', trans('back.smtp_user').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::text('smtp_user', config('mail.username'), ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- text field for 'Smtp_pass'-->
                <div class="form-group">
                    {{ Form::label('smtp_pass', trans('back.smtp_password').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::text('smtp_pass', config('mail.password'), ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- text field for 'smtp_port'-->
                <div class="form-group">
                    {{ Form::label('smtp_port', trans('back.smtp_port').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::text('smtp_port', config('mail.port'), ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- check box 'smtp_use'-->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                {{ Form::checkbox('smtp_use', '1', config('mail.driver') == 'smtp', ['class' => 'ace']); }}
                                <span class="lbl"> {{ trans('back.use_smtp') }}</span>
                            </label>
                        </div>
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
                    cont_email: {
                        required: true,
                        email: true
                    },
                    from_email: {
                        required: true,
                        email: true
                    },
                    from_name: {
                        required: true
                    },
                    smtp_host: {
                        required: function() {
                            return $( "[name='smtp_use']" ).prop( "checked" );
                        }
                    },
                    smtp_user: {
                        required: function() {
                            return $( "[name='smtp_use']" ).prop( "checked" );
                        }
                    },
                    smtp_pass: {
                        required: function() {
                            return $( "[name='smtp_use']" ).prop( "checked" );
                        }
                    }
                },

                messages: {
                    cont_email: {
                        required: "{{ trans('back.contact_us_email') . trans('back.required_not_empty') }}"
                    },
                    from_email: {
                        required: "{{ trans('back.from_email') . trans('back.required_not_empty') }}"
                    },
                    from_name: {
                        required: "{{ trans('back.from_name') . trans('back.required_not_empty') }}"
                    },
                    smtp_host: {
                        required: "{{ trans('back.smtp_host') . trans('back.required_not_empty') }}"
                    },
                    smtp_user: {
                        required: "{{ trans('back.smtp_user') . trans('back.required_not_empty') }}"
                    },
                    smtp_pass: {
                        required: "{{ trans('back.smtp_password') . trans('back.required_not_empty') }}"
                    }
                }
            });

            //revalidates smtp fields
            $( "[name='smtp_use']" ).change( function() {
                $( "#smtp_host" ).valid();
                $( "#smtp_user" ).valid();
                $( "#smtp_pass" ).valid();
            });

        })
    </script>
@stop