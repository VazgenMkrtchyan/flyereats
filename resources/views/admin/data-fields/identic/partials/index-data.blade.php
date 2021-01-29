<!-- Form (for updating order)-->
{{ Form::open(['route' => ['admin.data_solo.update_order', $dataField], 'method' => 'PATCH']) }}

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

    @foreach ($values as $value)

        <tr>
            <td>

                <div class="row">

                    <div class="col-sm-6">
                        {{ trans('back.name') }}: <strong>{{ $value->name }}</strong> <br>
                        {{ trans('back.listings') }}: <strong>{{ $value->listingsNo }}</strong>
                    </div>

                    <!-- ORDER -->
                    <div class="col-sm-3">
                        <div class="margin-t-5 visible-xs"></div>
                        <span class="visible-xs">{{ trans('back.ORDER') }}: </span>{{ Form::text('order_'.$value->id, $value->order, ['class' => 'input-mini']) }}
                    </div>
                    <!-- ./ORDER -->


                    <!-- ACTIONS -->
                    <div class="col-sm-3">
                        <div class="margin-t-10 visible-xs"></div>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                    <i class="fa fa-cogs"></i> {{ trans('back.identic_actions', ['name' => str_singular($name)]) }}
                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                </button>

                                <ul class="dropdown-menu dropdown-info">
                                    <li>
                                        <a href="{{ route('admin.data_solo.edit', ['dataField' => $dataField, 'id' => $value->id]) }}"><i class="fa fa-pencil"></i> {{ trans('back.edit') }}</a>
                                    </li>

                                    <li class="divider"></li>

                                    <li>
                                        <a href="{{ route('admin.data_solo.destroy', ['dataField' => $dataField, 'id' => $value->id]) }}" data-delete="{{ csrf_token() }}" data-confirm="{{ trans('back.delete_identic_confirm', ['name' => str_singular($name)]) }}"><i class="fa fa-trash-o"></i> {{ trans('back.delete_identic', ['name' => str_singular($name)]) }}</a>
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


{{ str_replace('/?', '?', $values->render()) }}