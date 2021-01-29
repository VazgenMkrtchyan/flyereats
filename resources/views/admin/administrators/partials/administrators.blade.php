<!-- BOX -->
<div class="widget-box widget-color-blue2">
    <div class="widget-header">
        <h5 class="widget-title">
            <i class="ace-icon fa fa-male"></i>
            {{ trans('back.administrators') }}
            <span class="per_page">
                {{ Form::select('per_page', rangePerPage(), sessionOrWebc('ai_administrators_no', Route::currentRouteName()), ['class'=>'form-control']); }}
            </span>
        </h5>
    </div>

    <div class="widget-body">
        <div class="widget-main">

            @if($administrators->count())

                <table class="table table-striped table-hover">
                    <tbody>

                    @foreach($administrators as $administrator)

                        <tr>
                            <td>
                                <div class="row">

                                    <div class="col-xs-9 bigger-110">
                                        {{ trans('back.administrator') }}: <strong>{{ $administrator->first_name }} {{ $administrator->last_name }}</strong>
                                    </div>

                                    <!-- ACTIONS -->
                                    <div class="col-sm-3">
                                        <div class="pull-right">
                                            <div class="margin-t-10 visible-xs"></div>
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                                    <i class="fa fa-cogs"></i> {{ trans('back.administrator_actions') }}
                                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                                </button>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a href="{{ route('admin.administrators.edit', $administrator->id) }}"><i class="fa fa-pencil"></i> {{ trans('back.edit') }}</a>
                                                    </li>

                                                    <li class="divider"></li>

                                                    <li>
                                                        <a href="{{ route('admin.administrators.destroy', $administrator->id); }}" data-delete="{{ csrf_token() }}" data-confirm="{{ trans('back.delete_administrator_confirm') }}"><i class="fa fa-trash-o"></i> {{ trans('back.delete_administrator') }}</a>
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

            @else

                <h4 class="red">{{ trans('back.no_administrators_found') }}</h4>

            @endif

            {{ str_replace('/?', '?', $administrators->appends(Input::all())->render()) }}

        </div>
    </div>
</div>