

<?php $__env->startSection('meta-title', trans('back.browse_and_manage_administrators')); ?>

<?php $__env->startSection('page-content'); ?>

		<div class="page-header">
			<h1>
				<?php echo trans('back.administrators'); ?>

				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					<?php echo trans('back.browse_and_manage_administrators'); ?>

				</small>

			</h1>
		</div><!-- /.page-header -->

		<!-- /section:settings.box -->
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->

					<!-- ADMINISTRATORS -->
					<?php echo $__env->make('admin.administrators.partials.administrators', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<!-- PAGE CONTENT ENDS -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content-area -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('admin.js.destroy', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>