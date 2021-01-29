<?php $__env->startSection('meta-title', appCon()->web_name . ' | ' . appCon()->web_desc); ?>


<?php $__env->startSection('content'); ?>

    <!-- <h1><?php echo trans('front.quick_search'); ?></h1> -->




    <?php if(count($enhanced)): ?>
        <div class="content-slider" id="enhanced-listings"><!-- ENHANCED listings slider -->
            <div class="header clearfix">
                <div class="title">Our Special Offers</div>
                <div class="nav-thumbs">
                    <div class="nav-left"><i class="fa fa-angle-left"></i></div><!--
                -->
                    <div class="nav-right"><i class="fa fa-angle-right"></i></div>
                </div>
            </div>
            <div class="slides">
                <i class="fa fa-spinner fa-pulse buffering-slides"></i>
                <ul class="light-slider">
                    <?php foreach($enhanced as $listing): ?>
                        <li>
                            <?php echo $__env->make('front.browse-listings.partials.listing', ['listgrid'  => 'grid'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>


   <?php if(count($recent)): ?>
        <div class="index-listings" id="recently-added" ><!-- RECENTLY ADDED listings + LOAD MORE -->
            <div class="header clearfix">
                <div class="title"><?php echo trans('front.recently_added'); ?></div>
            </div>
            <div class="listing-results clearfix">
                <?php foreach($recent as $listing): ?>
                    <?php echo $__env->make('front.browse-listings.partials.listing', ['listgrid' => 'grid'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    
                <?php endforeach; ?>
              
            </div>
            <div class="load-more">
                <button class="btn-main btn-load" data-load-url="<?php echo route('api_load_more'); ?>" data-load-step=4
                        data-max-load-listings=8 data-total-listings=<?php echo $totalListings; ?>>
                    <?php echo trans('front.load_more'); ?>

                    <i class="fa fa-arrow-down"></i>
                    <i class="fa fa-spinner fa-pulse"></i>
                </button>
                <a href="<?php echo route('browselistings.index'); ?>" class="view-listings">
                    <button class="btn-main btn-load">
                        <?php echo trans('front.go_to_listings_page'); ?>

                        <i class="fa fa-chevron-right"></i>
                    </button>
                </a>
            </div>
        </div>
    <?php endif; ?>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('front.index.js.js-index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>