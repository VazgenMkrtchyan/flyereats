<?php $__env->startSection('meta-title', trans('back.email_notifications')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.email_notifications'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.adjust_email_notifications'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                <?php echo Form::model(appCon(), ['route' => 'admin.settings.email-not.update', 'method' => 'PATCH', 'class' => 'form-horizontal']); ?>


                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('email_welcome', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <?php echo trans('back.welcome_notification'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('email_payment_received', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <?php echo trans('back.payment_received_notification'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('email_account_approved', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <?php echo trans('back.account_approved_notification'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('email_listing_approved', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <?php echo trans('back.listing_approved_notification'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('email_listing_expired', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <strong><i><?php echo trans('back.reminder'); ?>:</i></strong> <?php echo trans('back.listing_expired_notification'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('email_listing_expires_2', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <strong><i><?php echo trans('back.reminder'); ?>:</i></strong> <?php echo trans('back.listing_expires_2_notification'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('email_listing_expires_7', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <strong><i><?php echo trans('back.reminder'); ?>:</i></strong> <?php echo trans('back.listing_expires_7_notification'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('email_membership_expired', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <strong><i><?php echo trans('back.reminder'); ?>:</i></strong> <?php echo trans('back.membership_plan_expired_notification'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('email_membership_expires_2', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <strong><i><?php echo trans('back.reminder'); ?>:</i></strong> <?php echo trans('back.membership_plan_expiring_2_notification'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('email_membership_expires_7', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <strong><i><?php echo trans('back.reminder'); ?>:</i></strong> <?php echo trans('back.membership_plan_expiring_7_notification'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('email_listing_enhancement_expired', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <strong><i><?php echo trans('back.reminder'); ?>:</i></strong> <?php echo trans('back.listing_enhancement_expired_notification'); ?></span>
                            </label>
                        </div>
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
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>