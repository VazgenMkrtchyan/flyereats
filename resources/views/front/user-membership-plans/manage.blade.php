@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_manage_membership')))

@section('content')

    <h1><i class="fa fa-cogs"></i> {{ trans('front.manage_membership_plan') }}</h1>

    @if ($user->hasActiveMembershipPlan())
        <div class="bs-callout bs-callout-info">
            <strong>{{ trans('front.current_plan') }}:</strong> {{ $user->membershipPlan->name }}<br>
            <strong>{{ trans('front.membership_expiration') }}:</strong> {{ $user->present()->expirationDate() }}
            <p><br><strong>({{ trans('front.select_current_will_extend') }})</strong></p>
        </div>

        <div class="bs-callout bs-callout-info">
            <strong>{{ trans('front.note') }}:</strong> {{ trans('front.changing_plan_will_archive') }}
        </div>
    @else
        <div class="bs-callout bs-callout-info">
            You have no active Membership Plan. Please select a plan!
        </div>
    @endif

    <div class="row">
        <div class="col-xs-12">
            <div class="pricing-tables">
                <div class="row">
                    @foreach($membershipPlans as $membershipPlan)
                        <div class="col-sm-6 col-md-4">
                            <div class="plan @if($membershipPlan->isCurrent()) recommended @endif">

                                <div class="head">
                                    <h2>{{ $membershipPlan->name }}</h2>
                                </div>

                                <ul class="item-list">
                                    <li><strong>{{ trans('front.duration') }}:</strong>
                                        @if ($duration = $membershipPlan->duration)
                                            {{ $duration }} {{ trans('front.days') }}
                                        @else
                                            {{ trans('front.PERPETUAL') }}
                                        @endif
                                    </li>
                                    <li><strong>{{ trans('front.max_listings') }}:</strong>
                                        @if ($maxL = $membershipPlan->max_listings)
                                            {{ $maxL }}
                                        @else
                                            {{ trans('front.UNLIMITED') }}
                                        @endif
                                    </li>
                                    <li><strong>{{ trans('front.max_photos_per_listing') }}:</strong>
                                        @if ($maxP = $membershipPlan->max_photos)
                                            {{ $maxP }}
                                        @else
                                            {{ trans('front.UNLIMITED') }}
                                        @endif
                                    </li>
                                    <li>
                                        <strong>{{ trans('front.usable_once') }}:</strong>
                                        @if ($membershipPlan->usable_once)
                                            {{ trans('front.yes') }}
                                        @else
                                            {{ trans('front.no') }}
                                        @endif
                                    </li>
                                </ul>

                                <div class="price">
                                    <h3>
                                        @if ($price = $membershipPlan->price)
                                            <span class="symbol">{{ appCon()->curr_symb }}</span>{{ $price }}
                                        @else
                                            {{ trans('front.FREE') }}
                                        @endif
                                    </h3>
                                </div>

                                <a href="{{ route('membershipplans.proceed', $membershipPlan->id) }}" class="btn btn-main" @if (! $membershipPlan->allowSelect()) disabled @endif>
                                    @if ($membershipPlan->price)
                                        <i class="fa fa-money"></i>
                                    @endif
                                    @if ($membershipPlan->isCurrent())
                                        {{ trans('front.extend_plan') }}
                                        <i class="fa fa-refresh"></i>
                                    @else
                                        {{ trans('front.select_and_proceed') }}
                                        <i class="fa fa-chevron-right"></i>
                                    @endif
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bs-callout bs-callout-warning">
                <i class="fa fa-money"></i> {{ trans('front.redirect_warning') }}
            </div>
        </div>
    </div>

@stop
