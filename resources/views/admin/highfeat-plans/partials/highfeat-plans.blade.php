@if($highfeatPlans->count())

    <!-- Form (for updating order)-->
    {{ Form::open(['route' => 'admin.highfeat-plans.updateorder', 'method' => 'PATCH', 'class' => 'clearfix']) }}

    <table class="table table-striped table-hover">

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
        @foreach($highfeatPlans->ordered()->get() as $highfeatPlan)

            <tr>
                <td>

                    <div class="row">

                        <div class="col-sm-6 bigger-110">
                            {{ trans('back.duration') }}: <b>{{ $highfeatPlan->duration }} {{ trans('back.days') }}</b> <br>
                            {{ trans('back.price') }}: {{ $highfeatPlan->price }}
                        </div>

                        <!-- ORDER -->
                        <div class="col-sm-3">
                            <div class="margin-t-5 visible-xs"></div>
                            <span class="visible-xs">{{ trans('back.ORDER') }}: </span>{{ Form::text('order_'.$highfeatPlan->id, $highfeatPlan->order, ['class' => 'input-mini']) }}
                        </div>
                        <!-- ./ORDER -->

                        <!-- ACTIONS -->
                        <div class="col-sm-3">
                            <div class="margin-t-10 visible-xs"></div>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                        <i class="fa fa-cogs"></i> {{ trans('back.plan_actions') }}
                                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-info">
                                        <li>
                                            <a href="{{ route('admin.highfeat-plans.edit', $highfeatPlan->id); }}"><i class="fa fa-pencil"></i> {{ trans('back.edit') }}</a>
                                        </li>

                                        <li class="divider"></li>

                                        <li>
                                            <a href="{{ route('admin.highfeat-plans.destroy', $highfeatPlan->id); }}" data-delete="{{ csrf_token() }}" data-confirm="{{ trans('back.delete_plan_confirm') }}"><i class="fa fa-trash-o"></i> {{ trans('back.delete_plan') }}</a>
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

@else

    <h4 class="red">{{ trans('back.no_plans_found') }}</h4>

@endif