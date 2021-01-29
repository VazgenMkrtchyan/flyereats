@if (! $listing->isActiveListing())
    <div class="bs-callout bs-callout-danger">
        {{ trans('front.only_active_enhanced') }}
    </div>

@else

    @if ($isFeatured = $listing->isFeatured() OR $listing->isHighlighted())
        <div class="bs-callout bs-callout-info">
            @if ($isFeatured)
                {{ trans('front.listing_is_featured') }}
            @else
                {{ trans('front.listing_is_highlighted') }}
            @endif
            <br>
            {{ trans('front.enhancement_expiration') }}: <strong>{{ $listing->present()->enhancementExpiration() }}</strong>
        </div>
    @endif

    <div class="bs-callout bs-callout-warning">
        {{ trans('front.highlighting_featuring_explanation') }}
    </div>

    <div class="row">
        <div class="col-xs-12">

            <h3><i class="fa fa-star"></i> {{ trans('front.featuring_plans') }}</h3>
            <div class="row">
                <div class="pricing-tables">
                    @foreach ($highFeatPlans['feat'] as $plan)
                        <div class="col-sm-6 col-md-4">
                            <div class="plan">

                                <div class="head">
                                    <h2>{{ trans('front.duration') }}: {{ $plan->duration }} {{ trans('front.days') }}</h2>
                                </div>

                                <div class="price">
                                    <h3>
                                        @if ($plan->price)
                                            <span class="symbol">{{ appCon()->curr_symb }}</span>{{ $plan->price }}
                                        @else
                                            {{ trans('front.FREE') }}
                                        @endif
                                    </h3>
                                </div>

                                <a href="{{ route('listingplans.proceed', ['listingId' => $listing->id, 'forId' => $plan->id, 'for' => 'listingFeat']) }}" class="btn btn-main">
                                    @if ($plan->price)
                                        <i class="fa fa-money"></i>
                                        {{ trans('front.FEATURE') }}
                                    @else
                                        {{ trans('front.select_free') }}
                                    @endif
                                    <i class="fa fa-star"></i>
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <h3><i class="fa fa-star-half-o"></i> {{ trans('front.highlighting_plans') }}</h3>
            <div class="row">
                <div class="pricing-tables">
                    @foreach ($highFeatPlans['high'] as $plan)
                        <div class="col-sm-6 col-md-4">
                            <div class="plan">

                                <div class="head">
                                    <h2>{{ trans('front.duration') }}:
                                        {{ $plan->duration }} {{ trans('front.days') }}
                                    </h2>
                                </div>

                                <div class="price">
                                    <h3>
                                        @if ($plan->price)
                                            <span class="symbol">{{ appCon()->curr_symb }}</span>{{ $plan->price }}
                                        @else
                                            {{ trans('front.FREE') }}
                                        @endif
                                    </h3>
                                </div>

                                <a href="{{ route('listingplans.proceed', ['listingId' => $listing->id, 'forId' => $plan->id, 'for' => 'listingHigh']) }}" class="btn btn-main">
                                    @if ($plan->price)
                                        <i class="fa fa-money"></i>
                                        {{ trans('front.HIGHLIGHT') }}
                                    @else
                                        {{ trans('front.select_free') }}
                                    @endif
                                    <i class="fa fa-star-half-o"></i>
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <div class="bs-callout bs-callout-warning">
        <i class="fa fa-money"></i> {{ trans('front.redirect_warning') }}
    </div>

@endif