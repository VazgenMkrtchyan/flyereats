

<?php $__env->startSection('subject', 'Password Reset'); ?>

<?php $__env->startSection('content'); ?>
	To reset your password, complete this form: <br>
	<a href="<?php echo URL::to('password/reset', array($token)); ?>" target="_blank"><?php echo URL::to('password/reset', array($token)); ?></a>.
	<br><br>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('email-templates.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>