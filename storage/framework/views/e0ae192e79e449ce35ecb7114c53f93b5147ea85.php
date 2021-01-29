

<?php $__env->startSection('subject', $subject); ?>

<?php $__env->startSection('content'); ?>
	To confirm your account, click on the link below: <br>
	<a href="<?php echo route('account.confirm', $token); ?>" target="_blank"><?php echo route('account.confirm', $token); ?></a>
	<br><br>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('email-templates.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>