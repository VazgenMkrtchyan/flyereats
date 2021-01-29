@foreach($userGroups as $userGroup)
    <div class="modal fade" id="pricing-modal-{{ $userGroup->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">
                        @if(appCon()->membershipPlansBased())
                            {{ trans('front.membership_plans_for', ['user_group' => $userGroup->name]) }}
                        @else
                            {{ trans('front.listing_plans_for', ['user_group' => $userGroup->name]) }}
                        @endif
                    </h3>
                </div>

                <div class="modal-body">

                    <div class="pricing-tables">
                        <div class="row">

                            @if(appCon()->membershipPlansBased())

                                @foreach($userGroup->membershipPlans()->ordered()->get() as $membershipPlan)
                                    <div class="col-sm-6 col-md-4">
                                        <div class="plan">

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

                                        </div>
                                    </div>
                                @endforeach

                            @else

                                @foreach($userGroup->listingPlans()->ordered()->get() as $listingPlan)
                                    <div class="col-sm-6 col-md-4">
                                        <div class="plan">

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

                                        </div>
                                    </div>
                                @endforeach

                            @endif

                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-main btn-fixed" data-dismiss="modal">{{ trans('front.close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endforeach