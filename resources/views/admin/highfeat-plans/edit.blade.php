@extends('admin.layout.master')

@section('meta-title', trans('back.edit_highlight_feature_plan'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.edit_highlight_feature_plan') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.modify_plan_details') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                {{ Form::model($highfeatPlan,['route' => ['admin.highfeat-plans.update', $highfeatPlan->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

                <!-- FIELDS -->
                @include('admin.highfeat-plans.partials.create-edit')

                {{ Form::close() }}
                <!-- End of form -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_identifier -->
    {{ Form::hidden('nav_li_identifier', 'admin.highfeat-plans.index') }}
@stop