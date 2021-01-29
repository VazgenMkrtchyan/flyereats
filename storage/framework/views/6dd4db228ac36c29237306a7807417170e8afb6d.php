

<?php $__env->startSection('meta-title', siteTitle(trans('front.title_user_listings'))); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('front.partials.alert-no-active-membership-plan', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="user-listings">

        <div class="top">
            <i class="fa fa-list"></i> <?php echo trans('front.your_listings'); ?>

            <div class="dropdown">
                <button class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <?php if(Input::get('show') == 'active'): ?>
                        <?php echo trans('front.active'); ?> (<?php echo $listingsCount['active']; ?>)
                    <?php elseif(Input::get('show') == 'inactive'): ?>
                        <?php echo trans('front.inactive'); ?> (<?php echo $listingsCount['inactive']; ?>)
                    <?php elseif(Input::get('show') == 'archived'): ?>
                        <?php echo trans('front.archived'); ?> (<?php echo $listingsCount['archived']; ?>)
                    <?php else: ?>
                        <?php echo trans('front.all'); ?> (<?php echo $listingsCount['all']; ?>)
                    <?php endif; ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo route('userlistings.index'); ?>"><?php echo trans('front.all'); ?> (<?php echo $listingsCount['all']; ?>)</a></li>
                    <li><a href="<?php echo route('userlistings.index', ['show' => 'active']); ?>"><?php echo trans('front.active'); ?> (<?php echo $listingsCount['active']; ?>)</a></li>
                    <li><a href="<?php echo route('userlistings.index', ['show' => 'inactive']); ?>"><?php echo trans('front.inactive'); ?> (<?php echo $listingsCount['inactive']; ?>)</a></li>
                    <li><a href="<?php echo route('userlistings.index', ['show' => 'archived']); ?>"><?php echo trans('front.archived'); ?> (<?php echo $listingsCount['archived']; ?>)</a></li>
                </ul>
            </div>
        </div>

        <?php if($listings->count()): ?>

            <?php foreach($listings as $listing): ?>

                <div class="row">
                    <div class="listing clearfix">

                        <div class="col-sm-2">
                            <img src="<?php echo $listing->present()->mainThumbUrl; ?>" class="img-responsive">
                        </div>

                        <div class="col-sm-4">
                            <strong><?php echo $listing->present()->listingName; ?></strong>
                            <a href="<?php echo $listing->present()->seoUrl; ?>" target="_blank">(<?php echo trans('front.view'); ?>)</a> <br>
                            <strong><?php echo trans('front.price'); ?>:</strong> <?php echo $listing->present()->listingPrice; ?> <br>
                            <strong><?php echo trans('front.mileage'); ?>:</strong> <?php echo $listing->present()->carMileage; ?> <br>
                            <strong><?php echo trans('front.transmission'); ?>:</strong> <?php echo $listing->present()->carTransmission; ?> <br>
                        </div>

                        <div class="col-sm-4">
                            <?php if($listing->isActiveListing()): ?>

                                <strong><?php echo trans('front.listing_status'); ?>:</strong> <span class="label label-success"><?php echo trans('front.active'); ?></span><br>

                                <strong><?php echo trans('front.listing_expiration'); ?>:</strong> <?php echo $listing->present()->expirationDate(); ?>


                                <?php if(appCon()->listingPlansBased()): ?>
                                    <br><strong><?php echo trans('front.listing_plan'); ?>:</strong> <?php echo $listing->listingPlan->name; ?>

                                <?php endif; ?>

                            <?php else: ?>

                                <strong><?php echo trans('front.listing_status'); ?>:</strong> <span class="label label-danger"><?php echo trans('front.inactive'); ?></span><br>
                                <strong><?php echo trans('front.reasons'); ?>:</strong>
                                <ul>
                                    <?php if($listing->isRejected()): ?>
                                        <li>
                                            <?php echo trans('front.moderation_status'); ?>: <span class="label label-danger"><?php echo trans('front.rejected'); ?></span>
                                        </li>

                                    <?php else: ?>

                                        <?php if(appCon()->membershipPlansBased()): ?>
                                            <?php if(! $listing->user->hasActiveMembershipPlan()): ?>
                                                <li>
                                                    <?php echo trans('front.no_active_membership'); ?>

                                                </li>
                                            <?php elseif($listing->isPending()): ?>
                                                <li>
                                                    <?php echo trans('front.moderation_status'); ?>: <span class="label label-danger"><?php echo trans('front.pending'); ?></span>
                                                </li>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if(appCon()->listingPlansBased()): ?>
                                            <?php if(! $listing->hasActiveListingPlan()): ?>
                                                <li>
                                                    <?php echo trans('front.no_active_plan'); ?>

                                                </li>
                                            <?php elseif($listing->isPending()): ?>
                                                <li>
                                                    <?php echo trans('front.moderation_status'); ?>: <span class="label label-danger"><?php echo trans('front.pending'); ?></span>
                                                </li>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if($listing->isArchived()): ?>
                                            <li>
                                                <?php echo trans('front.is_archived'); ?>

                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>

                        </div>

                        <div class="col-sm-2">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-cogs"></i> <?php echo trans('front.listing_actions'); ?>

                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <?php if(Auth::user()->hasActiveMembershipPlan()): ?>
                                        <?php if(! $listing->isArchived()): ?>
                                            <li><a href="<?php echo route('userlistings.edit', $listing->id); ?>"><i class="fa fa-pencil"></i> <?php echo trans('front.edit'); ?></a></li>
                                        <?php endif; ?>
                                        <?php if($listing->isArchived()): ?>
                                            <li><a href="<?php echo route('userlistings.restore', $listing->id); ?>"><i class="fa fa-undo"></i> <?php echo trans('front.restore'); ?></a></li>
                                        <?php endif; ?>
                                        <li class="divider"></li>
                                        <?php if(! $listing->isArchived()): ?>
                                            <li><a href="<?php echo route('userlistings.archive', $listing->id); ?>"><i class="fa fa-floppy-o"></i> <?php echo trans('front.archive'); ?></a></li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <li><a href="<?php echo route('userlistings.destroy', $listing->id); ?>" data-delete="<?php echo csrf_token();; ?>" data-confirm="<?php echo trans('front.del_listing_conf'); ?>"><i class="fa fa-trash-o"></i> <?php echo trans('front.delete'); ?></a></li>
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>

            <?php endforeach; ?>

        <?php else: ?>
            <div>
                <?php echo trans('front.no_listings_found'); ?>

            </div>

        <?php endif; ?>

    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('admin.js.destroy', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>