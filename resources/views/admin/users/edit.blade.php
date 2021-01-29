@extends('admin.layout.master')

@section('meta-title', trans('back.edit_user'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.edit_user') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.modify_user_details') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                {{ Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']) }}
                <!-- FIELDS -->
                @include('admin.users.partials.create-edit')

                <!-- hidden field for old_expires_on -->
                {{ Form::hidden('old_expires_on', $user->expires_on ? $user->expires_on->format('Y-m-d') : null) }}
                <!-- hidden field for old_st_moderation -->
                {{ Form::hidden('old_st_moderation', $user->st_moderation) }}

                {{ Form::close() }}
                <!-- End of form -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_top -->
    {{ Form::hidden('nav_li_top', 'users') }}
@stop

