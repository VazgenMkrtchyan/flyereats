@extends('admin.layout.master')

@section('meta-title', trans('back.edit_administrator'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.edit_administrator') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.modify_administrator_details') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                {{ Form::model($administrator, ['route' => ['admin.administrators.update', $administrator->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

                <!-- FIELDS -->
                @include('admin.administrators.partials.create-edit')

                {{ Form::close() }}
                <!-- End of form -->


                <!-- PERMISSIONS -->
                <h3 class="header smaller lighter purple">
                    {{ trans('back.administrator_permissions') }}
                </h3>

                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="widget-box widget-color-blue2">
                            <div class="widget-header">
                                <h4 class="widget-title lighter smaller">{{ trans('back.select_administrator_permissions') }}</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main padding-8">
                                    <ul id="adminPermissions" class="tree tree-selectable" role="tree"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- submit for button -->
                <div class="clearfix form-actions">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button class="btn btn-info" type="button" id="applyPermissions">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            {{ trans('back.apply_permissions') }}
                        </button>
                    </div>
                </div>
                <!-- ./PERMISSIONS -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_top -->
    {{ Form::hidden('nav_li_top', 'administrators') }}
@stop


@section('additional-scripts-2')
    @include('admin.administrators.js.js-edit')
@stop