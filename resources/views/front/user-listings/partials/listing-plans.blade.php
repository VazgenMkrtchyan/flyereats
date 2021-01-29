@if ($listing->hasActiveListingPlan())
    <div class="bs-callout bs-callout-info">
        <strong>{{ trans('front.listing_plan') }}:</strong> {{ $listing->listingPlan->name }}<br>
        <strong>{{ trans('front.listing_expiration') }}:</strong> {{ $listing->present()->expirationDate() }}
        <p><br><strong>({{ trans('front.select_current_will_extend') }})</strong></p>
    </div>
@else
    <div class="bs-callout bs-callout-danger">
        {{ trans('front.listing_no_active_plan') }}
    </div>
@endif

<div class="pricing-tables">
    <div class="row">
        @foreach($listingPlans as $listingPlan)
            <div class="col-sm-6 col-md-4">
                <div class="plan @if($listingPlan->isCurrent($listing)) recommended @endif">

                    <div class="head">
                        <h2>{{ $listingPlan->name }}</h2>
                    </div>

                    <ul class="item-list">
                        <li><strong>{{ trans('front.duration') }}:</strong>
                            @if ($duration = $listingPlan->duration)
                                {{ $duration }} {{ trans('front.days') }}
                            @else
                                {{ trans('front.PERPETUAL') }}
                            @endif
                        </li>
                        <li><strong>{{ trans('front.max_photos') }}:</strong>
                            @if ($maxP = $listingPlan->max_photos)
                                {{ $maxP }}
                            @else
                                {{ trans('front.UNLIMITED') }}
                            @endif
                        </li>
                        <li><strong>{{ trans('front.max_listings') }}:</strong>
                            @if ($maxL = $listingPlan->max_listings)
                                {{ $maxL }}
                            @else
                                {{ trans('front.UNLIMITED') }}
                            @endif
                        </li>
                    </ul>

                    <div class="price">
                        <h3>
                            @if ($listingPlan->price)
                                <span class="symbol">{{ appCon()->curr_symb }}</span>{{ $listingPlan->price }}
                            @else
                                {{ trans('front.FREE') }}
                            @endif
                        </h3>
                    </div>

                    <a href="{{ route('listingplans.proceed', ['listingId' => $listing->id, 'forId' => $listingPlan->id, 'for' => 'listingPlan']) }}" class="btn btn-main" @if(! $listingPlan->allowSelect($listing)) disabled @endif>
                        @if ($listingPlan->price)
                            <i class="fa fa-money"></i>
                        @endif
                        @if ($listingPlan->isCurrent($listing))
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
