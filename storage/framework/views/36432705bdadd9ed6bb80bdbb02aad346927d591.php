<?php $__env->startSection('meta-title', appCon()->web_name . ' | ' . appCon()->web_desc); ?>

<?php $__env->startSection('content'); ?>

    <h1><?php echo trans('front.quick_search'); ?></h1>

    <!-- Form -->
    <?php echo Form::open(['route' => 'do_search', 'id' => 'quick-search']); ?>


    <div class="index-quick-search margin-b-30">

        <div class="row upper-options">
            <div class="col-sm-8 no-sides-padding">
                <?php foreach($details['Conditions'] as $id => $condition): ?>
                    <label class="radio-inline">
                        <input type="radio" name="condition" id="carCond" value="<?php echo $id; ?>"> <?php echo $condition; ?>

                    </label>
                <?php endforeach; ?>
                <label class="radio-inline">
                    <input type="radio" name="condition" id="carCond" value="" checked> <?php echo trans('front.all'); ?>

                </label>
            </div>
            <div class="col-sm-4 hidden-xs"><a href="<?php echo route('advanced-search.index'); ?>"><?php echo trans('front.advanced_search'); ?> <i class="fa fa-chevron-right"></i></a></div>
        </div>

        <div class="row">
            <div class="col-lg-2 col-sm-6">
                <div class="search-option">
                    <?php echo Form::select('make', [
            '' => trans('front.all_makes')
            ] + $details['Makes'], null, ['class'=>'form-control', 'id' => 'make']);; ?>

                </div>
            </div>

            <div class="col-lg-2 col-sm-6">
                <div class="search-option">
                    <?php echo Form::select('model', [
                    '' => trans('front.all_models')
                    ], null, ['class'=>'form-control', 'id' => 'model']);; ?>

                </div>
            </div>

            <div class="col-lg-2 col-sm-6">
                <div class="search-option">
                    <?php echo Form::select('max_price', [
                    '' => trans('front.no_max_price')
                    ] + rangePrice(), null, ['class'=>'form-control']);; ?>

                </div>
            </div>

            <div class="col-lg-4 col-sm-4 no-sides-padding zip-range">
                <div class="row">
                    <!--<div class="col-xs-6 range">
                        <?php echo Form::select('distance', [
                        '' => trans('front.all') . ' ' . mileageUnits()
                        ] + rangeDistance(), sessionOrDefault('distance'), ['class'=>'form-control']);; ?>

                    </div>-->
                    <div class="col-xs-6 zip">
                        <span><?php echo trans('front.of'); ?></span>
                        <?php echo Form::text('zip', sessionOrDefault('zip'), ['class'=>'form-control', 'placeholder' => 'Post Code']);; ?>

                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-sm-2 search-btn">
                <button class="btn-main" type="submit">
                    <?php echo trans('front.SEARCH'); ?>

                </button>
            </div>

        </div>

        <div class="adv-search visible-xs"><a href="<?php echo route('advanced-search.index'); ?>"><?php echo trans('front.advanced_search'); ?> <i class="fa fa-chevron-right"></i></a></div>

    </div>

    <?php echo Form::close(); ?>

            <!-- End of form -->

    <?php if(count($enhanced)): ?>
        <div class="content-slider" id="enhanced-listings"><!-- ENHANCED listings slider -->
            <div class="header clearfix">
                <div class="title"><?php echo trans('front.enhanced_listings'); ?></div>
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
                            <?php echo $__env->make('front.browse-listings.partials.listing', ['listgrid' => 'grid'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>


    <?php if(count($recent)): ?>
        <div class="index-listings" id="recently-added"><!-- RECENTLY ADDED listings + LOAD MORE -->
            <div class="header clearfix">
                <div class="title"><?php echo trans('front.recently_added'); ?></div>
            </div>
            <div class="listing-results clearfix">
                <?php foreach($recent as $listing): ?>
                    <?php echo $__env->make('front.browse-listings.partials.listing', ['listgrid' => 'grid'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endforeach; ?>
            </div>
            <div class="load-more">
                <button class="btn-main btn-load" data-load-url="<?php echo route('api_load_more'); ?>" data-load-step=8
                        data-max-load-listings=12 data-total-listings=<?php echo $totalListings; ?>>
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