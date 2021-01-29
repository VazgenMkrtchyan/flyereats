<div class="side-widget company-profile">
    <div class="header"><i class="fa fa-building"></i> <?php echo trans('front.company_details'); ?></div>
    <div class="content">
        <?php if($seller->compprofile->logo): ?>
            <div class="comp-logo">
                <img src="<?php echo $seller->compprofile->logoUrl(); ?>" class="img-responsive">
            </div>
        <?php endif; ?>
        <div class="comp-name">Car Dealer | Newcastle </div>
        <?php if($seller->compprofile->phone): ?>
            <div class="comp-info"><i class="fa fa-phone"></i><?php echo $seller->compprofile->phone; ?></div>
        <?php endif; ?>
        <?php if($seller->compprofile->email): ?>
            <div class="comp-info"><i class="fa fa-envelope-o"></i><?php echo $seller->compprofile->email; ?></div>
        <?php endif; ?>
        <?php if($seller->compprofile->fax): ?>
            <div class="comp-info"><i class="fa fa-fax"></i><?php echo $seller->compprofile->fax; ?></div>
        <?php endif; ?>
        <?php if($seller->compprofile->web_url): ?>
            <div class="comp-info"><i class="fa fa-desktop"></i><a href="<?php echo $seller->compprofile->web_url; ?>" target="_blank"><?php echo $seller->compprofile->web_url; ?></a></div>
        <?php endif; ?>
        <div class="comp-info"><i class="fa fa-map-marker"></i>160 Kemp House, City Road, London, England, EC1V 2NX</div>
        <?php if($seller->compprofile->description): ?>
            <div class="comp-info"><i class="fa fa-info"></i><?php echo e($seller->compprofile->present()->compDesc['text']); ?><?php echo $seller->compprofile->present()->compDesc['read_more']; ?></div>
        <?php endif; ?>
    </div>
</div>