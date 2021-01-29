<div class="alert alert-success alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert">
        <i class="ace-icon fa fa-times"></i>
    </button>

    <strong><i><?php echo trans('front.registration_success'); ?></i></strong>
    <?php if(! Session::get('registeredUser')->emailConfirmed()): ?>
        <br><strong><?php echo trans('front.go_confirm_email'); ?></strong>
    <?php endif; ?>
    <?php if(! Session::get('registeredUser')->isApproved()): ?>
        <br><?php echo trans('front.account_pending_approval'); ?>

    <?php endif; ?>
</div>

