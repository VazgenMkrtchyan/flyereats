

<?php $__env->startSection('meta-title', trans('back.payment_settings')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.payment_settings'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.adjust_payment_settings'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                <?php echo Form::model(appCon(), ['route' => 'admin.settings.payment.update', 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


                <!-- text field for 'pp_email'-->
                <div class="form-group">
                    <?php echo Form::label('pp_email', trans('back.paypal_email').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::email('pp_email', null, ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- text field for 'pp_curr_code'-->
                <div class="form-group">
                    <?php echo Form::label('pp_curr_code', trans('back.currency_code').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('pp_curr_code', null, ['class' => 'form-control']); ?>

                    </div>

                    <div class="col-sm-offset-3 col-xs-12">
							<span class="help-block no-margin-bottom">
								<?php echo trans('back.more_info'); ?>: <a href="https://developer.paypal.com/docs/classic/api/currency_codes/" target="_blank"><?php echo trans('back.paypal_currency_codes'); ?></a>
							</span>
                    </div>
                </div>

                <!-- check box 'pp_sandbox'-->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('pp_sandbox', '1', null,  ['class' => 'ace']);; ?>

                                <span class="lbl"> <?php echo trans('back.sandbox_mode'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- check box 'pp_bypass'-->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('pp_bypass', '1', null,  ['class' => 'ace']);; ?>

                                <span class="lbl"> <?php echo trans('back.bypass_paypal'); ?></span>
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


<?php $__env->startSection('additional-scripts'); ?>

    <script>
        $( document ).ready( function() {

            //validation
            $( '#form-val' ).validate({
                rules: {
                    pp_email: {
                        required: true,
                        email: true
                    },
                    pp_curr_code: {
                        required: true
                    }
                },

                messages: {
                    pp_email: {
                        required: "<?php echo trans('back.paypal_email') . trans('back.required_not_empty'); ?>"
                    },
                    pp_curr_code: {
                        required: "<?php echo trans('back.currency_code') . trans('back.required_not_empty'); ?>"
                    }
                }
            });

        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>