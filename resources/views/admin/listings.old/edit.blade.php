@extends('admin.layout.master')

@section('meta-title', trans('back.edit_listing'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.edit_listing') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.modify_listing_details') }}
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
                        <a href="#listing-photos" data-toggle="tab"><i class="fa fa-picture-o"></i> {{ trans('back.listing_photos') }}</a>
                    </li>
                </ul>

                <div class="tab-content no-border">
                    <div class="tab-pane in active" id="listing-data">
                        {{ Form::model($listing ,['route' => ['admin.listings.update', $listing->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

                        {{ Form::hidden('old_state_id', $listing->state_id) }}
                        {{ Form::hidden('old_city', $listing->city) }}
                        {{ Form::hidden('old_addr_1', $listing->addr_1) }}
                        {{ Form::hidden('old_zip', $listing->zip) }}
                        {{ Form::hidden('old_expires_on', $listing->expires_on ? $listing->expires_on->format('Y-m-d') : null ) }}
                        {{ Form::hidden('old_high_or_feat_till', $listing->high_or_feat_till ? $listing->high_or_feat_till->format('Y-m-d') : null ) }}
                        {{ Form::hidden('old_st_moderation', $listing->st_moderation) }}

                        @include('admin.listings.partials.listing-data')

                        {{ Form::close() }}
                    </div>

                    <div class="tab-pane" id="listing-photos">
                        @include('admin.listings.partials.listing-photos')
                    </div>
                </div>

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_top -->
    {{ Form::hidden('nav_li_top', 'listings') }}
@stop


@section('additional-scripts')
    @include('admin.listings.js.js-listing-data')
    @include('admin.listings.js.js-listing-photos')
@stop


@section('additional-css-before')
    <link rel="stylesheet" href="{{ asset('templates/admin/css/dropzone.css') }}" />
@stop