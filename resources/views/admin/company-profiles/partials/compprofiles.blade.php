<!-- BOX -->
<div class="widget-box widget-color-blue2">
    <div class="widget-header">
        <h5 class="widget-title">
            <i class="ace-icon fa fa-briefcase"></i>
            {{ trans('back.company_profiles') }}
            <span class="per_page">
                {{ Form::select('per_page', rangePerPage(), sessionOrWebc('ai_compprofiles_no', Route::currentRouteName()), ['class'=>'form-control']); }}
            </span>
        </h5>
    </div>

    {{ str_replace('/?', '?', $compprofiles->appends(Input::all())->render()) }}

    <div class="widget-body">
        <div class="widget-main">

            @if($compprofiles->count())

                <table class="table table-striped table-hover">
                    <tbody>

                    @foreach($compprofiles as $compprofile)

                        <tr>
                            <td>
                                <div class="row">

                                    <div class="col-sm-9 bigger-110">
                                        {{ trans('back.company_name') }}: <strong>{{ $compprofile->name }}</strong>
                                    </div>

                                    <!-- ACTIONS -->
                                    <div class="col-sm-3">
                                        <div class="margin-t-10 visible-xs"></div>
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                                    <i class="fa fa-cogs"></i> {{ trans('back.company_actions') }}
                                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                                </button>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a href="{{ route('admin.company-profiles.edit', $compprofile->id); }}"><i class="fa fa-pencil"></i> {{ trans('back.edit') }}</a>
                                                    </li>

                                                    <li class="divider"></li>

                                                    <li>
                                                        <a href="{{ route('admin.company-profiles.destroy', $compprofile->id); }}" data-delete="{{ csrf_token() }}" data-confirm="{{ trans('back.delete_company_confirm') }}"><i class="fa fa-trash-o"></i> {{ trans('back.delete_company') }}</a>
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

                <h4 class="red">{{ trans('back.no_companies_found') }}</h4>

            @endif

            {{ str_replace('/?', '?', $compprofiles->appends(Input::all())->render()) }}

        </div>
    </div>
</div>