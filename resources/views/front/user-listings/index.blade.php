@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_user_listings')))

@section('content')

    @include('front.partials.alert-no-active-membership-plan')

    <div class="user-listings">

        <div class="top">
            <i class="fa fa-list"></i> {{ trans('front.your_listings') }}
            <div class="dropdown">
                <button class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    @if (Input::get('show') == 'active')
                        {{ trans('front.active') }} ({{ $listingsCount['active'] }})
                    @elseif(Input::get('show') == 'inactive')
                        {{ trans('front.inactive') }} ({{ $listingsCount['inactive'] }})
                    @elseif(Input::get('show') == 'archived')
                        {{ trans('front.archived') }} ({{ $listingsCount['archived'] }})
                    @else
                        {{ trans('front.all') }} ({{ $listingsCount['all'] }})
                    @endif
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('userlistings.index') }}">{{ trans('front.all') }} ({{ $listingsCount['all'] }})</a></li>
                    <li><a href="{{ route('userlistings.index', ['show' => 'active']) }}">{{ trans('front.active') }} ({{ $listingsCount['active'] }})</a></li>
                    <li><a href="{{ route('userlistings.index', ['show' => 'inactive']) }}">{{ trans('front.inactive') }} ({{ $listingsCount['inactive'] }})</a></li>
                    <li><a href="{{ route('userlistings.index', ['show' => 'archived']) }}">{{ trans('front.archived') }} ({{ $listingsCount['archived'] }})</a></li>
                </ul>
            </div>
        </div>

        @if ($listings->count())

            @foreach($listings as $listing)

                <div class="row">
                    <div class="listing clearfix">

                        <div class="col-sm-2">
                            <img src="{{ $listing->present()->mainThumbUrl }}" class="img-responsive">
                        </div>

                        <div class="col-sm-4">
                            <strong>{{ $listing->present()->listingName }}</strong>
                            <a href="{{ $listing->present()->seoUrl }}" target="_blank">({{ trans('front.view') }})</a> <br>
                            <strong>{{ trans('front.price') }}:</strong> {{ $listing->present()->listingPrice }} <br>
                            <strong>{{ trans('front.mileage') }}:</strong> {{ $listing->present()->carMileage }} <br>
                            <strong>{{ trans('front.transmission') }}:</strong> {{ $listing->present()->carTransmission }} <br>
                        </div>

                        <div class="col-sm-4">
                            @if ($listing->isActiveListing())

                                <strong>{{ trans('front.listing_status') }}:</strong> <span class="label label-success">{{ trans('front.active') }}</span><br>

                                <strong>{{ trans('front.listing_expiration') }}:</strong> {{ $listing->present()->expirationDate() }}

                                @if (appCon()->listingPlansBased())
                                    <br><strong>{{ trans('front.listing_plan') }}:</strong> {{ $listing->listingPlan->name }}
                                @endif

                            @else

                                <strong>{{ trans('front.listing_status') }}:</strong> <span class="label label-danger">{{ trans('front.inactive') }}</span><br>
                                <strong>{{ trans('front.reasons') }}:</strong>
                                <ul>
                                    @if ($listing->isRejected())
                                        <li>
                                            {{ trans('front.moderation_status') }}: <span class="label label-danger">{{ trans('front.rejected') }}</span>
                                        </li>

                                    @else

                                        @if (appCon()->membershipPlansBased())
                                            @if (! $listing->user->hasActiveMembershipPlan())
                                                <li>
                                                    {{ trans('front.no_active_membership') }}
                                                </li>
                                            @elseif ($listing->isPending())
                                                <li>
                                                    {{ trans('front.moderation_status') }}: <span class="label label-danger">{{ trans('front.pending') }}</span>
                                                </li>
                                            @endif
                                        @endif

                                        @if (appCon()->listingPlansBased())
                                            @if (! $listing->hasActiveListingPlan())
                                                <li>
                                                    {{ trans('front.no_active_plan') }}
                                                </li>
                                            @elseif ($listing->isPending())
                                                <li>
                                                    {{ trans('front.moderation_status') }}: <span class="label label-danger">{{ trans('front.pending') }}</span>
                                                </li>
                                            @endif
                                        @endif

                                        @if ($listing->isArchived())
                                            <li>
                                                {{ trans('front.is_archived') }}
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                            @endif

                        </div>

                        <div class="col-sm-2">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-cogs"></i> {{ trans('front.listing_actions') }}
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    @if (Auth::user()->hasActiveMembershipPlan())
                                        @if (! $listing->isArchived())
                                            <li><a href="{{ route('userlistings.edit', $listing->id) }}"><i class="fa fa-pencil"></i> {{ trans('front.edit') }}</a></li>
                                        @endif
                                        @if ($listing->isArchived())
                                            <li><a href="{{ route('userlistings.restore', $listing->id) }}"><i class="fa fa-undo"></i> {{ trans('front.restore') }}</a></li>
                                        @endif
                                        <li class="divider"></li>
                                        @if (! $listing->isArchived())
                                            <li><a href="{{ route('userlistings.archive', $listing->id) }}"><i class="fa fa-floppy-o"></i> {{ trans('front.archive') }}</a></li>
                                        @endif
                                    @endif
                                    <li><a href="{{ route('userlistings.destroy', $listing->id) }}" data-delete="{{ csrf_token(); }}" data-confirm="{{ trans('front.del_listing_conf') }}"><i class="fa fa-trash-o"></i> {{ trans('front.delete') }}</a></li>
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>

            @endforeach

        @else
            <div>
                {{ trans('front.no_listings_found') }}
            </div>

        @endif

    </div>

@stop


@section('additional-scripts')
    @include('admin.js.destroy')
@stop