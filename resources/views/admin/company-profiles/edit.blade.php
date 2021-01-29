@extends('admin.layout.master')

@section('meta-title', trans('back.edit_company_profile'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.edit_company_profile') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.modify_company_profile_details') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- LOGO -->
                <!-- Form -->
                {{ Form::open(['route' => ['admin.company-profiles.uploadlogo', $compprofile->id], 'class' => 'form-horizontal', 'files' => true, 'id' => 'company-logo']) }}

                <h3 class="header smaller lighter red">
                    {{ trans('back.company_logo') }}
                </h3>

                <!-- Files Select Field-->
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">

                        @if ($compprofile->logo)
                            <img src="{{ $compprofile->logoUrl() }}">
                        @else
                            <p><strong>{{ trans('back.no_logo_uploaded') }}</strong></p>
                        @endif

                        <div class="form-group">
                            <div class="col-xs-10 col-sm-4">
                                {{ Form::file('logo', ['id' => 'logo']) }}
                            </div>
                            <div id="logo-error" class="help-block col-xs-12 col-sm-reset red2" style="display: none">
                                {{ trans('back.not_valid_image') }}
                            </div>
                        </div>

                        <button id="upload-logo-button" class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-upload bigger-110"></i>
                            {{ trans('back.upload_logo') }}
                        </button>

                        @if ($compprofile->logo)
                            <a href="{{ route('admin.company-profiles.deletelogo', $compprofile->id) }}">
                                <button class="btn btn-danger" type="button">
                                    <i class="ace-icon fa fa-trash-o bigger-110"></i>
                                    {{ trans('back.delete_logo') }}
                                </button>
                            </a>
                        @endif

                    </div>
                </div>

                {{ Form::close() }}
                        <!-- End of form -->
                <!-- ./LOGO -->

                <!-- Form -->
                {{ Form::model($compprofile, ['route' => ['admin.company-profiles.update', $compprofile->id], 'class' => 'form-horizontal', 'id' => 'form-val', 'method' => 'PATCH']) }}

                        <!-- hidden field for old_state_id -->
                {{ Form::hidden('old_state_id', $compprofile->state_id) }}
                        <!-- hidden field for old_city -->
                {{ Form::hidden('old_city', $compprofile->city) }}
                        <!-- hidden field for old_addr_1 -->
                {{ Form::hidden('old_addr_1', $compprofile->addr_1) }}
                        <!-- hidden field for old_zip -->
                {{ Form::hidden('old_zip', $compprofile->zip) }}

                        <!-- FIELDS -->
                @include('admin.company-profiles.partials.create-edit')

                {{ Form::close() }}
                        <!-- End of form -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_top -->
    {{ Form::hidden('nav_li_top', 'company-profiles') }}
@stop