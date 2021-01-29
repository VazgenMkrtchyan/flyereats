<a href="<?php echo $listing->present()->seoUrl; ?>" class="listing">

    <div class="listing-data <?php echo $listgrid; ?>">

        <div class="img-wrapper">
            <div class="img-data">
                <i class="fa fa-spinner fa-pulse buffering"></i>
                <ul id="thumb-gal-<?php echo str_random(6); ?>" class="thumb-gal loading">
                    <?php if(count($listing->photos)): ?>
                        <?php foreach($listing->photos->take( $listing->maxPhotosNo() == 'UNLIMITED' ? 1000 : $listing->maxPhotosNo() ) as $photo): ?>
                            <li>
                                <img data-src="<?php echo $photo->present()->thumbUrl; ?>" src="<?php echo asset('templates/misc/thumb_empty.png'); ?>">
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>
                            <img data-src="<?php echo asset('templates/misc/no_listing_photo_thumb.png'); ?>" src="<?php echo asset('templates/misc/thumb_empty.png'); ?>">
                        </li>
                    <?php endif; ?>
                </ul>

                <!--<span class="plus-sign">+</span>-->
                <?php if($listing->isFeatured()): ?>
                    <span class="badge featured">Sold</span>
                <?php elseif($listing->isHighlighted()): ?>
                    <span class="badge">Highlighted</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="title"><?php echo $listing->present()->listingName; ?></div>

        <table class="info-table">
            <tr>
                <td class="option">Year:</td>
                <td class="info"><?php echo $listing->year; ?></td>
            </tr>
            <tr>
                <td class="option">Mileage:</td>
                <td class="spec"><?php echo $listing->present()->carMileage; ?></td>
            </tr>
            <tr>
                <td class="option">Fuel Type:</td>
                <td class="spec"><?php echo $listing->present()->carFuelType; ?></td>
            </tr>
            <tr>
                <td class="option">Transmission:</td>
                <td class="spec"><?php echo $listing->present()->carTransmission; ?></td>
            </tr>
        </table>

        <div class="visible-lg">
            <table class="info-table secondary">
                <tr>
                    <td class="option">Body Type:</td>
                    <td class="info"><?php echo $listing->present()->carCondition; ?></td>
                </tr>
                <tr>
                    <td class="option">Drive Type:</td>
                    <td class="spec"><?php echo $listing->present()->carDriveType; ?></td>
                </tr>
                <tr>
                    <td class="option">Exterior Color:</td>
                    <td class="spec"><?php echo $listing->present()->carExtColor; ?></td>
                </tr>
                <tr>
                    <td class="option">Interior Color:</td>
                    <td class="spec"><?php echo $listing->present()->carIntColor; ?></td>
                </tr>
            </table>
        </div>

        <div class="price-info">
            <?php echo $listing->present()->listingPrice; ?>

        </div>

        <?php if($listing->isSeen()): ?>
            <div class="listing-seen">
                <i class="fa fa-history" title="<?php echo trans('front.already_seen'); ?>"></i>
            </div>
        <?php endif; ?>

        <div class="listing-love" data-love-listing="<?php echo route('love_listing', $listing->id); ?>">
            <?php if($listing->isLoved()): ?>
                <i class="fa fa-heart" title="<?php echo trans('front.undo'); ?>"></i>
            <?php else: ?>
                <i class="fa fa-heart-o" title="<?php echo trans('front.love'); ?>"></i>
            <?php endif; ?>
        </div>

    </div>

</a>