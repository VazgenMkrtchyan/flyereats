<div class="side-widget seller-details">
    <div class="header"><i class="fa fa-user"></i> <?php echo trans('front.seller_details'); ?></div>
    <div class="content">
        <div class="seller-name"><?php echo $seller->first_name; ?> <?php echo $seller->last_name; ?></div>
        <div class="seller-type"><?php echo $seller->userGroup->name; ?></div>
        <?php if($seller->show_phone AND $seller->phone): ?>
            <div class="seller-info"><i class="fa fa-phone"></i><?php echo $seller->phone; ?></div>
        <?php endif; ?>
        <div class="seller-info"><i class="fa fa-envelope-o"></i><?php echo $seller->email; ?></div>
        <?php if(isset($listing)): ?>
            <div class="seller-info"><i class="fa fa-bars"></i><a href="<?php echo route('browselistings.index', ['userId' => $listing->user_id]); ?>"><?php echo trans('front.view_seller_listings'); ?></a></div>
        <?php endif; ?>
    </div>
</div>