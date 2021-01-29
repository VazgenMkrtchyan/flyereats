<?php $__env->startSection('meta-title', trans('back.users')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.users'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.browse_and_manage_users'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- SEARCH OPTIONS -->
                <?php echo $__env->make('admin.users.partials.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <!-- USERS -->
                <?php echo $__env->make('admin.users.partials.users', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>