@extends('admin.layout.master')

@section('meta-title', trans('back.users'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.users') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.browse_and_manage_users') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- SEARCH OPTIONS -->
                @include('admin.users.partials.search')

                <!-- USERS -->
                @include('admin.users.partials.users')


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

@stop