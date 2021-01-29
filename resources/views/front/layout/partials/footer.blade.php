<footer>
    <div class="container">
        <div class="row">

            <div class="col-sm-3">
                <div class="title">ABOUT US</div>
                <div class="info">
                  <p> </p>
                  <p><i class="fa fa-map-marker"></i></p>
                    <p><i class="fa fa-phone"></i></p>
                                        <p><i class="fa fa-envelope-o"></i></p>

                </div>
            </div>

            <div class="col-sm-3 clearfix">
                <div class="title">OUR STOCK</div>

                @foreach($latestListings as $listing)
                    <a href="{{ $listing->present()->seoUrl }}">
                        <div class="latest-listing clearfix">
                            <div class="listing-image">
                                <img src="{{ $listing->present()->mainThumbUrl }}">
                            </div>
                            <div class="listing-info">
                            <span class="latest-title">
                               {{ $listing->present()->listingName }}
                            </span>
                            <span class="latest-price">
                                {{ $listing->present()->listingPrice }}
                            </span>
                            </div>
                        </div>
                    </a>
                @endforeach
 
            </div>

            <div class="col-sm-3">
                <div class="title">{{ trans('front.social_links') }}</div>
                <div class="social-link"><i class="fa fa-facebook-square"></i><a href="#" target="_blank">{{ trans('front.find_FB') }}</a></div>
                <div class="social-link"><i class="fa fa-twitter-square"></i><a href="#" target="_blank">{{ trans('front.follow_TW') }}</a></div>
                <div class="social-link"><i class="fa fa-youtube"></i><a href="#" target="_blank">Follow us on Youtube</a></div>
                <div class="social-link"><i class="fa fa-instagram"></i><a href="#" target="_blank">Follow us on Instagram</a></div>

            </div>

            <div class="col-sm-3">
                <div class="title">{{ trans('front.useful_links') }}</div>
                @if(Auth::guest())
                    <div class="useful-link"><a href="https://carsaleweb.co.uk/brighton/admin/login">{{ trans('front.sign_in') }}</a></div>
                    <!--<div class="useful-link"><a href="{{ route('register') }}">{{ trans('front.create_acc') }}</a></div>-->
                @else
                    <div class="useful-link"><a href="{{ route('sessions.destroy') }}">{{ trans('front.log_out') }}</a></div>
                @endif
                <div class="useful-link"><a href="{{ route('contactus.index') }}">{{ trans('front.contact_us') }}</a></div>
                <div class="useful-link"><a href="{{ route('browselistings.index') }}">{{ trans('front.browse_listings') }}</a></div>
                <div class="useful-link"><a href="{{ route('advanced-search.index') }}">{{ trans('front.advanced_search') }}</a></div>
            </div>

        </div>
    </div>

    <div class="sub-footer">
        <div class="container">
           <!-- <div class="copyright">
                
                Copyright © 2020 <a href="https://cardealerswebsites.co.uk" target="_blank">Car Dealer Websites</a> All Rights Reserved.
            
            </div>-->
        </div>
    </div>
</footer>