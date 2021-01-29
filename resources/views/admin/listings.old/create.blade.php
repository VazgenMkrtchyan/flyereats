@extends('admin.layout.master')

@section('meta-title', trans('back.add_listing'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.add_listing') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.enter_listing_details') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                    <ul id="myTab" class="nav nav-tabs bigger-110">
                        <li class="active">
                            <a href="#listing-data" data-toggle="tab"><i class="fa fa-cogs"></i> {{ trans('back.listing_details') }}</a>
                        </li>
                        <li>
                            <a href="#listing-photos" style="cursor: not-allowed;" onclick="return false;"><i class="fa fa-picture-o"></i> {{ trans('back.listing_photos') }}</a>
                        </li>
                    </ul>

                    <div class="tab-content no-border">
                        <div class="tab-pane in active" id="listing-data">
                            {{ Form::open(['route' => 'admin.listings.store', 'class' => 'form-horizontal', 'id' => 'form-val']) }}
                            @include('admin.listings.partials.listing-data')
                            {{ Form::close() }}
                        </div>
                        <div class="tab-pane" id="listing-photos"></div>
                    </div>

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

@stop


@section('additional-scripts')
    @include('admin.listings.js.js-listing-data')
@stop