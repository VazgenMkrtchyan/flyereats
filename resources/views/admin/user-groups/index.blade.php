@extends('admin.layout.master')

@section('meta-title', trans('back.user_groups'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.user_groups') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.browse_and_manage_user_groups') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="margin-b-10">
                    <a href="{{ route('admin.user-groups.create') }}">
                        <button class="btn btn-white btn-pink btn-bold">
                            <span class="ace-icon fa fa-plus icon-on-left"></span>
                            {{ trans('back.add_user_group') }}
                        </button>
                    </a>
                </div>

                <!-- USER GROUPS -->
                @include('admin.user-groups.partials.usergroups')


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

@stop


@section('additional-scripts')
    @include('admin.js.destroy')
@stop