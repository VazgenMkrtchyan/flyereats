{{ str_replace('/?', '?', $permissions->render()) }}


<!-- Form (for updating order)-->
{{ Form::open(['route' => ['admin.permissions.update_order', $parent->id], 'method' => 'PATCH']) }}

<table id="simple-table" class="table table-striped table-hover">

    <thead class="hidden-xs">
    <tr>
        <th>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-6 bigger-110">
                    #ORDER
                </div>
            </div>
        </th>
    </tr>
    </thead>

    <tbody>

    @foreach ($permissions as $permission)

        <tr>
            <td>

                <div class="row">

                    <div class="col-sm-6">
                        Permission: <strong>{{ $permission->description }}</strong>
                    </div>

                    <!-- ORDER -->
                    <div class="col-sm-3">
                        <div class="margin-t-5 visible-xs"></div>
                        <span class="visible-xs">ORDER: </span>{{ Form::text('order_'.$permission->id, $permission->order, ['class' => 'input-mini']) }}
                    </div>
                    <!-- ./ORDER -->

                    <!-- ACTIONS -->
                    <div class="col-sm-3">
                        <div class="margin-t-10 visible-xs"></div>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                    <i class="fa fa-cogs"></i> Permission Actions
                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                </button>

                                <ul class="dropdown-menu dropdown-info">
                                    <li>
                                        <a href="{{ route('admin.permissions.edit', [$parent->id, $permission->id]) }}"><i class="fa fa-pencil"></i> Edit</a>
                                    </li>

                                    <li class="divider"></li>

                                    <li>
                                        <a href="{{ route('admin.permissions.destroy', $permission->id) }}" data-delete="{{ csrf_token() }}" data-confirm="Do you really want to delete selected Permission?"><i class="fa fa-trash-o"></i> Delete Permission</a>
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

{{ str_replace('/?', '?', $permissions->render()) }}