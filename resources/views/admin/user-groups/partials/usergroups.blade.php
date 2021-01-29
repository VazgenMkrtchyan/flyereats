<!-- BOX -->
<div class="widget-box widget-color-blue2">
    <div class="widget-header">
        <h5 class="widget-title">
            <i class="ace-icon fa fa-list"></i>
            {{ trans('back.user_groups') }}
        </h5>
    </div>

    <div class="widget-body">
        <div class="widget-main">

            @if($userGroups->count())

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
                    <!-- Form (for updating order)-->
                    {{ Form::open(['route' => 'admin.user-groups.updateorder', 'method' => 'PATCH']) }}

                    @foreach($userGroups as $userGroup)

                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-sm-6 bigger-110">
                                        {{ trans('back.user_group_name') }}: <strong>{{ $userGroup->name }}</strong> <br>
                                        {{ trans('back.users') }}: {{ $userGroup->users()->count() }}
                                        <a href="{{ route('admin.users.index', ['userGroup' => $userGroup->id]) }}">({{ trans('back.view') }})</a>
                                    </div>

                                    <!-- ORDER -->
                                    <div class="col-sm-3">
                                        <div class="margin-t-5 visible-xs"></div>
                                        <span class="visible-xs">{{ trans('back.ORDER') }}: </span>{{ Form::text('order_'.$userGroup->id, $userGroup->order, ['class' => 'input-mini']) }}
                                    </div>
                                    <!-- ./ORDER -->

                                    <!-- ACTIONS -->
                                    <div class="col-sm-3">
                                        <div class="margin-t-10 visible-xs"></div>
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                                    <i class="fa fa-cogs"></i> {{ trans('back.user_group_actions') }}
                                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                                </button>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a href="{{ route('admin.user-groups.edit', $userGroup->id); }}"><i class="fa fa-pencil"></i> {{ trans('back.edit') }}</a>
                                                    </li>

                                                    <li class="divider"></li>

                                                    <li>
                                                        <a href="{{ route('admin.user-groups.destroy', $userGroup->id); }}" data-delete="{{ csrf_token() }}" data-confirm="{{ trans('back.delete_user_group_confirm') }}"><i class="fa fa-trash-o"></i> {{ trans('back.delete_user_group') }}</a>
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
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i> Update Order</button>
                    </div>
                </div>

                {{ Form::close() }}
                <!-- End of form -->

                <div class="clearfix"></div>

            @else

                <h4 class="red">No User Groups found!</h4>

            @endif

        </div>
    </div>
</div>