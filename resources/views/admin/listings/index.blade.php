@extends('admin.layout.master')

@section('meta-title', trans('back.browse_and_manage_listings'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.listings') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.browse_and_manage_listings') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- SEARCH OPTIONS -->
                @include('admin.listings.partials.search')

                <!-- LISTINGS -->
                @include('admin.listings.partials.listings')

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

@stop

@section('additional-scripts')
    @include('admin.js.destroy')
@stop
