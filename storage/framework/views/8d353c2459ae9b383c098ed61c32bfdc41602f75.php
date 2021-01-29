<footer>
    <div class="container">
        <div class="row">

            <div class="col-sm-3">
                <div class="title">ABOUT US</div>
                <div class="info">
                  <p> Welcome to Brighton</p>
                    <p><i class="fa fa-phone"></i>07952 980 603</p>
                    <p><i class="fa fa-envelope-o"></i>info@cardealerswebsites.co.uk</p>
                </div>
            </div>

            <div class="col-sm-3 clearfix">
                <div class="title"><?php echo trans('front.random_listings'); ?></div>

                <?php foreach($latestListings as $listing): ?>
                    <a href="<?php echo $listing->present()->seoUrl; ?>">
                        <div class="latest-listing clearfix">
                            <div class="listing-image">
                                <img src="<?php echo $listing->present()->mainThumbUrl; ?>">
                            </div>
                            <div class="listing-info">
                            <span class="latest-title">
                               <?php echo $listing->present()->listingName; ?>

                            </span>
                            <span class="latest-price">
                                <?php echo $listing->present()->listingPrice; ?>

                            </span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>

            </div>

            <div class="col-sm-3">
                <div class="title"><?php echo trans('front.social_links'); ?></div>
                <div class="social-link"><i class="fa fa-facebook-square"></i><a href="<?php echo appCon()->fb_url; ?>" target="_blank"><?php echo trans('front.find_FB'); ?></a></div>
                <div class="social-link"><i class="fa fa-twitter-square"></i><a href="<?php echo appCon()->tw_url; ?>" target="_blank"><?php echo trans('front.follow_TW'); ?></a></div>
            </div>

            <div class="col-sm-3">
                <div class="title"><?php echo trans('front.useful_links'); ?></div>
                <?php if(Auth::guest()): ?>
                    <div class="useful-link"><a href="<?php echo route('sessions.create'); ?>"><?php echo trans('front.sign_in'); ?></a></div>
                    <div class="useful-link"><a href="<?php echo route('register'); ?>"><?php echo trans('front.create_acc'); ?></a></div>
                <?php else: ?>
                    <div class="useful-link"><a href="<?php echo route('sessions.destroy'); ?>"><?php echo trans('front.log_out'); ?></a></div>
                <?php endif; ?>
                <div class="useful-link"><a href="<?php echo route('contactus.index'); ?>"><?php echo trans('front.contact_us'); ?></a></div>
                <div class="useful-link"><a href="<?php echo route('browselistings.index'); ?>"><?php echo trans('front.browse_listings'); ?></a></div>
                <div class="useful-link"><a href="<?php echo route('advanced-search.index'); ?>"><?php echo trans('front.advanced_search'); ?></a></div>
            </div>

        </div>
    </div>

    <div class="sub-footer">
        <div class="container">
            <div class="copyright">
                
                Copyright © 2019 | Car Dealer Websites. All Rights Reserved.
            
            </div>
        </div>
    </div>
</footer>