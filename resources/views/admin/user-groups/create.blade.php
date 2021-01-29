@extends('admin.layout.master')

@section('meta-title', trans('back.add_user_group'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.add_user_group') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.enter_user_group_details') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                {{ Form::open(['route' => 'admin.user-groups.store', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

                <!-- FIELDS -->
                @include('admin.user-groups.partials.create-edit')

                {{ Form::close() }}
                <!-- End of form -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_top -->
    {{ Form::hidden('nav_li_top', 'users') }}
@stop