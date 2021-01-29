@extends('admin.layout.master')

@section('meta-title', trans('back.payment_settings'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.payment_settings') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.adjust_payment_settings') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                {{ Form::model(appCon(), ['route' => 'admin.settings.payment.update', 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

                <!-- text field for 'pp_email'-->
                <div class="form-group">
                    {{ Form::label('pp_email', trans('back.paypal_email').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::email('pp_email', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- text field for 'pp_curr_code'-->
                <div class="form-group">
                    {{ Form::label('pp_curr_code', trans('back.currency_code').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::text('pp_curr_code', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="col-sm-offset-3 col-xs-12">
							<span class="help-block no-margin-bottom">
								{{ trans('back.more_info') }}: <a href="https://developer.paypal.com/docs/classic/api/currency_codes/" target="_blank">{{ trans('back.paypal_currency_codes') }}</a>
							</span>
                    </div>
                </div>

                <!-- check box 'pp_sandbox'-->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                {{ Form::checkbox('pp_sandbox', '1', null,  ['class' => 'ace']); }}
                                <span class="lbl"> {{ trans('back.sandbox_mode') }}</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- check box 'pp_bypass'-->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                {{ Form::checkbox('pp_bypass', '1', null,  ['class' => 'ace']); }}
                                <span class="lbl"> {{ trans('back.bypass_paypal') }}</span>
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
                    pp_email: {
                        required: true,
                        email: true
                    },
                    pp_curr_code: {
                        required: true
                    }
                },

                messages: {
                    pp_email: {
                        required: "{{ trans('back.paypal_email') . trans('back.required_not_empty') }}"
                    },
                    pp_curr_code: {
                        required: "{{ trans('back.currency_code') . trans('back.required_not_empty') }}"
                    }
                }
            });

        })
    </script>
@stop