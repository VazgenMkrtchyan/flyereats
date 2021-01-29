<!-- THIS PARTIAL IS USED IN AJAX LOAD TOO! -->

<div class="row">
    <?php for($i = 0; $i < count($photos); $i++): ?>
        <div class="col-sm-6 col-lg-3" data-photo-block="<?php echo $photos[$i]->id; ?>">

            <div class="uploaded-photo">

                <div class="photo">
                    <img src="<?php echo asset($photos[$i]->present()->thumbUrl()); ?>" class="img-responsive img-rounded" data-photo="<?php echo $photos[$i]->id; ?>">
                </div>


                <div class="photo-actions">

                    <?php if($i != 0): ?>
                        <button type="button" class="btn btn-primary" data-move-photo="<?php echo $photos[$i]->id; ?>" data-move-target="<?php echo $photos[$i-1]->id; ?>" data-move-left>
                            <i class="fa fa-arrow-left"></i>
                        </button>
                    <?php endif; ?>


                    <button type="button" class="btn btn-primary" data-delete-photo="<?php echo $photos[$i]->id; ?>">
                        <i class="fa fa-trash-o"></i>
                        <?php echo trans('front.delete'); ?>

                    </button>


                    <?php if($i != count($photos)-1): ?>
                        <button type="button" class="btn btn-primary" data-move-photo="<?php echo $photos[$i]->id; ?>" data-move-target="<?php echo $photos[$i+1]->id; ?>" data-move-right>
                            <i class="fa fa-arrow-right"></i>
                        </button>
                    <?php endif; ?>

                </div>


                <?php if($i >= $listing->maxPhotosNo() AND $listing->maxPhotosNo() != 'UNLIMITED'): ?>
                    <div class="not-shown" data-not-shown-notify>
                        (<?php echo trans('front.not_shown'); ?>)
                    </div>
                <?php endif; ?>

            </div>
        </div>
    <?php endfor; ?>
</div>