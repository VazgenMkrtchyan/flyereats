<a href="{{ $listing->present()->seoUrl }}" class="listing">

    <div class="listing-data {{ $listgrid }}">

        <div class="img-wrapper">
            <div class="img-data">
                <i class="fa fa-spinner fa-pulse buffering"></i>
                <ul id="thumb-gal-{{ str_random(6) }}" class="thumb-gal loading">
                    @if (count($listing->photos))
                        @foreach($listing->photos->take( $listing->maxPhotosNo() == 'UNLIMITED' ? 1000 : $listing->maxPhotosNo() ) as $photo)
                            <li>
                                <img data-src="{{ $photo->present()->thumbUrl }}" src="{{ asset('templates/misc/thumb_empty.png') }}">
                            </li>
                        @endforeach
                    @else
                        <li>
                            <img data-src="{{ asset('templates/misc/no_listing_photo_thumb.png') }}" src="{{ asset('templates/misc/thumb_empty.png') }}">
                        </li>
                    @endif
                </ul>

                <!--<span class="plus-sign">+</span>-->
                @if ($listing->isFeatured())
                    <span class="badge featured">Sold</span>
                @elseif ($listing->isHighlighted())
                    <span class="badge">Highlighted</span>
                @endif
            </div>
        </div>

        <div class="title">{{ $listing->present()->listingName }}</div>

        <table class="info-table">
            <tr>
                <td class="option">Year:</td>
                <td class="info">{{ $listing->year }}</td>
            </tr>
            <tr>
                <td class="option">Mileage:</td>
                <td class="spec">{{ $listing->present()->carMileage }}</td>
            </tr>
            <tr>
                <td class="option">Fuel Type:</td>
                <td class="spec">{{ $listing->present()->carFuelType }}</td>
            </tr>
            <tr>
                <td class="option">Transmission:</td>
                <td class="spec">{{ $listing->present()->carTransmission }}</td>
            </tr>
        </table>

        <div class="visible-lg">
            <table class="info-table secondary">
                <tr>
                    <td class="option">Body Type:</td>
                    <td class="info">{{ $listing->present()->carCondition }}</td>
                </tr>
                <tr>
                    <td class="option">Drive Type:</td>
                    <td class="spec">{{ $listing->present()->carDriveType }}</td>
                </tr>
                <tr>
                    <td class="option">Exterior Color:</td>
                    <td class="spec">{{ $listing->present()->carExtColor }}</td>
                </tr>
                <tr>
                    <td class="option">Interior Color:</td>
                    <td class="spec">{{ $listing->present()->carIntColor }}</td>
                </tr>
            </table>
        </div>

        <div class="clearfix block-bottom-footer">
            <div class="price-info">
                {{ $listing->present()->listingPrice }}
            </div>

            @if ($listing->isSeen())
                <div class="listing-seen">
                    <i class="fa fa-history" title="{{ trans('front.already_seen') }}"></i>
                </div>
            @endif

            <div class="listing-love" data-love-listing="{{ route('love_listing', $listing->id) }}">
                @if ($listing->isLoved())
                    <i class="fa fa-heart" title="{{ trans('front.undo') }}"></i>
                @else
                    <i class="fa fa-heart-o" title="{{ trans('front.love') }}"></i>
                @endif
            </div>
        </div>

    </div>

</a>