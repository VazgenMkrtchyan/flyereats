

<?php $__env->startSection('meta-title', trans('back.browse_and_manage_data_field', ['data_field' => trans('back.vehicle_features')])); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.data_fields_for', ['for' => trans('back.vehicle_features')]); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.browse_and_manage_data_field', ['data_field' => trans('back.vehicle_features')]); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="margin-b-10">
                    <a href="<?php echo route('admin.data_features.create'); ?>">
                        <button class="btn btn-white btn-pink btn-bold">
                            <span class="ace-icon fa fa-plus icon-on-left"></span>
                            <?php echo trans('back.add_data_field', ['data_field' => str_singular(trans('back.vehicle_features'))]); ?>

                        </button>
                    </a>
                    <span class="per_page">
                        <?php echo Form::select('per_page', rangePerPage(), sessionOrWebc('ai_datafields_no', Route::currentRouteName()), ['class'=>'form-control']);; ?>

                    </span>
                </div>

                <!-- FEATURES -->
                <?php echo $__env->make('admin.data-fields.features.partials.features', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('admin.js.destroy', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>