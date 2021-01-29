<?php if(! $listing->isActiveListing()): ?>
    <div class="bs-callout bs-callout-danger">
        <?php echo trans('front.only_active_enhanced'); ?>

    </div>

<?php else: ?>

    <?php if($isFeatured = $listing->isFeatured() OR $listing->isHighlighted()): ?>
        <div class="bs-callout bs-callout-info">
            <?php if($isFeatured): ?>
                <?php echo trans('front.listing_is_featured'); ?>

            <?php else: ?>
                <?php echo trans('front.listing_is_highlighted'); ?>

            <?php endif; ?>
            <br>
            <?php echo trans('front.enhancement_expiration'); ?>: <strong><?php echo $listing->present()->enhancementExpiration(); ?></strong>
        </div>
    <?php endif; ?>

    <div class="bs-callout bs-callout-warning">
        <?php echo trans('front.highlighting_featuring_explanation'); ?>

    </div>

    <div class="row">
        <div class="col-xs-12">

            <h3><i class="fa fa-star"></i> <?php echo trans('front.featuring_plans'); ?></h3>
            <div class="row">
                <div class="pricing-tables">
                    <?php foreach($highFeatPlans['feat'] as $plan): ?>
                        <div class="col-sm-6 col-md-4">
                            <div class="plan">

                                <div class="head">
                                    <h2><?php echo trans('front.duration'); ?>: <?php echo $plan->duration; ?> <?php echo trans('front.days'); ?></h2>
                                </div>

                                <div class="price">
                                    <h3>
                                        <?php if($plan->price): ?>
                                            <span class="symbol"><?php echo appCon()->curr_symb; ?></span><?php echo $plan->price; ?>

                                        <?php else: ?>
                                            <?php echo trans('front.FREE'); ?>

                                        <?php endif; ?>
                                    </h3>
                                </div>

                                <a href="<?php echo route('listingplans.proceed', ['listingId' => $listing->id, 'forId' => $plan->id, 'for' => 'listingFeat']); ?>" class="btn btn-main">
                                    <?php if($plan->price): ?>
                                        <i class="fa fa-money"></i>
                                        <?php echo trans('front.FEATURE'); ?>

                                    <?php else: ?>
                                        <?php echo trans('front.select_free'); ?>

                                    <?php endif; ?>
                                    <i class="fa fa-star"></i>
                                </a>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <h3><i class="fa fa-star-half-o"></i> <?php echo trans('front.highlighting_plans'); ?></h3>
            <div class="row">
                <div class="pricing-tables">
                    <?php foreach($highFeatPlans['high'] as $plan): ?>
                        <div class="col-sm-6 col-md-4">
                            <div class="plan">

                                <div class="head">
                                    <h2><?php echo trans('front.duration'); ?>:
                                        <?php echo $plan->duration; ?> <?php echo trans('front.days'); ?>

                                    </h2>
                                </div>

                                <div class="price">
                                    <h3>
                                        <?php if($plan->price): ?>
                                            <span class="symbol"><?php echo appCon()->curr_symb; ?></span><?php echo $plan->price; ?>

                                        <?php else: ?>
                                            <?php echo trans('front.FREE'); ?>

                                        <?php endif; ?>
                                    </h3>
                                </div>

                                <a href="<?php echo route('listingplans.proceed', ['listingId' => $listing->id, 'forId' => $plan->id, 'for' => 'listingHigh']); ?>" class="btn btn-main">
                                    <?php if($plan->price): ?>
                                        <i class="fa fa-money"></i>
                                        <?php echo trans('front.HIGHLIGHT'); ?>

                                    <?php else: ?>
                                        <?php echo trans('front.select_free'); ?>

                                    <?php endif; ?>
                                    <i class="fa fa-star-half-o"></i>
                                </a>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>

    <div class="bs-callout bs-callout-warning">
        <i class="fa fa-money"></i> <?php echo trans('front.redirect_warning'); ?>

    </div>

<?php endif; ?>