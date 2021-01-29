<?php if(Auth::user()->isSimple()
    AND ! Auth::user()->hasActiveMembershipPlan()): ?>
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <strong><?php echo trans('front.alert_no_active_membership', ['link' => route('membershipplans.manage')]); ?></strong><br>
        <?php echo trans('front.forbidden_actions'); ?>

    </div>
<?php endif; ?>