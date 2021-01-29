

<?php $__env->startSection('meta-title', siteTitle(trans('front.title_pricing_info'))); ?>

<?php $__env->startSection('content'); ?>

    <h1><?php echo trans('front.pricing_info'); ?></h1>

    <?php if(demo_mode_on()): ?>
        <div class="bs-callout bs-callout-danger">
            <h4><?php echo trans('front.pricing_demo_website', ['website_type' => appCon()->membershipPlansBased() ? trans('front.membership_plans') : trans('front.listing_plans')]); ?></h4>
        </div>

        <div class="bs-callout bs-callout-info">
            <h4><?php echo trans('back.pricing_web_based'); ?>:</h4>
            <ul>
                <li><?php echo trans('back.pricing_listing_plans'); ?></li>
                <li><?php echo trans('back.pricing_membership_plans'); ?></li>
            </ul>
        </div>
    <?php endif; ?>

    <?php if(! demo_mode_on()): ?>
        <div class="bs-callout bs-callout-danger">
            <h4><?php echo trans('front.pricing_website', ['website_type' => appCon()->membershipPlansBased() ? trans('front.membership_plans') : trans('front.listing_plans')]); ?></h4>

            <p>
                <?php if(appCon()->membershipPlansBased()): ?>
                    <?php echo trans('back.pricing_membership_plans'); ?>

                <?php else: ?>
                    <?php echo trans('back.pricing_listing_plans'); ?>

                <?php endif; ?>
            </p>
        </div>
    <?php endif; ?>

    <div class="bs-callout bs-callout-info">
        <h4>
            <?php if(appCon()->membershipPlansBased()): ?>
                <?php echo trans('front.view_membership_plans'); ?>

            <?php else: ?>
                <?php echo trans('front.view_listing_plans'); ?>

            <?php endif; ?>
        </h4>
        <ul>
            <?php foreach($userGroups as $userGroup): ?>
                <li><strong><a href="#info" data-toggle="modal" data-target="#pricing-modal-<?php echo $userGroup->id; ?>"><?php echo strtoupper($userGroup->name); ?></a></strong></li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('modals'); ?>
    <?php echo $__env->make('front.pricing-info.partials.pricing-info-modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>