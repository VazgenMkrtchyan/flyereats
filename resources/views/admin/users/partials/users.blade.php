<!-- BOX -->
<div class="widget-box widget-color-blue2">
    <div class="widget-header">
        <h5 class="widget-title">
            <i class="ace-icon fa fa-user"></i>
            {{ trans('back.users') }}
            <span class="per_page">
                {{ Form::select('per_page', rangePerPage(), sessionOrWebc('ai_user_no', Route::currentRouteName()), ['class'=>'form-control']); }}
            </span>
        </h5>
    </div>

    <div class="widget-body">
        <div class="widget-main">

            {{ str_replace('/?', '?', $users->appends(Input::all())->render()) }}

            @if($users->count())

                <table class="table table-striped table-hover">
                    <tbody>

                    @foreach($users as $user)

                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-sm-6 bigger-110">
                                        {{ trans('back.user') }}: <strong>{{ $user->present()->fullName }}</strong><br>
                                        {{ trans('back.listings') }}: {{ $user->listings()->count() }} (<a href="{{ route('admin.listings.index', ['userId' => $user->id]) }}">{{ trans('back.view') }}</a>)<br>
                                        {{ trans('back.user_status') }}:
                                        @if ($user->isActiveUser())
                                            <span class="label label-success">{{ trans('back.active') }}</span>
                                        @else
                                            <span class="label label-danger">{{ trans('back.inactive') }}</span> | {{ trans('back.reasons') }}:
                                            @if (! $user->emailConfirmed())
                                                {{ trans('back.unconfirmed_email') }} |
                                            @endif
                                            @if (! $user->isApproved())
                                                {{ trans('back.moderation_status') }} ({{ trans('back.' . $user->st_moderation) }}) |
                                            @endif
                                            @if (! $user->hasActiveMembershipPlan())
                                                {{ trans('back.no_active_membership_plan') }} |
                                            @endif
                                        @endif
                                    </div>

                                    <!-- ACTIONS -->
                                    <div class="col-sm-6">
                                        <div class="margin-t-10 visible-xs"></div>
                                        <div class="pull-right">

                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                                    <i class="fa fa-cogs"></i> {{ trans('back.user_actions') }}
                                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                                </button>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a href="{{ route('admin.users.edit', $user->id) }}"><i class="fa fa-pencil"></i> {{ trans('back.edit') }}</a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.users.delete', $user->id) }}"><i class="fa fa-trash-o"></i> {{ trans('back.delete_user') }}</a>
                                                    </li>

                                                    <li class="divider"></li>

                                                    @if ($user->hasCompany())
                                                        <li>
                                                            <a href="{{ route('admin.company-profiles.edit', $user->compprofile->id) }}"><i class="fa fa-pencil"></i> {{ trans('back.edit_company_profile') }}</a>
                                                        </li>

                                                        <li>
                                                            <a href="{{ route('admin.company-profiles.destroy', $user->compprofile->id) }}" data-delete="{{ csrf_token() }}"><i class="fa fa-trash-o"></i> {{ trans('back.delete_company_profile') }}</a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="{{ route('admin.company-profiles.create', ['userId' => $user->id]) }}"><i class="fa fa-plus"></i> {{ trans('back.add_company_profile') }}</a>
                                                        </li>
                                                    @endif

                                                    <li>
                                                        <a href="{{ route('admin.listings.create', ['userId' => $user->id]) }}"><i class="fa fa-plus"></i> {{ trans('back.add_listing') }}</a>
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

                <h4 class="red">{{ trans('back.no_users_found') }}</h4>

            @endif

            {{ str_replace('/?', '?', $users->appends(Input::all())->render()) }}

        </div>
    </div>
</div>