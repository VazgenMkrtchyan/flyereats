

<?php $__env->startSection('meta-title', trans('back.edit_permission')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.edit_permission'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.enter_permission_details'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                <?php echo Form::model($permission, ['route' => ['admin.permissions.update', $parent->id, $permission->id], 'class' => 'form-horizontal', 'id' => 'form-val', 'method' => 'PATCH']); ?>


                <?php echo $__env->make('admin.permissions.partials.create-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo Form::close(); ?>

                        <!-- End of form -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_identifier -->
    <?php echo Form::hidden('nav_li_identifier', 'admin.permissions'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>