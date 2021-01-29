<div class="widget-container-col margin-t-15" style="display:none;">
	<div class="widget-box widget-color-red3">
		<div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-money"></i> <?php echo trans('back.payment_statistics'); ?></h5>

			<div class="widget-toolbar">
				<a href="#" data-action="collapse">
					<i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
				</a>
			</div>

		</div>

		<div class="widget-body">
			<div class="widget-main" style="display:none;">
				<strong><?php echo trans('back.total'); ?>:</strong> <?php echo format_price($paymentStats['total']); ?>

				<?php if($paymentStats['total']): ?> <a href="<?php echo route('admin.payments.index'); ?>">(<?php echo trans('back.view'); ?>)</a> <?php endif; ?> <br>
				<strong><?php echo trans('back.last_24_hours'); ?>:</strong> <?php echo format_price($paymentStats['24hours']); ?> <br>
				<strong><?php echo trans('back.last_7_days'); ?>:</strong> <?php echo format_price($paymentStats['7days']); ?> <br>
				<strong><?php echo trans('back.last_30_days'); ?>:</strong> <?php echo format_price($paymentStats['30days']); ?> <br>

			</div>

		</div>
	</div>
</div>