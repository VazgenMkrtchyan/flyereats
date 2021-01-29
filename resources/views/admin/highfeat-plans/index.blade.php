@extends('admin.layout.master')

@section('meta-title', 'Highlight/Feature Plans Manager')

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.highlight_feature_plans') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.browse_and_manage_highlight_feature_plans') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">

            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->


                <div class="margin-b-10">
                    <a href="{{ route('admin.highfeat-plans.create') }}">
                        <button class="btn btn-white btn-pink btn-bold">
                            <span class="ace-icon fa fa-plus icon-on-left"></span>
                            {{ trans('back.highlight_feature_plans') }}
                        </button>
                    </a>
                </div>


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

                                    <!-- PLANS -->
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="plans{{ $userGroup->id }}">
                                            <li class="active">
                                                <a data-toggle="tab" href="#highlighting{{ $userGroup->id }}" aria-expanded="true">
                                                    <span class="badge badge-success">H</span>
                                                    {{ trans('back.highlighting_plans') }}
                                                </a>
                                            </li>

                                            <li class="">
                                                <a data-toggle="tab" href="#featuring{{ $userGroup->id }}" aria-expanded="false">
                                                    <span class="badge badge-danger">F</span>
                                                    {{ trans('back.featuring_plans') }}
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="tab-content">
                                            <div id="highlighting{{ $userGroup->id }}" class="tab-pane fade active in">
                                                @include('admin.highfeat-plans.partials.highfeat-plans', ['highfeatPlans' => $userGroup->highfeatPlans()->highlighting()])
                                            </div>

                                            <div id="featuring{{ $userGroup->id }}" class="tab-pane fade">
                                                @include('admin.highfeat-plans.partials.highfeat-plans', ['highfeatPlans' => $userGroup->highfeatPlans()->featuring()])
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /PLANS -->


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