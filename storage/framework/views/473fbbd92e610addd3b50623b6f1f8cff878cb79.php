

<?php $__env->startSection('meta-title', siteTitle(trans('front.title_edit_listing'))); ?>

<?php $__env->startSection('content'); ?>

    <?php if(! $listing->isActiveListing()): ?>
        <div class="alert alert-danger"><!-- SHOWS INACTIVITY REASONS -->
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

                    <?php else: ?>

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

                <?php endif; ?>
            </ul>
        </div>
    <?php endif; ?>

    <h1><i class="fa fa-pencil"></i> <?php echo trans('front.edit_listing'); ?></h1>

    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#listing-data" aria-controls="listing-data" role="tab" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo trans('front.listing_details'); ?></a></li>
        <li role="presentation"><a href="#listing-photos" aria-controls="listing-photos" role="tab" data-toggle="tab"><i class="fa fa-picture-o"></i> <?php echo trans('front.listing_photos'); ?></a></li>
        <?php if(appCon()->listingPlansBased()): ?>
            <li role="presentation"><a href="#listing-plan" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-cog"></i> <?php echo trans('front.listing_plan'); ?></a></li>
        <?php endif; ?>
        <li role="presentation"><a href="#listing-enhancement" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-star"></i> <?php echo trans('front.listing_enhancement'); ?></a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="listing-data">

            <?php echo Form::model($listing, ['route' => ['userlistings.update', $listing->id], 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'form-val']); ?>


            <?php echo Form::hidden('old_state_id', $listing->state_id); ?>

            <?php echo Form::hidden('old_city', $listing->city); ?>

            <?php echo Form::hidden('old_addr_1', $listing->addr_1); ?>

            <?php echo Form::hidden('old_zip', $listing->zip); ?>


            <?php echo $__env->make('front.user-listings.partials.listing-data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo Form::close(); ?>


        </div>

        <div role="tabpanel" class="tab-pane" id="listing-photos">
            <?php echo $__env->make('front.user-listings.partials.listing-photos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>

        <?php if(appCon()->listingPlansBased()): ?>
            <div role="tabpanel" class="tab-pane" id="listing-plan">
                <?php echo $__env->make('front.user-listings.partials.listing-plans', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        <?php endif; ?>

        <div role="tabpanel" class="tab-pane" id="listing-enhancement">
            <?php echo $__env->make('front.user-listings.partials.listing-enhancements', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('front.user-listings.js.js-listing-data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('front.user-listings.js.js-listing-photos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>