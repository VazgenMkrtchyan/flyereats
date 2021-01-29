<div class="widget-container-col">
	<div class="widget-box widget-color-pink">
		<div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-users"></i> <?php echo trans('back.user_statistics'); ?></h5>

			<div class="widget-toolbar">
				<a href="#" data-action="collapse">
					<i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
				</a>
			</div>

		</div>

		<div class="widget-body">
			<div class="widget-main">
				<strong><?php echo trans('back.total_users'); ?>:</strong> <?php echo $userStats['total']; ?>

                <br><strong><?php echo trans('back.simple_users'); ?>:</strong> <?php echo $userStats['simple']; ?>

				<?php if($userStats['simple']): ?>
                    <a href="<?php echo route('admin.users.index'); ?>">(<?php echo trans('back.view'); ?>)</a>
                <?php endif; ?>
				<br><strong><?php echo trans('back.administrators'); ?>:</strong> <?php echo $userStats['administrators']; ?>

				<?php if($userStats['administrators']): ?>
                    <a href="<?php echo route('admin.administrators.index'); ?>">(<?php echo trans('back.view'); ?>)</a>
                <?php endif; ?>
                <br><strong><?php echo trans('back.super_users'); ?>:</strong> <?php echo $userStats['super']; ?><br>

				<hr>

				<strong><?php echo trans('back.last_24_hours'); ?>:</strong> <?php echo $userStats['24hours']; ?> <br>
				<strong><?php echo trans('back.last_7_days'); ?>:</strong> <?php echo $userStats['7days']; ?> <br>
				<strong><?php echo trans('back.last_30_days'); ?>:</strong> <?php echo $userStats['30days']; ?> <br>

				<hr>

				<strong><?php echo trans('back.active'); ?>:</strong> <?php echo $userStats['active']; ?>

				<?php if($userStats['active']): ?>
                    <a href="<?php echo route('admin.users.index', ['userStatus' => 'active']); ?>">(View)</a>
                <?php endif; ?>
                <br><strong><?php echo trans('back.inactive'); ?>:</strong> <?php echo $userStats['inactive']; ?>

                <?php if($userStats['inactive']): ?>
                    <a href="<?php echo route('admin.users.index', ['userStatus' => 'inactive']); ?>">(<?php echo trans('back.view'); ?>)</a>
                <?php endif; ?>
                <br><strong><?php echo trans('back.unconfirmed_email'); ?>:</strong> <?php echo $userStats['emailUnconfirmed']; ?>

				<?php if($userStats['emailUnconfirmed']): ?>
                    <a href="<?php echo route('admin.users.index', ['emailStatus' => 'unconfirmed']); ?>">(<?php echo trans('back.view'); ?>)</a>
                <?php endif; ?>
                <br><strong><?php echo trans('back.pending'); ?>:</strong> <?php echo $userStats['pending']; ?>

				<?php if($userStats['pending']): ?>
                    <a href="<?php echo route('admin.users.index', ['moderationStatus' => 'pending']); ?>">(<?php echo trans('back.view'); ?>)</a>
                <?php endif; ?>
                <br>

			</div>

		</div>
	</div>
</div>