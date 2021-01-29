


<?php $__env->startSection('content'); ?>

	<strong>Vehicle type:</strong> <?php echo $data['type']; ?> <br>
	<strong>Make:</strong> <?php echo $data['make']; ?> <br>
	<strong>Model:</strong> <?php echo $data['model']; ?> <br>
	<strong>Vehicle registration:</strong> <?php echo $data['registration']; ?> <br>
	<strong>Mileage:</strong> <?php echo $data['mile']; ?> <br>
	<strong>Service history:</strong> <?php echo $data['history']; ?> <br>
	<strong>Name:</strong> <?php echo $data['name']; ?> <br>
	<strong>Phone:</strong> <?php echo $data['phone']; ?> <br>
	<strong>E-mail:</strong> <?php echo $data['email']; ?> <br>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('email-templates.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>