

<?php $__env->startSection('meta-title', siteTitle(trans('front.title_add_listing'))); ?>

<?php $__env->startSection('content'); ?>
    <h1><i class="fa fa-plus"></i> <?php echo trans('front.add_listing'); ?></h1>

    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#listing-data" aria-controls="listing-data" role="tab" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo trans('front.listing_details'); ?></a></li>
        <li role="presentation"><a href="#listing-photos" aria-controls="listing-photos" role="tab" style="cursor: not-allowed;" onclick="return false;"><i class="fa fa-picture-o"></i> <?php echo trans('front.listing_photos'); ?></a></li>
        <?php if(appCon()->listingPlansBased()): ?>
            <li role="presentation"><a href="#listing-plan" aria-controls="messages" role="tab" style="cursor: not-allowed;" onclick="return false;"><i class="fa fa-cog"></i> <?php echo trans('front.listing_plan'); ?></a></li>
        <?php endif; ?>
        <li role="presentation"><a href="#listing-enhancement" aria-controls="messages" role="tab" style="cursor: not-allowed;" onclick="return false;"><i class="fa fa-star"></i> <?php echo trans('front.listing_enhancement'); ?></a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="listing-data">

            <?php echo Form::open(['route' => ['userlistings.store'], 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


            <?php echo $__env->make('front.user-listings.partials.listing-data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo Form::close(); ?>


        </div>
        <div role="tabpanel" class="tab-pane" id="listing-photos"></div>
        <div role="tabpanel" class="tab-pane" id="listing-plan"></div>
        <div role="tabpanel" class="tab-pane" id="listing-enhancement"></div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('front.user-listings.js.js-listing-data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>