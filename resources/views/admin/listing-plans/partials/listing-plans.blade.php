@if($userGroup->listingPlans->count())

    <!-- Form (for updating order)-->
    {{ Form::open(['route' => 'admin.listing-plans.updateorder', 'method' => 'PATCH']) }}

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
        @foreach($userGroup->listingPlans()->ordered()->get() as $listingPlan)

            <tr>
                <td>

                    <div class="row">

                        <div class="col-sm-6 bigger-110">
                            {{ trans('back.name') }}: <strong>{{ $listingPlan->name }}</strong> <br>
                            {{ trans('back.listings') }}: {{ $listingPlan->listings()->count() }}
                            @if($listingPlan->listings->count()) <a href="{{ route('admin.listings.index', ['listingPlan' => $listingPlan->id]) }}">({{ trans('back.view') }})</a> @endif
                        </div>

                        <!-- ORDER -->
                        <div class="col-sm-3">
                            <div class="margin-t-5 visible-xs"></div>
                            <span class="visible-xs">{{ trans('back.ORDER') }}: </span>{{ Form::text('order_'.$listingPlan->id, $listingPlan->order, ['class' => 'input-mini']) }}
                        </div>
                        <!-- ./ORDER -->

                        <!-- ACTIONS -->
                        <div class="col-sm-3">
                            <div class="margin-t-10 visible-xs"></div>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                        <i class="fa fa-cogs"></i> {{ trans('back.listing_plan_actions') }}
                                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-info">
                                        <li>
                                            <a href="{{ route('admin.listing-plans.edit', $listingPlan->id); }}"><i class="fa fa-pencil"></i> {{ trans('back.edit') }}</a>
                                        </li>

                                        <li class="divider"></li>

                                        <li>
                                            <a href="{{ route('admin.listing-plans.destroy', $listingPlan->id); }}" data-delete="{{ csrf_token() }}" data-confirm="{{ trans('back.delete_listing_plan_confirm') }}"><i class="fa fa-trash-o"></i> {{ trans('back.delete_listing_plan') }}</a>
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

    <h4 class="red">{{ trans('back.no_listing_plans_found') }}</h4>

@endif
