

<?php $__env->startSection('meta-title', siteTitle(trans('front.title_manage_membership'))); ?>

<?php $__env->startSection('content'); ?>

    <h1><i class="fa fa-cogs"></i> <?php echo trans('front.manage_membership_plan'); ?></h1>

    <?php if($user->hasActiveMembershipPlan()): ?>
        <div class="bs-callout bs-callout-info">
            <strong><?php echo trans('front.current_plan'); ?>:</strong> <?php echo $user->membershipPlan->name; ?><br>
            <strong><?php echo trans('front.membership_expiration'); ?>:</strong> <?php echo $user->present()->expirationDate(); ?>

            <p><br><strong>(<?php echo trans('front.select_current_will_extend'); ?>)</strong></p>
        </div>

        <div class="bs-callout bs-callout-info">
            <strong><?php echo trans('front.note'); ?>:</strong> <?php echo trans('front.changing_plan_will_archive'); ?>

        </div>
    <?php else: ?>
        <div class="bs-callout bs-callout-info">
            You have no active Membership Plan. Please select a plan!
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="pricing-tables">
                <div class="row">
                    <?php foreach($membershipPlans as $membershipPlan): ?>
                        <div class="col-sm-6 col-md-4">
                            <div class="plan <?php if($membershipPlan->isCurrent()): ?> recommended <?php endif; ?>">

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

                                <a href="<?php echo route('membershipplans.proceed', $membershipPlan->id); ?>" class="btn btn-main" <?php if(! $membershipPlan->allowSelect()): ?> disabled <?php endif; ?>>
                                    <?php if($membershipPlan->price): ?>
                                        <i class="fa fa-money"></i>
                                    <?php endif; ?>
                                    <?php if($membershipPlan->isCurrent()): ?>
                                        <?php echo trans('front.extend_plan'); ?>

                                        <i class="fa fa-refresh"></i>
                                    <?php else: ?>
                                        <?php echo trans('front.select_and_proceed'); ?>

                                        <i class="fa fa-chevron-right"></i>
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="bs-callout bs-callout-warning">
                <i class="fa fa-money"></i> <?php echo trans('front.redirect_warning'); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>