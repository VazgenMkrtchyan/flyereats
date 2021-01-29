

<?php $__env->startSection('meta-title', trans('installation.title_installed')); ?>

<?php $__env->startSection('content'); ?>

    <h1><i class="fa fa-battery-full"></i> <?php echo trans('installation.script_installed'); ?></h1>

    <div class="bs-callout bs-callout-success">
        <?php echo trans('installation.installed_info', ['admin_link' => route('admin.sessions.create')]); ?>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('helpers.installation-wizard.layout-wizard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>