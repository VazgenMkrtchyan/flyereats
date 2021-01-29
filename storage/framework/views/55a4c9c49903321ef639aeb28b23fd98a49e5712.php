

<?php $__env->startSection('meta-title', trans('back.edit_user')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.edit_user'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.modify_user_details'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                <?php echo Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>

                <!-- FIELDS -->
                <?php echo $__env->make('admin.users.partials.create-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <!-- hidden field for old_expires_on -->
                <?php echo Form::hidden('old_expires_on', $user->expires_on ? $user->expires_on->format('Y-m-d') : null); ?>

                <!-- hidden field for old_st_moderation -->
                <?php echo Form::hidden('old_st_moderation', $user->st_moderation); ?>


                <?php echo Form::close(); ?>

                <!-- End of form -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_top -->
    <?php echo Form::hidden('nav_li_top', 'users'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>