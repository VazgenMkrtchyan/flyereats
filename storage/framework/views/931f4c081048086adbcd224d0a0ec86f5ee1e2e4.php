<?php foreach($listings as $listing): ?>
    <?php echo $__env->make('front.browse-listings.partials.listing', ['listgrid' => 'grid'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endforeach; ?>