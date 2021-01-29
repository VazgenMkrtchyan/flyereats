<?php if(Session::has('flash_notification.message')): ?>
    <div class="alert alert-<?php echo Session::get('flash_notification.level'); ?>">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="ace-icon fa fa-times"></i></button>

        <?php echo Session::get('flash_notification.message'); ?>

    </div>
<?php endif; ?>