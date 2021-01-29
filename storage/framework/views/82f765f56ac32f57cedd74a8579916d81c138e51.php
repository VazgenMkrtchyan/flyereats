

<?php $__env->startSection('meta-title', siteTitle(trans('front.title_reset_password'))); ?>

<?php $__env->startSection('content'); ?>

<h1><?php echo trans('front.reset_password'); ?></h1>

<!-- Form -->
<?php echo Form::open(['route' => 'password.postReset', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


<?php echo Form::hidden('token', $token); ?>


<!-- text field for 'Email'-->
<div class="form-group">
	<?php echo Form::label('email', trans('front.email').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

	<div class="col-sm-6 col-md-4">
		<?php echo Form::email('email', null, ['class' => 'form-control']); ?>

	</div>
</div>

<!-- text field for 'Password'-->
<div class="form-group">
	<?php echo Form::label('password', trans('front.password').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

	<div class="col-sm-6 col-md-4">
		<?php echo Form::password('password', ['class' => 'form-control']); ?>

	</div>
</div>

<!-- text field for 'Password_confirmation'-->
<div class="form-group">
	<?php echo Form::label('password_confirmation', trans('front.password_confirmation').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

	<div class="col-sm-6 col-md-4">
		<?php echo Form::password('password_confirmation', ['class' => 'form-control']); ?>

	</div>
</div>

<!-- submit for button -->
<div class="form-group margin-t-30">
    <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
        <button class="btn-main" type="submit">
            <?php echo trans('front.RESET_PASSWORD'); ?>

        </button>
    </div>
</div>

<?php echo Form::close(); ?>

<!-- End of form -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('front.password.js.js-reset', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>