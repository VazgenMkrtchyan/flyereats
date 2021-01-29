<?php if(! appCon()->membershipPlansBased()): ?>
    <div class="alert alert-danger">
        <?php echo trans('back.note_membership_plans_irrelevant'); ?>

    </div>
<?php endif; ?>