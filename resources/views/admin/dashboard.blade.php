@extends('admin.layout.master')

@section('meta-title', trans('back.overview_page'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('Shortcuts') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('Shortcuts') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS 

                @if (Auth::user()->hasPermission('admin.users.index'))
                    <a href="{{ route('admin.users.index', ['moderationStatus' => 'pending']) }}" class="btn btn-app btn-primary no-radius">
                        <i class="ace-icon fa fa-users bigger-230"></i>
                        {{ trans('back.overview_pending_users') }} ({{ $pendingUsers }})
                    </a>
                @endif-->


                @if (Auth::user()->hasPermission('admin.listings.index'))
                    <a href="{{ route('admin.listings.create', ['moderationStatus' => 'pending']) }}" class="btn btn-app btn-warning no-radius">
                        <i class="ace-icon fa fa-car bigger-230"></i>
                        {{ trans('Add Car </br> Listing') }} 
                    </a>
                @endif
                 <a href="{{ route('admin.listings.index') }}" class="btn btn-app btn-blue no-radius">
                    <i class="ace-icon fa fa-list bigger-230"></i>
                    {{ trans('Manage </br> Stocklist') }}
                </a>

                @if(Auth::user()->IsSuper())
                    <a href="{{ route('admin.statistics.index') }}" class="btn btn-app btn-success no-radius">
                        <i class="ace-icon fa fa-info bigger-230"></i>
                        {{ trans('back.overview_website_statistics') }}
                    </a>
                @endif

                <a href="{{ route('admin.profile.edit') }}" class="btn btn-app btn-pink no-radius">
                    <i class="ace-icon fa fa-pencil-square-o bigger-230"></i>
                    {{ trans('back.oveview_edit_your_profile') }}
                </a>
                <a href="{{ route('admin.data_makes.index') }}" class="btn btn-app btn-warning no-radius">
                    <i class="ace-icon fa fa-tasks bigger-230"></i>
                    {{ trans('Manage</br>Make/Model') }}
                </a>
                <a href="{{ route('admin.settings.site-pref') }}" class="btn btn-app btn-success no-radius">
                    <i class="ace-icon fa fa-cogs bigger-230"></i>
                    {{ trans('Website</br>Settings') }}
                </a>

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

@stop
