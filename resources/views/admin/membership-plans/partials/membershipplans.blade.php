@if($userGroup->membershipPlans()->count())

    <!-- Form (for updating order)-->
    {{ Form::open(['route' => 'admin.membership-plans.updateorder', 'method' => 'PATCH']) }}

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
        @foreach($userGroup->membershipPlans()->ordered()->get() as $membershipPlan)

            <tr>
                <td>

                    <div class="row">

                        <div class="col-sm-6 bigger-110">
                            {{ trans('back.name') }}: <strong>{{ $membershipPlan->name }}</strong> <br>
                            {{ trans('back.users') }}: {{ $membershipPlan->users()->count() }}
                            <a href="{{ route('admin.users.index', ['membershipPlan' => $membershipPlan->id]) }}">({{ trans('back.view') }})</a>
                        </div>

                        <!-- ORDER -->
                        <div class="col-sm-3">
                            <div class="margin-t-5 visible-xs"></div>
                            <span class="visible-xs">{{ trans('back.ORDER') }}: </span>{{ Form::text('order_'.$membershipPlan->id, $membershipPlan->order, ['class' => 'input-mini']) }}
                        </div>
                        <!-- ./ORDER -->

                        <!-- ACTIONS -->
                        <div class="col-sm-3">
                            <div class="margin-t-10 visible-xs"></div>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                        <i class="fa fa-cogs"></i> {{ trans('back.membership_plan_actions') }}
                                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-info">
                                        <li>
                                            <a href="{{ route('admin.membership-plans.edit', $membershipPlan->id); }}"><i class="fa fa-pencil"></i> {{ trans('back.edit') }}</a>
                                        </li>

                                        <li class="divider"></li>

                                        <li>
                                            <a href="{{ route('admin.membership-plans.destroy', $membershipPlan->id); }}" data-delete="{{ csrf_token() }}" data-confirm="{{ trans('back.delete_membership_plan_confirm') }}"><i class="fa fa-trash-o"></i> {{ trans('back.delete_membership_plan') }}</a>
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

    <h4 class="red">{{ trans('back.no_membership_plans_found') }}</h4>

@endif