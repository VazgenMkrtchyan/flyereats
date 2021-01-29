

<?php $__env->startSection('meta-description', $listing->present()->metaDescription); ?>
<?php $__env->startSection('meta-title', siteTitle($listing->present()->listingName)); ?>

<?php $__env->startSection('og-data'); ?>
        <!-- Open Graph data (for Facebook and Google+) -->
<meta property="og:title" content="<?php echo $listing->present()->listingName; ?>">
<meta property="og:site_name" content="<?php echo appCon()->web_name; ?>">
<meta property="og:url" content="<?php echo URL::current(); ?>">
<meta property="og:description" content="<?php echo $listing->present()->listingName; ?> - ONLY <?php echo $listing->present()->listingPrice; ?>">
<meta property="og:image" content="<?php echo $listing->present()->mainPhotoUrl; ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="listing-view-page">

        <div class="row">

            <div class="col-xs-12">
                <div class="listing-nav clearfix">
                    <div class="left">
                        <i class="fa fa-reply"></i> <a href="<?php echo route('browselistings.index', Session::get('search_url')); ?>"><?php echo trans('front.back_to_results'); ?></a>
                    </div>
                    <div class="right">
                        <span class="visible-xs"><i class="fa fa-envelope-o"></i> <a href="#listing-enquiry"><?php echo trans('front.enquiry'); ?></a></span><i class="fa fa-print"></i> <a href="" data-printable-page><?php echo trans('front.printable_page'); ?></a>
                    </div>
                </div>

                <div class="listing-header clearfix">
                    <h1 class="listing-title"><?php echo $listing->present()->listingName; ?></h1>
                    <span class="listing-price"><?php echo $listing->present()->listingPrice; ?></span>
                    <span class="listing-love-view" data-love-listing="<?php echo route('love_listing', $listing->id); ?>">
                        <?php if($listing->isLoved()): ?>
                            <i class="fa fa-heart" title="Undo"></i>
                        <?php else: ?>
                            <i class="fa fa-heart-o" title="Love Listing"></i>
                        <?php endif; ?>
                    </span>
                </div>
            </div>


            <div class="col-xs-12">
                <div class="row">

                    <div class="col-sm-8">
                        <!-- PHOTOS -->
                        <div class="listing-photos">
                            <?php if(count($listing->photos)): ?>
                                <i class="fa fa-spinner fa-pulse loading"></i>
                                <ul id="view-image-gal">
                                    <?php foreach($listing->photos->take( $listing->maxPhotosNo() == 'UNLIMITED' ? 1000 : $listing->maxPhotosNo() ) as $photo): ?>
                                        <li data-thumb="<?php echo asset('templates/misc/photo_empty.png'); ?>" data-thumb-src="<?php echo $photo->present()->thumbUrl(); ?>">

                                            <img data-src="<?php echo $photo->present()->photoUrl(); ?>" src="<?php echo asset('templates/misc/photo_empty.png'); ?>">

                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                            <?php else: ?>
                                <img src="<?php echo asset('templates/misc/no_listing_photo_enlarge.png'); ?>" class="img-thumbnail">

                            <?php endif; ?>
                        </div>


                        <div class="listing-details">

                            <div class="main-listing-details margin-b-30">
                                <h3><i class="fa fa-cogs"></i> <?php echo trans('front.main_vehicle_details'); ?></h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="listing-details-table">
                                            <tbody>
                                            <tr>
                                                <td><?php echo trans('front.make'); ?>:</td>
                                                <td class="info"><?php echo $listing->present()->carMake; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo trans('front.car_model'); ?>:</td>
                                                <td class="info"><?php echo $listing->present()->carModel; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo trans('front.year_manufactured'); ?>:</td>
                                                <td class="info"><?php echo $listing->year; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo trans('front.mileage'); ?>:</td>
                                                <td class="info"><?php echo $listing->present()->carMileage; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo trans('front.condition'); ?>:</td>
                                                <td class="info"><?php echo $listing->present()->carCondition; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo trans('front.body_style'); ?>:</td>
                                                <td class="info"><?php echo $listing->present()->carBodyStyle; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo trans('front.transmission'); ?>:</td>
                                                <td class="info"><?php echo $listing->present()->carTransmission; ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="listing-details-table">
                                            <tbody>
                                            <tr>
                                                <td><?php echo trans('front.drive_type'); ?>:</td>
                                                <td class="info"><?php echo $listing->present()->carDriveType; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo trans('front.fuel_type'); ?>:</td>
                                                <td class="info"><?php echo $listing->present()->carFuelType; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo trans('front.ext_color'); ?>:</td>
                                                <td class="info"><?php echo $listing->present()->carExtColor; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo trans('front.int_color'); ?>:</td>
                                                <td class="info"><?php echo $listing->present()->carIntColor; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo trans('front.doors'); ?>:</td>
                                                <td class="info"><?php echo $listing->doors; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo trans('front.passengers'); ?>:</td>
                                                <td class="info"><?php echo $listing->passengers; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo trans('front.engine_cylinders'); ?>:</td>
                                                <td class="info"><?php echo $listing->engine_cyl ? $listing->engine_cyl : 'N/A'; ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <?php if($listing->description): ?>
                                <div class="seller-comments margin-b-30">
                                    <h3><i class="fa fa-comment-o"></i> <?php echo trans('front.sellers_comments'); ?></h3>
                                    <div><?php echo $listing->description; ?></div>
                                </div>
                            <?php endif; ?>


                            <div class="vehicle-features margin-b-30">
                                <h3><i class="fa fa-check-square-o"></i> <?php echo trans('front.vehicle_features'); ?></h3>
                                <div class="row">
                                    <?php foreach($listing->features as $feature): ?>
                                        <div class="col-sm-4 col-lg-3 col-xs-6 listing-features">
                                            <i class="fa fa-check"></i> <?php echo $feature->name; ?>

                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>


                            <div class="listing-location margin-b-30">
                                <h3><i class="fa fa-map-marker"></i> <?php echo trans('front.vehicle_location'); ?></h3>
                                <div id="map_canvas" style="width:100%; height:450px;"></div>
                            </div>

                        </div> <!-- ./listing details -->
                    </div>

                    <div class="col-sm-4">

                        <!-- Listing Enquiry -->
                        <div class="side-widget" id="listing-enquiry">
                            <div class="header"><i class="fa fa-envelope-o"></i> <?php echo trans('front.enquire_listing'); ?></div>
                            <div class="content">

                                <!--enquiry sent notify-->
                                <div class="alert alert-success" role="alert" id="enquiry-sent" style="display: none">
                                    <?php echo trans('front.listing_enquiry_sent'); ?>

                                </div>

                                <!-- Form -->
                                <?php echo Form::open(['route' => ['enquiry.send', $listing->id], 'id' => 'form-enquiry']); ?>


                                <div class="form-group">
                                    <?php echo Form::label('name', trans('front.name').': *'); ?>

                                    <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

                                </div>

                                <div class="form-group">
                                    <?php echo Form::label('email', trans('front.email').': *'); ?>

                                    <?php echo Form::email('email', null, ['class' => 'form-control']); ?>

                                </div>

                                <div class="form-group">
                                    <?php echo Form::label('message', trans('front.message').': *'); ?>

                                    <?php echo Form::textarea('message', $listing->present()->defaultEnquiryText, ['class' => 'form-control', 'rows' => 5]); ?>

                                </div>

                                <?php if(appCon()->captcha_contact_forms): ?>
                                    <div class="form-group" id="recaptcha_view_listing">
                                        <?php echo Recaptcha::render(['callback' => 'recaptchaCallback']); ?>

                                        <input type="hidden" name="hiddenRecaptcha" id="hiddenRecaptcha">
                                    </div>
                                <?php endif; ?>

                                <div class="margin-t-30 hidden-sm hidden-md"></div>
                                <button class="btn-main" type="submit">
                                    <?php echo trans('front.CONTACT_SELLER'); ?> <i class="fa fa-spinner fa-pulse"></i>
                                </button>

                                <?php echo Form::close(); ?>

                                        <!-- End of form -->
                            </div>
                        </div>

                        <!-- Seller Details -->
                        <?php echo $__env->make('front.browse-listings.partials.seller-info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <?php if($seller->displayCompany()): ?>
                            <?php echo $__env->make('front.browse-listings.partials.company-info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>


                        <div class="side-widget social-share-links">
                            <div class="header"><i class="fa fa-share-alt"></i> <?php echo trans('front.social_share_links'); ?></div>
                            <div class="content">
                                <div class="share-link">
                                    <a target="_blank" onclick="return !window.open(this.href, 'Facebook', 'width=640,height=300')" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo URL::current(); ?>"><i class="fa fa-fw fa-facebook-square"></i> <?php echo trans('front.share_on_fb'); ?></a>
                                </div>
                                <div class="share-link">
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo $listing->present()->listingName; ?>+-+ONLY+<?php echo $listing->present()->listingPrice; ?>+on+<?php echo URL::current(); ?>" target="_blank" onclick="return !window.open(this.href, 'Facebook', 'width=540,height=500')"><i class="fa fa-fw fa-twitter"></i> <?php echo trans('front.share_on_tw'); ?></a>
                                </div>
                                <div class="share-link">
                                    <a href="https://plus.google.com/share?url=<?php echo URL::current(); ?>" onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-fw fa-google-plus"></i> <?php echo trans('front.share_on_g+'); ?></a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('front.browse-listings.js.js-view', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>