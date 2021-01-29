@extends('admin.layout.master')

@section('meta-title', trans('back.browse_and_manage_data_field', ['data_field' => trans('back.vehicle_features')]))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.data_fields_for', ['for' => trans('back.vehicle_features')]) }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.browse_and_manage_data_field', ['data_field' => trans('back.vehicle_features')]) }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="margin-b-10">
                    <a href="{{ route('admin.data_features.create') }}">
                        <button class="btn btn-white btn-pink btn-bold">
                            <span class="ace-icon fa fa-plus icon-on-left"></span>
                            {{ trans('back.add_data_field', ['data_field' => str_singular(trans('back.vehicle_features'))]) }}
                        </button>
                    </a>
                    <span class="per_page">
                        {{ Form::select('per_page', rangePerPage(), sessionOrWebc('ai_datafields_no', Route::currentRouteName()), ['class'=>'form-control']); }}
                    </span>
                </div>

                <!-- FEATURES -->
                @include('admin.data-fields.features.partials.features')

                        <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

@stop

@section('additional-scripts')
    @include('admin.js.destroy')
@stop