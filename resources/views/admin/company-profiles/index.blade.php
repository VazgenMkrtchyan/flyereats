@extends('admin.layout.master')

@section('meta-title', trans('back.company_profiles'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.company_profiles') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.browse_add_manage_company_profiles') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- PROFILES -->
                @include('admin.company-profiles.partials.compprofiles')


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

@stop


@section('additional-scripts')
    @include('admin.js.destroy')
@stop