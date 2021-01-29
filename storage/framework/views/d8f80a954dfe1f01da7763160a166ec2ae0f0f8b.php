

<?php $__env->startSection('meta-title', siteTitle(trans('front.title_edit_company'))); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('front.user-company-profile.partials.not-displayed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <h1><i class="fa fa-pencil"></i> <?php echo trans('front.edit_compprofile'); ?></h1>


    <?php echo $__env->make('front.user-company-profile.partials.upload-delete-logo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- Form -->
    <?php echo Form::model($compprofile, ['route' => 'compprofile.update', 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'form-val']); ?>


            <!-- hidden field for old_state_id -->
    <?php echo Form::hidden('old_state_id', $compprofile->state_id); ?>

            <!-- hidden field for old_city -->
    <?php echo Form::hidden('old_city', $compprofile->city); ?>

            <!-- hidden field for old_addr_1 -->
    <?php echo Form::hidden('old_addr_1', $compprofile->addr_1); ?>

            <!-- hidden field for old_zip -->
    <?php echo Form::hidden('old_zip', $compprofile->zip); ?>


            <!-- FIELDS -->
    <?php echo $__env->make('front.user-company-profile.partials.create-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- submit button -->
    <div class="form-group margin-t-30">
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
            <button class="btn-main" type="submit">
                <?php echo trans('front.UPDATE_COMPPROFILE'); ?>

            </button>
        </div>
    </div>

    <!-- Cancel Button -->
    <div class="form-group">
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
            <a href="<?php echo route('account_summary'); ?>">
                <button class="btn-main btn-grey" type="button">
                    <?php echo trans('front.CANCEL'); ?>

                </button>
            </a>
        </div>
    </div>

    <?php echo Form::close(); ?>

            <!-- End of form -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>