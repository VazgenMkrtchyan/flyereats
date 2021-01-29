<?php $__env->startSection('meta-title', trans('back.browse_and_manage_permission_groups')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.permission_groups'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.browse_and_manage_permission_groups'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->


                <!-- WARNING -->
                <?php echo $__env->make('admin.permission-groups.partials.warning', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


                <div class="margin-b-10">
                    <a href="<?php echo route('admin.permission-groups.create'); ?>">
                        <button class="btn btn-white btn-pink btn-bold">
                            <span class="ace-icon fa fa-plus icon-on-left"></span>
                            <?php echo trans('back.add_permission_group'); ?>

                        </button>
                    </a>
                </div>

                <!-- PERMISSION GROUPS -->
                <?php echo $__env->make('admin.permission-groups.partials.permission-groups', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_identifier -->
    <?php echo Form::hidden('nav_li_identifier', 'admin.permissions'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('admin.js.destroy', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>