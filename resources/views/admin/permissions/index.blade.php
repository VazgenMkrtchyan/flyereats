@extends('admin.layout.master')

@section('meta-title', trans('back.browse_and_manage_permissions'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.permission_group') }}::<strong><a href="{{ route('admin.permission-groups.index') }}">{{ $parent->name }}</a></strong>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.browse_and_manage_permissions') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->


                <!-- WARNING -->
                @include('admin.permission-groups.partials.warning')


                <div class="margin-b-10">
                    <a href="{{ route('admin.permissions.create', $parent->id) }}">
                        <button class="btn btn-white btn-pink btn-bold">
                            <span class="ace-icon fa fa-plus icon-on-left"></span>
                            {{ trans('back.add_permission') }}
                        </button>
                    </a>
                </div>


                <!-- PERMISSIONS -->
                @include('admin.permissions.partials.permissions')


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_identifier -->
    {{ Form::hidden('nav_li_identifier', 'admin.permissions') }}
@stop

@section('additional-scripts')
    @include('admin.js.destroy')
@stop