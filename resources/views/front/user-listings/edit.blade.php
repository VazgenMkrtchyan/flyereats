@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_edit_listing')))

@section('content')

    @if (! $listing->isActiveListing())
        <div class="alert alert-danger"><!-- SHOWS INACTIVITY REASONS -->
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

                    @else

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

                @endif
            </ul>
        </div>
    @endif

    <h1><i class="fa fa-pencil"></i> {{  trans('front.edit_listing') }}</h1>

    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#listing-data" aria-controls="listing-data" role="tab" data-toggle="tab"><i class="fa fa-cogs"></i> {{ trans('front.listing_details') }}</a></li>
        <li role="presentation"><a href="#listing-photos" aria-controls="listing-photos" role="tab" data-toggle="tab"><i class="fa fa-picture-o"></i> {{ trans('front.listing_photos') }}</a></li>
        @if (appCon()->listingPlansBased())
            <li role="presentation"><a href="#listing-plan" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-cog"></i> {{ trans('front.listing_plan') }}</a></li>
        @endif
       <!-- <li role="presentation"><a href="#listing-enhancement" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-star"></i> {{ trans('front.listing_enhancement') }}</a></li>-->
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="listing-data">

            {{ Form::model($listing, ['route' => ['userlistings.update', $listing->id], 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'form-val']) }}

            {{ Form::hidden('old_state_id', $listing->state_id) }}
            {{ Form::hidden('old_city', $listing->city) }}
            {{ Form::hidden('old_addr_1', $listing->addr_1) }}
            {{ Form::hidden('old_zip', $listing->zip) }}

            @include('front.user-listings.partials.listing-data')

            {{ Form::close() }}

        </div>

        <div role="tabpanel" class="tab-pane" id="listing-photos">
            @include('front.user-listings.partials.listing-photos')
        </div>

        @if (appCon()->listingPlansBased())
            <div role="tabpanel" class="tab-pane" id="listing-plan">
                @include('front.user-listings.partials.listing-plans')
            </div>
        @endif

        <!--<div role="tabpanel" class="tab-pane" id="listing-enhancement">
            @include('front.user-listings.partials.listing-enhancements')
        </div>-->
    </div>

@stop


@section('additional-scripts')
    @include('front.user-listings.js.js-listing-data')
    @include('front.user-listings.js.js-listing-photos')
@stop