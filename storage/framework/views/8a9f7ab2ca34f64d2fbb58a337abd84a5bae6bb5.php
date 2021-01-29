<?php $__env->startSection('meta-title', trans('back.image_settings')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.image_settings'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.adjust_image_settings'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                <?php echo Form::model(appCon(), ['route' => 'admin.settings.image.update', 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


                <h3 class="header smaller lighter red">
                    <?php echo trans('back.listing_photo_size'); ?>

                </h3>

                <!-- text field for 'size_photo_x'-->
                <div class="form-group">
                    <?php echo Form::label('size_photo_x', trans('back.width').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-sm-5">
                        <?php echo Form::text('size_photo_x', null, ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- text field for 'size_photo_y'-->
                <div class="form-group">
                    <?php echo Form::label('size_photo_y', trans('back.height').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-sm-5">
                        <?php echo Form::text('size_photo_y', null, ['class' => 'form-control']); ?>

                    </div>
                </div>


                <h3 class="header smaller lighter purple">
                    <?php echo trans('back.listing_thumbnail_size'); ?>

                </h3>

                <!-- text field for 'size_thumb_x'-->
                <div class="form-group">
                    <?php echo Form::label('size_thumb_x', trans('back.width').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-sm-5">
                        <?php echo Form::text('size_thumb_x', null, ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- text field for 'size_thumb_y'-->
                <div class="form-group">
                    <?php echo Form::label('size_thumb_y', trans('back.height').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-sm-5">
                        <?php echo Form::text('size_thumb_y', null, ['class' => 'form-control']); ?>

                    </div>
                </div>


                <!-- submit for button -->
                <div class="clearfix form-actions">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            <?php echo trans('back.submit'); ?>

                        </button>
                    </div>
                </div>

                <?php echo Form::close(); ?>

                <!-- End of form -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('additional-scripts'); ?>

    <script>
        $( document ).ready( function() {

            //VALIDATION
            $( '#form-val' ).validate({
                rules: {
                    size_photo_x: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    size_photo_y: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    size_thumb_x: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    size_thumb_y: {
                        required: true,
                        number: true,
                        min: 0
                    }
                }
            });

        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>