

<?php $__env->startSection('meta-title', trans('back.edit_data_field_title')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.data_fields_for', ['for' => $parent->name]); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.edit_model'); ?>

            </small>

        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <?php echo Form::model($model, ['route' => ['admin.data_models.update', $parent->id, $model->id], 'class' => 'form-horizontal', 'id' => 'form-val', 'method' => 'PATCH']); ?>


                <!-- text field for 'name'-->
                <div class="form-group">
                    <?php echo Form::label('name', trans('back.name').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- text field for 'order'-->
                <div class="form-group">
                    <?php echo Form::label('order', trans('back.order').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('order', null, ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!--BUTTONS-->
                <div class="clearfix form-actions">
                    <div class="col-sm-offset-3 col-sm-9">

                        <!-- submit button -->
                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            <?php echo trans('back.submit'); ?>

                        </button>

                        &nbsp; &nbsp; &nbsp;

                        <!-- cancel button -->
                        <a href="<?php echo route('admin.data_models.index', $parent->id); ?>" class="btn btn-danger">
                            <i class="ace-icon fa fa-times bigger-110"></i>
                            <?php echo trans('back.cancel'); ?>

                        </a>

                    </div>
                </div>

                <?php echo Form::close(); ?>

                        <!-- End of form -->

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_identifier -->
    <?php echo Form::hidden('nav_li_identifier', 'admin.data_makes.index'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('admin.data-fields.models.js.js-create-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>