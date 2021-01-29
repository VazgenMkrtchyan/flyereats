<?php foreach($userGroups as $userGroup): ?>
    <div class="modal fade" id="pricing-modal-<?php echo $userGroup->id; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">
                        <?php if(appCon()->membershipPlansBased()): ?>
                            <?php echo trans('front.membership_plans_for', ['user_group' => $userGroup->name]); ?>

                        <?php else: ?>
                            <?php echo trans('front.listing_plans_for', ['user_group' => $userGroup->name]); ?>

                        <?php endif; ?>
                    </h3>
                </div>

                <div class="modal-body">

                    <div class="pricing-tables">
                        <div class="row">

                            <?php if(appCon()->membershipPlansBased()): ?>

                                <?php foreach($userGroup->membershipPlans()->ordered()->get() as $membershipPlan): ?>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="plan">

                                            <div class="head">
                                                <h2><?php echo $membershipPlan->name; ?></h2>
                                            </div>

                                            <ul class="item-list">
                                                <li><strong><?php echo trans('front.duration'); ?>:</strong>
                                                    <?php if($duration = $membershipPlan->duration): ?>
                                                        <?php echo $duration; ?> <?php echo trans('front.days'); ?>

                                                    <?php else: ?>
                                                        <?php echo trans('front.PERPETUAL'); ?>

                                                    <?php endif; ?>
                                                </li>
                                                <li><strong><?php echo trans('front.max_listings'); ?>:</strong>
                                                    <?php if($maxL = $membershipPlan->max_listings): ?>
                                                        <?php echo $maxL; ?>

                                                    <?php else: ?>
                                                        <?php echo trans('front.UNLIMITED'); ?>

                                                    <?php endif; ?>
                                                </li>
                                                <li><strong><?php echo trans('front.max_photos_per_listing'); ?>:</strong>
                                                    <?php if($maxP = $membershipPlan->max_photos): ?>
                                                        <?php echo $maxP; ?>

                                                    <?php else: ?>
                                                        <?php echo trans('front.UNLIMITED'); ?>

                                                    <?php endif; ?>
                                                </li>
                                                <li>
                                                    <strong><?php echo trans('front.usable_once'); ?>:</strong>
                                                    <?php if($membershipPlan->usable_once): ?>
                                                        <?php echo trans('front.yes'); ?>

                                                    <?php else: ?>
                                                        <?php echo trans('front.no'); ?>

                                                    <?php endif; ?>
                                                </li>
                                            </ul>

                                            <div class="price">
                                                <h3>
                                                    <?php if($price = $membershipPlan->price): ?>
                                                        <span class="symbol"><?php echo appCon()->curr_symb; ?></span><?php echo $price; ?>

                                                    <?php else: ?>
                                                        <?php echo trans('front.FREE'); ?>

                                                    <?php endif; ?>
                                                </h3>
                                            </div>

                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            <?php else: ?>

                                <?php foreach($userGroup->listingPlans()->ordered()->get() as $listingPlan): ?>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="plan">

                                            <div class="head">
                                                <h2><?php echo $listingPlan->name; ?></h2>
                                            </div>

                                            <ul class="item-list">
                                                <li><strong><?php echo trans('front.duration'); ?>:</strong>
                                                    <?php if($duration = $listingPlan->duration): ?>
                                                        <?php echo $duration; ?> <?php echo trans('front.days'); ?>

                                                    <?php else: ?>
                                                        <?php echo trans('front.PERPETUAL'); ?>

                                                    <?php endif; ?>
                                                </li>
                                                <li><strong><?php echo trans('front.max_photos'); ?>:</strong>
                                                    <?php if($maxP = $listingPlan->max_photos): ?>
                                                        <?php echo $maxP; ?>

                                                    <?php else: ?>
                                                        <?php echo trans('front.UNLIMITED'); ?>

                                                    <?php endif; ?>
                                                </li>
                                                <li><strong><?php echo trans('front.max_listings'); ?>:</strong>
                                                    <?php if($maxL = $listingPlan->max_listings): ?>
                                                        <?php echo $maxL; ?>

                                                    <?php else: ?>
                                                        <?php echo trans('front.UNLIMITED'); ?>

                                                    <?php endif; ?>
                                                </li>
                                            </ul>

                                            <div class="price">
                                                <h3>
                                                    <?php if($listingPlan->price): ?>
                                                        <span class="symbol"><?php echo appCon()->curr_symb; ?></span><?php echo $listingPlan->price; ?>

                                                    <?php else: ?>
                                                        <?php echo trans('front.FREE'); ?>

                                                    <?php endif; ?>
                                                </h3>
                                            </div>

                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            <?php endif; ?>

                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-main btn-fixed" data-dismiss="modal"><?php echo trans('front.close'); ?></button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>