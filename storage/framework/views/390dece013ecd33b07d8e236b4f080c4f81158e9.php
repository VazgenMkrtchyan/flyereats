<div class="widget-container-col">
	<div class="widget-box widget-color-blue2">
		<div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-list"></i> <?php echo trans('back.listing_statistics'); ?></h5>

			<div class="widget-toolbar">
				<a href="#" data-action="collapse">
					<i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
				</a>
			</div>

		</div>

		<div class="widget-body">
			<div class="widget-main">
				<strong><?php echo trans('back.total_listings'); ?>:</strong> <?php echo $listingStats['total']; ?>

				<?php if($listingStats['total']): ?>
                    <a href="<?php echo route('admin.listings.index'); ?>">(<?php echo trans('back.view'); ?>)</a>
                <?php endif; ?>
                <br><strong><?php echo trans('back.simple'); ?>:</strong> <?php echo $listingStats['simple']; ?>

				<?php if($listingStats['simple']): ?>
                    <a href="<?php echo route('admin.listings.index', ['listingType' => 'simple']); ?>">(<?php echo trans('back.view'); ?>)</a>
                <?php endif; ?>
                <br><strong><?php echo trans('back.highlighted'); ?>:</strong> <?php echo $listingStats['highlighted']; ?>

				<?php if($listingStats['highlighted']): ?>
                    <a href="<?php echo route('admin.listings.index', ['listingType' => 'highlighted']); ?>">(<?php echo trans('back.view'); ?>)</a>
                <?php endif; ?>
                <br><strong><?php echo trans('back.featured'); ?>:</strong> <?php echo $listingStats['featured']; ?>

				<?php if($listingStats['featured']): ?> <a href="<?php echo route('admin.listings.index', ['listingType' => 'featured']); ?>">(<?php echo trans('back.view'); ?>)</a> <?php endif; ?> <br>

				<hr>

				<strong><?php echo trans('back.last_24_hours'); ?>:</strong> <?php echo $listingStats['24hours']; ?> <br>
				<strong><?php echo trans('back.last_7_days'); ?>:</strong> <?php echo $listingStats['7days']; ?> <br>
				<strong><?php echo trans('back.last_30_days'); ?>:</strong> <?php echo $listingStats['30days']; ?> <br>

				<hr>

				<strong><?php echo trans('back.active'); ?>:</strong> <?php echo $listingStats['active']; ?>

				<?php if($listingStats['active']): ?>
                    <a href="<?php echo route('admin.listings.index', ['listingStatus' => 'active']); ?>">(<?php echo trans('back.view'); ?>)</a>
                <?php endif; ?>
                <br><strong><?php echo trans('back.inactive'); ?>:</strong> <?php echo $listingStats['inactive']; ?>

                <?php if($listingStats['inactive']): ?>
                    <a href="<?php echo route('admin.listings.index', ['listingStatus' => 'inactive']); ?>">(<?php echo trans('back.view'); ?>)</a>
                <?php endif; ?>
                <br><strong><?php echo trans('back.pending'); ?>:</strong> <?php echo $listingStats['pending']; ?>

				<?php if($listingStats['pending']): ?>
                    <a href="<?php echo route('admin.listings.index', ['moderationStatus' => 'pending']); ?>">(<?php echo trans('back.view'); ?>)</a>
                <?php endif; ?>
                <br>

			</div>

		</div>
	</div>
</div>