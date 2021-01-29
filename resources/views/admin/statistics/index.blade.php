@extends('admin.layout.master')

@section('meta-title', trans('back.website_statistics'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.website_statistics') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.view_website_statistics') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <!-- PAGE CONTENT BEGINS -->

            <div class="col-xs-12 col-sm-6">
                <!-- Listing Statistics -->
                @include('admin.statistics.partials.listing-stats')

                <!-- Payment Statistics -->
                @include('admin.statistics.partials.payment-stats')
            </div>

            <div class="col-xs-12 col-sm-6">
                <!-- User Statistics -->
                @include('admin.statistics.partials.user-stats')

            </div>

        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.page-content-area -->

@stop
