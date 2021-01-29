

<?php $__env->startSection('meta-title', trans('back.delete_user')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.delete_user'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.delete_user_preferences'); ?>

            </small>

        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <h3 class="header smaller lighter red">
                    <?php echo $user->present()->fullName; ?>

                </h3>

                <!-- Form -->
                <?php echo Form::open(['route' => ['admin.users.delete', $user->id], 'class' => 'form-horizontal', 'method' => 'DELETE']); ?>


                <div class="control-group">
                    <label class="control-label bolder blue"><?php echo trans('back.available_options'); ?></label>

                    <div class="radio">
                        <label>
                            <input name="delete_option" type="radio" class="ace" value="delete_everything" checked>
                            <span class="lbl"> <?php echo trans('back.delete_all_user_listings', ['user' => $user->present()->fullName]); ?> (<?php echo $user->present()->listingsNo; ?>)</span>
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input name="delete_option" type="radio" class="ace" value="delete_transfer">
                            <span class="lbl"> <?php echo trans('back.transfer_listings_to'); ?>:</span>
                        </label>
                    </div>

                    <!-- select box for 'transfer_to'-->
                    <div class="form-group">
                        <?php echo Form::label('transfer_to', 'Transfer To:', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                        <div class="col-sm-9">
                            <select name="transfer_to" class="form-control input-xlarge">
                                <?php foreach($recipients as $recipient): ?>
                                    <option value="<?php echo $recipient->id; ?>"><?php echo $recipient->present()->fullName; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                </div>


                <!-- BUTTONS -->
                <div class="clearfix form-actions">
                    <div class="col-sm-offset-3 col-sm-9">
                        <!-- submit for button -->
                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            <?php echo trans('back.delete_user'); ?>

                        </button>

                        &nbsp; &nbsp; &nbsp;

                        <!-- cancel button -->
                        <a href="<?php echo URL::previous(); ?>">
                            <button class="btn btn-danger" type="button">
                                <i class="ace-icon fa fa-times bigger-110"></i>
                                <?php echo trans('back.cancel'); ?>

                            </button>
                        </a>

                    </div>
                </div>


                <?php echo Form::close(); ?>

                <!-- End of form -->

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>