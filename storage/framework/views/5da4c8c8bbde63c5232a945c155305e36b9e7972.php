
<div class="listing-photos">
    <div class="row">
        <canvas id="c"></canvas>
        <canvas id="i1"></canvas>
        <?php for($i = 0; $i < count($photos); $i++): ?> 
            <div class="col-sm-6 col-md-4 col-lg-3 center img-listing-photo" data-photo-block="<?php echo $photos[$i]->id; ?>">

                <div>
                    <img src="<?php echo $photos[$i]->present()->thumbUrl(); ?>" class="img-thumbnail img-responsive" data-photo="<?php echo $photos[$i]->id; ?>">
                </div>

                <div class="photo-actions margin-t-10 margin-b-10">
                    <?php if($i != 0): ?>
                        <button type="button" class="btn btn-white btn-primary btn-bold" data-move-photo="<?php echo $photos[$i]->id; ?>" data-move-target="<?php echo $photos[$i-1]->id; ?>" data-move-left>
                            <i class="ace-icon fa fa-arrow-left bigger-120"></i>
                        </button>
                    <?php endif; ?>


                    <button type="button" class="btn btn-white btn-danger btn-bold" data-delete-photo="<?php echo $photos[$i]->id; ?>">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                        <?php echo trans('back.delete'); ?>

                    </button>


                    <?php if($i != count($photos)-1): ?>
                        <button type="button" class="btn btn-white btn-primary btn-bold" data-move-photo="<?php echo $photos[$i]->id; ?>" data-move-target="<?php echo $photos[$i+1]->id; ?>" data-move-right>
                            <i class="ace-icon fa fa-arrow-right bigger-120"></i>
                        </button>
                    <?php endif; ?>

                    <button type="button" class="btn btn-white btn-primary btn-bold" data-rotate-photo="<?php echo $photos[$i]->id; ?>" data-rotate="0">
                        <i class="ace-icon fa fa-repeat bigger-120"></i>
                    </button>

                    <?php if($i >= $listing->maxPhotosNo() AND $listing->maxPhotosNo() != 'UNLIMITED'): ?>
                        <p data-not-shown-notify style="color: red">(<?php echo trans('back.not_shown'); ?>)</p>
                    <?php endif; ?>
                </div>

            </div>

        <?php endfor; ?>
    </div>
</div>

<?php if(! count($listing->photos)): ?>
    <div class="alert alert-danger"><?php echo trans('back.no_photos_uploaded'); ?></div>
<?php endif; ?>