@extends('admin.layout.master')

@section('meta-title', trans('back.edit_listing_plan'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.edit_listing_plan') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.modify_listing_plan_details') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    @include('admin.listing-plans.partials.note')

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                {{ Form::model($listingPlan, ['route' => ['admin.listing-plans.update', $listingPlan->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

                <!-- FIELDS -->
                @include('admin.listing-plans.partials.create-edit')

                {{ Form::hidden('user_group_id', $listingPlan->user_group_id) }}

                {{ Form::close() }}
                <!-- End of form -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_identifier -->
    {{ Form::hidden('nav_li_identifier', 'admin.listing-plans.index') }}
@stop