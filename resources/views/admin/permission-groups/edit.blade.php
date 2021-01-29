@extends('admin.layout.master')

@section('meta-title', trans('back.edit_permission_group'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.edit_permission_group') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.enter_permission_group_details') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                {{ Form::model($permissionGroup, ['route' => ['admin.permission-groups.update', $permissionGroup->id], 'class' => 'form-horizontal', 'id' => 'form-val', 'method' => 'PATCH']) }}

                @include('admin.permission-groups.partials.create-edit')

                {{ Form::close() }}
                <!-- End of form -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_identifier -->
    {{ Form::hidden('nav_li_identifier', 'admin.permissions') }}
@stop