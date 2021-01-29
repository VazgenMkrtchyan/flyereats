@extends('admin.layout.master')

@section('meta-title', trans('back.add_membership_plan'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.add_membership_plan') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.enter_membership_plan_details') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    @include('admin.membership-plans.partials.note')

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                {{ Form::open(['route' => 'admin.membership-plans.store', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

                <!-- FIELDS -->
                @include('admin.membership-plans.partials.create-edit')

                {{ Form::close() }}
                <!-- End of form -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_identifier -->
    {{ Form::hidden('nav_li_identifier', 'admin.membership-plans.index') }}
@stop