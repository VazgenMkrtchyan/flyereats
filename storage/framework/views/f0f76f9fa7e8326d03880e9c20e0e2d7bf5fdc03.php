

<?php $__env->startSection('meta-title', trans('back.mail_settings')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.mail_settings'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.adjust_mail_settings'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                <?php echo Form::open(['route' => 'admin.settings.mail.update', 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


                <h3 class="header smaller lighter red">
                    <?php echo trans('back.general_mail_settings'); ?>

                </h3>

                <!-- text field for 'Cont_email'-->
                <div class="form-group">
                    <?php echo Form::label('cont_email', trans('back.contact_us_email').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::email('cont_email', appCon()->cont_email, ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- text field for 'from_email'-->
                <div class="form-group">
                    <?php echo Form::label('from_email', trans('back.from_email').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::email('from_email', config('mail.from')['address'], ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- text field for 'from_name'-->
                <div class="form-group">
                    <?php echo Form::label('from_name', trans('back.from_name').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('from_name', config('mail.from')['name'], ['class' => 'form-control']); ?>

                    </div>
                </div>

                <h3 class="header smaller lighter green">
                    <?php echo trans('back.smtp_settings'); ?>

                </h3>

                <!-- text field for 'Smtp_host'-->
                <div class="form-group">
                    <?php echo Form::label('smtp_host', trans('back.smtp_host').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('smtp_host', config('mail.host'), ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- text field for 'Smtp_user'-->
                <div class="form-group">
                    <?php echo Form::label('smtp_user', trans('back.smtp_user').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('smtp_user', config('mail.username'), ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- text field for 'Smtp_pass'-->
                <div class="form-group">
                    <?php echo Form::label('smtp_pass', trans('back.smtp_password').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('smtp_pass', config('mail.password'), ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- text field for 'smtp_port'-->
                <div class="form-group">
                    <?php echo Form::label('smtp_port', trans('back.smtp_port').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('smtp_port', config('mail.port'), ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- check box 'smtp_use'-->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('smtp_use', '1', config('mail.driver') == 'smtp', ['class' => 'ace']);; ?>

                                <span class="lbl"> <?php echo trans('back.use_smtp'); ?></span>
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
                    cont_email: {
                        required: true,
                        email: true
                    },
                    from_email: {
                        required: true,
                        email: true
                    },
                    from_name: {
                        required: true
                    },
                    smtp_host: {
                        required: function() {
                            return $( "[name='smtp_use']" ).prop( "checked" );
                        }
                    },
                    smtp_user: {
                        required: function() {
                            return $( "[name='smtp_use']" ).prop( "checked" );
                        }
                    },
                    smtp_pass: {
                        required: function() {
                            return $( "[name='smtp_use']" ).prop( "checked" );
                        }
                    }
                },

                messages: {
                    cont_email: {
                        required: "<?php echo trans('back.contact_us_email') . trans('back.required_not_empty'); ?>"
                    },
                    from_email: {
                        required: "<?php echo trans('back.from_email') . trans('back.required_not_empty'); ?>"
                    },
                    from_name: {
                        required: "<?php echo trans('back.from_name') . trans('back.required_not_empty'); ?>"
                    },
                    smtp_host: {
                        required: "<?php echo trans('back.smtp_host') . trans('back.required_not_empty'); ?>"
                    },
                    smtp_user: {
                        required: "<?php echo trans('back.smtp_user') . trans('back.required_not_empty'); ?>"
                    },
                    smtp_pass: {
                        required: "<?php echo trans('back.smtp_password') . trans('back.required_not_empty'); ?>"
                    }
                }
            });

            //revalidates smtp fields
            $( "[name='smtp_use']" ).change( function() {
                $( "#smtp_host" ).valid();
                $( "#smtp_user" ).valid();
                $( "#smtp_pass" ).valid();
            });

        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>