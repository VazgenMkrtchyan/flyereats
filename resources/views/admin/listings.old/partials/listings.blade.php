<!-- BOX -->
<div class="widget-box widget-color-blue2">
    <div class="widget-header">
        <h5 class="widget-title">
            <i class="ace-icon fa fa-list"></i>
            {{ trans('back.listings') }}

            @if($user)
                of <strong>{{ $user->present()->fullName }}</strong> (<a href="{{ route('admin.users.index') }}" style="color: white">{{ trans('back.select_other_user') }}</a>) (<a href="{{ route('admin.listings.index', Input::except('userId')) }}" style="color: white">{{ trans('back.remove_user_filter') }}</a>)
            @endif

            <span class="per_page">
                {{ Form::select('per_page', rangePerPage(), sessionOrWebc('ai_list_no', Route::currentRouteName()), ['class'=>'form-control']); }}
            </span>
        </h5>
    </div>

    <div class="widget-body">
        <div class="widget-main">

            {{ str_replace('/?', '?', $listings->appends(Input::all())->render()) }}

            @if($listings->count())

                <div class="manage-listings">

                    <table class="table table-striped table-hover">
                        <tbody>

                        @foreach($listings as $listing)

                            <tr>
                                <td>

                                    <div class="row">

                                        <div class="col-sm-2">
                                            <div class="l-photo">
                                                <img src="{{ $listing->present()->mainThumbUrl }}" class="img-thumbnail">
                                                @if ($listing->isFeatured())
                                                    <span class="label label-danger">{{ trans('back.featured') }}</span>
                                                @endif
                                                @if ($listing->isHighlighted())
                                                    <span class="label label-warning">{{ trans('back.highlighted') }}</span>
                                                @endif
                                            </div>
                                            <div class="l-actions">

                                            </div>
                                        </div>

                                        <div class="col-sm-7 bigger-110">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    {{ $listing->present()->listingName }} - {{ $listing->present()->listingPrice }}
                                                    {{ $listing->present()->listingAddress }} <br>
                                                    {{ trans('back.seller') }}: {{ $listing->user->present()->fullName() }} <br>
                                                    {{ trans('back.created_at') }}: {{ format_date($listing->created_at) }}
                                                </div>
                                                {{ false }}

                                                <div class="col-sm-6">
                                                    @if (appCon()->listingPlansBased())
                                                        {{ trans('back.listing_plan') }}: {{ $listing->listing_plan_id ? $listing->listingPlan->name : trans('front.NONE') }} <br>
                                                        {{ trans('back.listing_exp_date') }}: {{ $listing->expires_on ? format_date($listing->expires_on) : trans('front.NEVER') }} <br>
                                                    @else
                                                        {{ trans('back.listing_exp_date') }}: {{ trans('back.when_membership_expires') }}<br>
                                                    @endif
                                                    {{ trans('back.listing_status') }}:
                                                    @if ($listing->isActiveListing())
                                                        <span class="label label-success">{{ trans('back.active') }}</span>
                                                    @else
                                                        <span class="label label-danger">{{ trans('back.inactive') }}</span> || {{ trans('back.reasons') }}:
                                                        @if ($listing->isArchived())
                                                            {{ trans('back.archived') }}
                                                        @endif
                                                        @if (! $listing->isApproved())
                                                            | {{ trans('back.moderation_status') }}: ({{ trans('back.' . $listing->st_moderation) }})
                                                        @endif
                                                        @if (! $listing->hasActiveListingPlan())
                                                           | {{ trans('back.no_active_plan') }}
                                                        @endif
                                                        @if (! $listing->user->isActiveUser())
                                                           | {{ trans('back.inactive_user') }}
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- ACTIONS -->
                                        <div class="col-sm-3">
                                            <div class="margin-t-10 visible-xs"></div>
                                            <div class="pull-right">
                                                <div class="btn-group">
                                                    <button data-toggle="dropdown" class="btn btn btn-white btn-primary dropdown-toggle">
                                                        <i class="fa fa-cogs"></i> {{ trans('back.listing_actions') }}
                                                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-info">
                                                        <li>
                                                            <a href="{{ route('admin.listings.edit', $listing->id) }}"><i class="fa fa-pencil"></i> {{ trans('back.edit') }}</a>
                                                        </li>

                                                        @if ($listing->isPending())
                                                            <li>
                                                                <a href="{{ route('admin.listings.approve', $listing->id) }}"><i class="fa fa-thumbs-o-up"></i> {{ trans('back.approve') }}</a>
                                                            </li>
                                                        @endif

                                                        @if (! $listing->isRejected())
                                                            <li>
                                                                <a href="{{ route('admin.listings.reject', $listing->id) }}"><i class="fa fa-ban"></i> {{ trans('back.reject') }}</a>
                                                            </li>
                                                        @endif

                                                        @if ($listing->isRejected())
                                                            <li>
                                                                <a href="{{ route('admin.listings.undoreject', $listing->id) }}"><i class="fa fa-undo"></i> {{ trans('back.undo_reject') }}</a>
                                                            </li>
                                                        @endif

                                                        <li class="divider"></li>

                                                        <li>
                                                            <a href="{{ route('admin.listings.destroy', $listing->id) }}" data-delete="{{ csrf_token(); }}" data-confirm="{{ trans('back.delete_listing_confirm') }}"><i class="fa fa-trash-o"></i> {{ trans('back.delete_listing') }}</a>
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

                </div>

            @else

                <h4 class="red">{{ trans('back.no_listings_found') }}</h4>

            @endif


            {{ str_replace('/?', '?', $listings->appends(Input::all())->render()) }}

        </div>
    </div>
</div>