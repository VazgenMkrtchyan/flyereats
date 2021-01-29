

<?php $__env->startSection('meta-title', siteTitle(trans('front.title_create_company'))); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('front.user-company-profile.partials.not-displayed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <h1><i class="fa fa-plus"></i> <?php echo trans('front.create_compprofile'); ?></h1>

    <!-- Form -->
    <?php echo Form::open(['route' => 'compprofile.store', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


            <!-- FIELDS -->
    <?php echo $__env->make('front.user-company-profile.partials.create-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- submit button -->
    <div class="form-group margin-t-30">
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
            <button class="btn-main" type="submit">
                <?php echo trans('front.CREATE_COMPPROFILE'); ?>

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