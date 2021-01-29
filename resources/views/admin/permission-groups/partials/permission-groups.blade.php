{{ str_replace('/?', '?', $permissionGroups->render()) }}

<!-- Form (for updating order)-->
{{ Form::open(['route' => 'admin.permission-groups.update_order', 'method' => 'PATCH']) }}

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

    @foreach ($permissionGroups as $permissionGroup)

        <tr>
            <td>

                <div class="row">

                    <div class="col-sm-6">
                        {{ trans('back.group_name') }}: <strong>{{ $permissionGroup->name }}</strong> <br>
                        {{ trans('back.permissions') }}: <strong>{{ $permissionGroup->permissionsNo }}</strong> <a href="{{ route('admin.permissions.index', $permissionGroup->id) }}" class="btn btn-white btn-success btn-bold btn-minier">{{ trans('back.browse_permissions') }}</a>
                    </div>

                    <!-- ORDER -->
                    <div class="col-sm-3">
                        <div class="margin-t-5 visible-xs"></div>
                        <span class="visible-xs">{{ trans('back.ORDER') }}: </span>{{ Form::text('order_'.$permissionGroup->id, $permissionGroup->order, ['class' => 'input-mini']) }}
                    </div>
                    <!-- ./ORDER -->

                    <!-- ACTIONS -->
                    <div class="col-sm-3">
                        <div class="margin-t-10 visible-xs"></div>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                    <i class="fa fa-cogs"></i> {{ trans('back.group_actions') }}
                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                </button>

                                <ul class="dropdown-menu dropdown-info">
                                    <li>
                                        <a href="{{ route('admin.permission-groups.edit', $permissionGroup->id) }}"><i class="fa fa-pencil"></i> {{ trans('back.edit') }}</a>
                                    </li>

                                    <li class="divider"></li>

                                    <li>
                                        <a href="{{ route('admin.permission-groups.destroy', $permissionGroup->id) }}" data-delete="{{ csrf_token() }}" data-confirm="{{ trans('back.delete_group_confirm') }}"><i class="fa fa-trash-o"></i> {{ trans('back.delete_group') }}</a>
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
<!-- End of form -->

{{ str_replace('/?', '?', $permissionGroups->render()) }}