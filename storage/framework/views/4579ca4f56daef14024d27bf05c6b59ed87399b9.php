<?php if(! Auth::user()->userGroup->displayCompany()): ?>
    <div class="alert alert-warning" role="alert">
        <strong><?php echo trans('front.note'); ?>:</strong> <?php echo trans('front.compprofile_not_shown'); ?>

    </div>
<?php endif; ?>