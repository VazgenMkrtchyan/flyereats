

<?php $__env->startSection('meta-title', trans('back.website_statistics')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.website_statistics'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.view_website_statistics'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <!-- PAGE CONTENT BEGINS -->

            <div class="col-xs-12 col-sm-6">
                <!-- Listing Statistics -->
                <?php echo $__env->make('admin.statistics.partials.listing-stats', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <!-- Payment Statistics -->
                <?php echo $__env->make('admin.statistics.partials.payment-stats', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="col-xs-12 col-sm-6">
                <!-- User Statistics -->
                <?php echo $__env->make('admin.statistics.partials.user-stats', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            </div>

        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.page-content-area -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>