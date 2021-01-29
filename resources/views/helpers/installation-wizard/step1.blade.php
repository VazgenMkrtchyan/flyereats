@extends('helpers.installation-wizard.layout-wizard')

@section('meta-title', trans('installation.title_step_1'))

@section('content')

    <h1><i class="fa fa-battery-empty"></i> {{ trans('installation.step_1') }} <small>({{ trans('installation.enter_server_details') }})</small></h1>

    <div class="bs-callout bs-callout-info">
        {{ trans('installation.enter_correct_mysql') }}
    </div>


    <!-- MYSQL Details -->
    {{ Form::open(['route' => 'install.step1_submit', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

    <!-- text field for 'db_host'-->
    <div class="form-group">
        {{ Form::label('db_host', trans('installation.host_name').': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::text('db_host', null, ['class' => 'form-control']) }}
        </div>
    </div>

    <!-- text field for 'db_name'-->
    <div class="form-group">
        {{ Form::label('db_name', trans('installation.db_name').': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::text('db_name', null, ['class' => 'form-control']) }}
        </div>
    </div>

    <!-- text field for 'db_username'-->
    <div class="form-group">
        {{ Form::label('db_username', trans('installation.db_username').': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::text('db_username', null, ['class' => 'form-control']) }}
        </div>
    </div>

    <!-- db_password -->
    <div class="form-group">
        {{ Form::label('db_password', trans('installation.db_password').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::password('db_password', ['class' => 'form-control']) }}
        </div>
    </div>


    <div class="form-group margin-t-30">
        <!-- submit for button -->
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
            <button class="btn-main" type="submit">
                {{ trans('installation.CONTINUE') }}
            </button>
        </div>
    </div>

    {{ Form::close() }}
    <!-- End of form -->

@stop

@section('additional-scripts')
    <script>
        $( document ).ready( function() {

            //validation
            $( '#form-val' ).validate({
                rules: {
                    db_host: {
                        required: true
                    },
                    db_name: {
                        required: true
                    },
                    db_username: {
                        required: true
                    }
                },

                messages: {
                    db_host: {
                        required: "{{ trans('installation.host_name') . trans('front.required_not_empty') }}"
                    },
                    db_name: {
                        required: "{{ trans('installation.db_name') . trans('front.required_not_empty') }}"
                    },
                    db_username: {
                        required: "{{ trans('installation.db_username') . trans('front.required_not_empty') }}"
                    }
                }
            });

        })
    </script>
@stop