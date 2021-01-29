<?php if(! appCon()->listingPlansBased()): ?>
    <div class="alert alert-danger">
        <?php echo trans('back.note_listing_plans_irrelevant'); ?>

    </div>
<?php endif; ?>