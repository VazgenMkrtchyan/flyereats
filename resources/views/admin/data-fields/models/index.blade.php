@extends('admin.layout.master')

@section('meta-title', 'Data Fields Manager')

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.data_fields') }} ({{ $parent->name }})
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.browse_and_manage_models') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="margin-b-10">
                    <a href="{{ route('admin.data_models.create', $parent->id) }}">
                        <button class="btn btn-white btn-pink btn-bold">
                            <span class="ace-icon fa fa-plus icon-on-left"></span>
                            {{ trans('back.add_model') }}
                        </button>
                    </a>
                    <span class="per_page">
                        {{ Form::select('per_page', rangePerPage(), sessionOrWebc('ai_datafields_no', Route::currentRouteName()), ['class'=>'form-control', 'data-redirect' => route('admin.data_models.index', Route::input('makeId'))]); }}
                    </span>
                </div>

                <!-- MODELS -->
                <!-- Form (for updating order)-->
                {{ Form::open(['route' => ['admin.data_models.update_order', $parent->id], 'method' => 'PATCH']) }}

                <table id="simple-table" class="table table-striped table-hover">

                    <thead class="hidden-xs">
                    <tr>
                        <th>
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-6 bigger-110">
                                    #{{ trans('back.ORDER') }}
                                </div>
                            </div>
                        </th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach ($models as $model)

                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-sm-6">
                                        {{ trans('back.name') }}: <strong>{{ $model->name }}</strong> <br>
                                        {{ trans('back.listings') }}: <strong>{{ $model->listingsNo }}</strong>
                                    </div>

                                    <!-- ORDER -->
                                    <div class="col-sm-3">
                                        <div class="margin-t-5 visible-xs"></div>
                                        <span class="visible-xs">{{ trans('back.ORDER') }}: </span>{{ Form::text('order_'.$model->id, $model->order, ['class' => 'input-mini']) }}
                                    </div>
                                    <!-- ./ORDER -->

                                    <!-- ACTIONS -->
                                    <div class="col-sm-3">
                                        <div class="margin-t-10 visible-xs"></div>
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                                    <i class="fa fa-cogs"></i> {{ trans('back.model_actions') }}
                                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                                </button>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a href="{{ route('admin.data_models.edit', [$parent->id, $model->id]) }}"><i class="fa fa-pencil"></i> {{ trans('back.edit') }}</a>
                                                    </li>

                                                    <li class="divider"></li>

                                                    <li>
                                                        <a href="{{ route('admin.data_models.destroy', [$parent->id, $model->id]) }}" data-delete="{{ csrf_token() }}" data-confirm="{{ trans('back.delete_model_confirm') }}"><i class="fa fa-trash-o"></i> {{ trans('back.delete_model') }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./ACTIONS -->
                                </div>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

                <div class="row">
                    <div class="col-sm-offset-6 col-sm-6">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i> {{ trans('back.update_order') }}</button>
                    </div>
                </div>

                {{ Form::close() }}

                {{ str_replace('/?', '?', $models->render()) }}


            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_identifier -->
    {{ Form::hidden('nav_li_identifier', 'admin.data_makes.index') }}
@stop

@section('additional-scripts')
    @include('admin.js.destroy')
@stop