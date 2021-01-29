


<?php $__env->startSection('meta-title', siteTitle(trans('front.title_vehicle_listings'))); ?>

<?php $__env->startSection('content'); ?>

    <?php if(! empty($seller)): ?>
        <h2>
            <i class="fa fa-bars"></i> <?php echo trans('front.listings_of'); ?> <b><?php echo $seller->present()->fullName; ?></b>
        </h2>
    <?php endif; ?>

    <?php if(Input::has('show_history')): ?>
        <h2>
            <i class="fa fa-history"></i> <?php echo trans('front.seen_listings'); ?>

        </h2>
    <?php endif; ?>

    <?php if(Input::has('show_loved')): ?>
        <h2>
            <i class="fa fa-heart"></i> <?php echo trans('front.loved_listings'); ?>

        </h2>
    <?php endif; ?>

    <div class="row">

        <div class="col-md-9">

            <div class="results-view-pref clearfix">

                <?php if(empty($seller)): ?>
                    <div class="user-groups">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php if(Input::has('userGroup')): ?>
                                    <?php echo $userGroups[Input::get('userGroup')]; ?>

                                <?php else: ?>
                                    <?php echo trans('front.all_listings'); ?> (<?php echo $counter; ?>)
                                <?php endif; ?>
                                <span class="caret"></span>
                            </button>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo route('browselistings.index', Input::except(['userGroup', 'page'])); ?>"><?php echo trans('front.all_listings'); ?> (<?php echo $counter; ?>)</a></li>
                                <?php foreach($userGroups as $id => $name): ?>
                                    <li><a href="<?php echo route('browselistings.index', ['userGroup' => $id] + Input::except(['userGroup', 'page'])); ?>"><?php echo $name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>


                <div class="view-options">
                    <!-- per page -->
                    <div class="dropdown">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <?php echo sessionOrWebc('ui_list_no', 'per_page'); ?> <?php echo trans('front.results'); ?>

                            <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="" data-per-page="5">5 <?php echo trans('front.results'); ?></a></li>
                            <li><a href="" data-per-page="10">10 <?php echo trans('front.results'); ?></a></li>
                            <li><a href="" data-per-page="15">15 <?php echo trans('front.results'); ?></a></li>
                            <li><a href="" data-per-page="25">25 <?php echo trans('front.results'); ?></a></li>
                            <li><a href="" data-per-page="50">50 <?php echo trans('front.results'); ?></a></li>
                        </ul>
                    </div>

                    <!--sort by -->
                    <div class="dropdown">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <?php echo trans('front.'.sessionOrWebc('ui_list_sort', 'sort_by')); ?>

                            <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="" data-sort-by="date_DESC"><?php echo trans('front.date_DESC'); ?></a></li>
                            <li><a href="" data-sort-by="date_ASC"><?php echo trans('front.date_ASC'); ?></a></li>
                            <li><a href="" data-sort-by="year_DESC"><?php echo trans('front.year_DESC'); ?></a></li>
                            <li><a href="" data-sort-by="year_ASC"><?php echo trans('front.year_ASC'); ?></a></li>
                            <li><a href="" data-sort-by="price_DESC"><?php echo trans('front.price_DESC'); ?></a></li>
                            <li><a href="" data-sort-by="price_ASC"><?php echo trans('front.price_ASC'); ?></a></li>
                            <li><a href="" data-sort-by="mileage_ASC"><?php echo trans('front.mileage_ASC'); ?></a></li>
                            <li><a href="" data-sort-by="mileage_DESC"><?php echo trans('front.mileage_DESC'); ?></a></li>
                        </ul>
                    </div>


                    <div id="list-view" class="list-grid <?php if(sessionOrWebc('ui_view', 'view') == 'list'): ?> active <?php endif; ?>"><i class="fa fa-th-list"></i></div>
                    <div id="grid-view" class="list-grid <?php if(sessionOrWebc('ui_view', 'view') == 'grid'): ?> active <?php endif; ?>"><i class="fa fa-th"></i></div>
                </div>

            </div>

            <!-- LISTINGS -->
            <div class="listing-results clearfix">
                <?php if(count($listings)): ?>

                    <?php foreach($listings as $listing): ?>

                        <?php echo $__env->make('front.browse-listings.partials.listing', ['listgrid' => sessionOrWebc('ui_view', 'view')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php endforeach; ?>

                <?php else: ?>
                    <div class="no-results-found">
                            No listings found.
                    </div>
                <?php endif; ?>
            </div>

            <?php echo str_replace('/?', '?', $listings->appends(Session::get('search_url'))->render()); ?>


        </div>

        <!-- QUICK SEARCH -->
        <div class="col-md-3">
            <?php echo $__env->make('front.browse-listings.partials.index-side-widget', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('front.browse-listings.js.js-index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>