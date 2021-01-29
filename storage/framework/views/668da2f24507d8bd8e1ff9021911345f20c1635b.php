<!-- Form -->
<?php echo Form::open(['route' => 'compprofilelogo.upload', 'class' => 'form-horizontal', 'files' => true, 'id' => 'company-logo']); ?>


<h3><i class="fa fa-picture-o"></i> <?php echo trans('front.company_logo'); ?></h3>

<!-- Files Select Field-->
<div class="form-group">
    <div class="col-sm-offset-3 col-md-offset-2">

        <?php if($compprofile->logo): ?>
            <img src="<?php echo $compprofile->logoUrl(); ?>">
        <?php else: ?>
            <p><strong><?php echo trans('front.no_logo_uploaded'); ?></strong></p>
        <?php endif; ?>

        <p><?php echo Form::file('logo'); ?></p>

        <div class="form-group margin-t-30">
            <!-- submit for button -->
            <div class="col-sm-6 col-md-4">
                <button class="btn-main" type="submit">
                    <?php echo trans('front.UPLOAD_LOGO'); ?>

                </button>
            </div>
        </div>

        <?php if($compprofile->logo): ?>
            <div class="form-group">
                <div class="col-sm-6 col-md-4">
                    <a href="<?php echo route('compprofilelogo.delete'); ?>">
                        <button class="btn-main btn-grey" type="button">
                            <?php echo trans('front.DELETE_LOGO'); ?>

                        </button>
                    </a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php echo Form::close(); ?>

<!-- End of form -->