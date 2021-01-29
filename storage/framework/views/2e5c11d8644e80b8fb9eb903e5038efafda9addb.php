<h3 class="header smaller lighter red">
    <?php echo trans('back.upload_photos'); ?>

</h3>

<!-- dropzone -->
<form action="<?php echo route('admin.listing-photos.upload', $listing->id); ?>" class="dropzone" id="dropzone" method="POST">
    <!-- hidden field for csrf token -->
    <?php echo Form::hidden('_token', csrf_token()); ?>

</form>


<!-- dropzone fallback upload if older browser -->
<div id="fallback" style="display: none">

    <div class="alert alert-warning" role="alert" id="fallback-alert">
        <strong><?php echo trans('back.note'); ?>:</strong> <?php echo trans('back.update_browser_for_multiple_upload'); ?>

    </div>

    <!-- Form -->
    <?php echo Form::open(['route' => ['admin.listing-photos.upload', $listing->id], 'files' => true]); ?>

            <!-- hidden field for csrf token -->
    <?php echo Form::hidden('_token', csrf_token()); ?>

            <!-- hidden field for fallback -->
    <?php echo Form::hidden('fallback', 'true'); ?>

            <!-- file field-->
    <div class="form-group">
        <label for="file"><?php echo trans('back.select_file'); ?></label>
        <input name="file" type="file">
    </div>
    <button type="submit" class="btn btn-success"><?php echo trans('back.upload_photo'); ?></button>
    <?php echo Form::close(); ?>


</div>


<h3 class="header smaller lighter green">
    <?php echo trans('back.manage_photos'); ?>

</h3>

<!-- listing photos-->
<div id="listingPhotos" data-max-photos="<?php echo $listing->maxPhotosNo(); ?>">
    <?php echo $__env->make('admin.listings.partials.listing-photos-ajax', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>