

<?php $__env->startSection('subject', $subject); ?>

<?php $__env->startSection('content'); ?>
	Thank you for registering at <a href="<?php echo url('/'); ?>" target="_blank"><?php echo url('/'); ?></a>. <br><br>
	Your username: <strong><?php echo $user->username; ?></strong> <br>
	You can login at <a href="<?php echo route('sessions.create'); ?>" target="_blank"><?php echo route('sessions.create'); ?></a>
	<br><br>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('email-templates.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>