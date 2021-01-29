

<?php $__env->startSection('meta-title', trans('back.add_administrator')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.add_administrator'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.enter_administrator_details'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                <?php echo Form::open(['route' => 'admin.administrators.store', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


                <!-- FIELDS -->
                <?php echo $__env->make('admin.administrators.partials.create-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo Form::close(); ?>

                <!-- End of form -->

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>