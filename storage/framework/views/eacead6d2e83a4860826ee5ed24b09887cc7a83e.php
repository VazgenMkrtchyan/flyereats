<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo siteTitle(trans('front.title_print_page', ['listingName' => $listing->present()->listingName])); ?></title>

    <!-- core CSS -->
    <link rel="stylesheet" href="<?php echo asset('templates/front/css/' . appCon()->color_scheme . '-theme.css'); ?>">
    
    <!-- font -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans%3A400%2C600%2C300&#038;subset=latin%2Clatin-ext&#038;ver=4.2.2' type='text/css' media='all' />
</head>

<body>

<div class="printable-page">

    <div class="print-close clearfix no-print">
        <span class="close-page"><?php echo trans('front.close_window'); ?></span>
        <span class="print-page"><i class="fa fa-print"></i> <?php echo trans('front.print_page'); ?></span>
    </div>


    <div class="listing-info margin-b-30">

        <h3><?php echo $listing->present()->listingName; ?> - <?php echo $listing->present()->listingPrice; ?></h3>

        <div class="listing-photos margin-t-30 margin-b-30">
            <h3><i class="fa fa-picture-o"></i> <?php echo trans('front.few_photos'); ?></h3>
            <?php if($listing->photos()->count()): ?>
                <div class="row">
                    <?php foreach($photos as $photo): ?>
                        <div class="col-xs-4"><img src="<?php echo asset($photo->present()->thumbUrl()); ?>" alt="Some Alternative Text" class="img-responsive img-thumbnail"></div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <?php echo trans('front.listing_has_no_photos'); ?>

            <?php endif; ?>
        </div>


        <div class="listing-details margin-b-30">
            <h3><i class="fa fa-cogs"></i> <?php echo trans('front.main_vehicle_details'); ?></h3>
            <div class="row">
                <div class="col-xs-6">
                    <table class="details-table">
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
                <div class="col-xs-6">
                    <table class="details-table">
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
                            <td class="info"><?php echo $listing->engine_cyl; ?></td>
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


        <div class="margin-b-30">
            <h3><i class="fa fa-check-square-o"></i> <?php echo trans('front.vehicle_features'); ?></h3>
            <div class="row">
                <?php foreach($listing->features as $feature): ?>
                    <div class="col-xs-4">
                        <i class="fa fa-check"></i> <?php echo $feature->name; ?>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>


        <div class="margin-b-30">
            <h3><i class="fa fa-user"></i> <?php echo trans('front.seller_details'); ?></h3>
            <div class="row">
                <div class="col-xs-6">
                    <table class="details-table">
                        <tbody>
                        <tr>
                            <td><?php echo trans('front.name'); ?>:</td>
                            <td class="info"><?php echo $seller->first_name; ?> <?php echo $seller->last_name; ?></td>
                        </tr>
                        <?php if($seller->show_phone AND $seller->phone): ?>
                            <tr>
                                <td><?php echo trans('front.phone'); ?>:</td>
                                <td class="info"><?php echo $seller->phone; ?></td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td><?php echo trans('front.email'); ?>:</td>
                            <td class="info"><?php echo $seller->email; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <?php if($seller->displayCompany()): ?>
            <div class="margin-b-30">
                <h3><i class="fa fa-building"></i> <?php echo trans('front.company_details'); ?></h3>
                <div class="row">
                    <div class="col-xs-6">
                        <table class="details-table">
                            <tbody>
                            <tr>
                                <td><?php echo trans('front.name'); ?>:</td>
                                <td class="info"><?php echo $seller->compprofile->name; ?></td>
                            </tr>
                            <?php if($seller->compprofile->email): ?>
                                <tr>
                                    <td><?php echo trans('front.email'); ?>:</td>
                                    <td class="info"><?php echo $seller->compprofile->email; ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if($seller->compprofile->phone): ?>
                                <tr>
                                    <td><?php echo trans('front.phone'); ?>:</td>
                                    <td class="info"><?php echo $seller->compprofile->phone; ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if($seller->compprofile->fax): ?>
                                <tr>
                                    <td><?php echo trans('front.fax'); ?>:</td>
                                    <td class="info"><?php echo $seller->compprofile->fax; ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if($seller->compprofile->web_url): ?>
                                <tr>
                                    <td><?php echo trans('front.website'); ?>:</td>
                                    <td class="info"><?php echo $seller->compprofile->web_url; ?></td>
                                </tr>
                            <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                    <?php if($seller->compprofile->logo): ?>
                        <div class="col-xs-6">
                            <table class="details-table">
                                <tbody>
                                <tr>
                                    <td>
                                        <img src="<?php echo $seller->compprofile->logoUrl(); ?>" class="img-responsive">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php endif; ?>


    </div>

    <div class="print-close clearfix no-print">
        <span class="close-page"><?php echo trans('front.close_window'); ?></span>
        <span class="print-page"><i class="fa fa-print"></i> <?php echo trans('front.print_page'); ?></span>
    </div>

</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<script>
    $( document ).ready(function() {

        $( ".close-page" ).click(function() {
            window.close();
        });

        $( ".print-page" ).click(function() {
            window.print();
        });
    })
</script>

</body>
</html>
