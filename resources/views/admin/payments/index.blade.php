@extends('admin.layout.master')

@section('meta-title', trans('back.browse_and_manage_payments'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.payments') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.browse_and_manage_payments') }}
            </small>

        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- SEARCH OPTIONS -->
                @include('admin.payments.partials.search')

                <!-- PAYMENTS -->
                @include('admin.payments.partials.payments')

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

@stop

@section('additional-scripts')
    @include('admin.js.destroy')
@stop