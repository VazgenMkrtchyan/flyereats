

<?php $__env->startSection('subject', $subject); ?>

<?php $__env->startSection('content'); ?>
	<strong>Name:</strong> <?php echo $data['name']; ?> <br>
	<strong>E-mail:</strong> <?php echo $data['email']; ?> <br>

	<strong>Message:</strong> <?php echo $data['message']; ?>

	<br><br>
	<strong>Listing URL:</strong> <a href="<?php echo $listing->present()->seoUrl; ?>" target="_blank"><?php echo $listing->present()->seoUrl; ?></a>
	<br><br>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('email-templates.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>