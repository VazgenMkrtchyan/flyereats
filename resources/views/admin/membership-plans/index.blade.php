@extends('admin.layout.master')

@section('meta-title', trans('back.browse_and_manage_membership_plans'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.membership_plans') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.browse_and_manage_membership_plans') }}
            </small>

            <a href="{{ route('admin.membership-plans.create') }}" class="pull-right">
                <button class="btn btn-white btn-pink btn-bold">
                    <span class="ace-icon fa fa-plus icon-on-left"></span>
                    {{ trans('back.add_membership_plan') }}
                </button>
            </a>
        </h1>
    </div><!-- /.page-header -->

    @include('admin.membership-plans.partials.note')

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div id="accordion" class="accordion-style1 panel-group">

                    @foreach($userGroups as $userGroup)

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#userGroup{{ $userGroup->id }}" aria-expanded="false">
                                        <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp;<i>{{ trans('back.user_group') }}:</i> {{ $userGroup->name }}
                                    </a>
                                </h4>
                            </div>

                            <div class="panel-collapse collapse" id="userGroup{{ $userGroup->id }}" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    <!-- MEMBERSHIP PLANS -->
                                    @include('admin.membership-plans.partials.membershipplans')
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

@stop


@section('additional-scripts')
    @include('admin.js.destroy')
@stop