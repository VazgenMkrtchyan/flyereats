

<?php $__env->startSection('meta-title', trans('back.website_settings')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.website_settings'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.adjust_website_settings'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- LOGO UPLOAD -->
                <!-- Form -->
                <?php echo Form::open(['route' => 'admin.settings.uploadLogo', 'class' => 'form-horizontal', 'files' => true, 'id' => 'website-logo']); ?>


                <h3 class="header smaller lighter blue">
                    <?php echo trans('back.website_logo'); ?>

                </h3>

                <!-- Files Select Field-->
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">

                        <?php if(appCon()->logo): ?>
                            <img src="<?php echo asset('uploads/logos/'.appCon()->logo); ?>">
                        <?php else: ?>
                            <p><strong><?php echo trans('back.no_logo_uploaded'); ?></strong></p>
                        <?php endif; ?>

                        <div class="form-group form-error">
                            <div class="col-xs-10 col-sm-4">
                                <?php echo Form::file('logo', ['id' => 'logo']); ?>

                            </div>
                            <div id="logo-error" class="help-block col-xs-12 col-sm-reset red2" style="display: none">
                                <?php echo trans('back.not_valid_image'); ?>

                            </div>
                        </div>

                        <button id="upload-logo-button" class="btn btn-info" type="submit" disabled>
                            <i class="ace-icon fa fa-upload bigger-110"></i>
                            <?php echo trans('back.upload_logo'); ?>

                        </button>
                        <?php if(appCon()->logo): ?>
                            <a href="<?php echo route('admin.settings.deleteLogo'); ?>">
                                <button class="btn btn-danger" type="button">
                                    <i class="ace-icon fa fa-trash-o bigger-110"></i>
                                    <?php echo trans('back.delete_logo'); ?>

                                </button>
                            </a>
                        <?php endif; ?>

                        <p><br><strong><?php echo trans('back.note'); ?>:</strong> <?php echo trans('back.recommended_logo_size'); ?>

                    </div>
                </div>

                <?php echo Form::close(); ?>

                        <!-- End of form -->
                <!-- ./LOGO UPLOAD -->

                <!-- Form -->
                <?php echo Form::model(appCon(), ['route' => 'admin.settings.site-pref.update', 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


                <h3 class="header smaller lighter red">
                    <?php echo trans('back.main_website_settings'); ?>

                </h3>

                <!-- text field for 'web_type'-->
                <div class="form-group margin-b-10">
                    <label for="web_type" class="col-sm-3 control-label no-padding-right"><?php echo trans('back.website_type'); ?>: *
                        <span class="help-button" data-popover="#web_type">?</span>
                        </label>
                    <div class="col-xs-10 col-sm-5 margin-b-5">
                        <?php echo Form::select('web_type', [
                        'listing_plans' => trans('back.website_type_listing_plans'),
                        'membership_plans' => trans('back.website_type_membership_plans'),
                        ], null, ['id' => 'web_type', 'class' => 'form-control popover-info', 'disabled', 'data-toggle' => 'popover', 'data-placement' => 'bottom', 'data-content' => '<h5>' . trans('back.pricing_web_based') . ':</h5>
                        <ul>
                            <li>' . trans('back.pricing_listing_plans'). '</li>
                            <li>' . trans('back.pricing_membership_plans') . '</li>
                        </ul>', 'data-original-title' => trans('back.website_type')]); ?>

                    </div>
                    <div class="col-xs-12 col-sm-reset inline margin-b-5">
                        <a href="#change-type-modal" role="button" class="btn btn-white btn-info btn-bold" data-toggle="modal">
                            <i class="ace-icon fa fa-cogs bigger-120 blue"></i>
                            <?php echo trans('back.change_website_type'); ?>

                        </a>
                    </div>
                </div>

                <!-- text field for 'web_name'-->
                <div class="form-group">
                    <?php echo Form::label('web_name', trans('back.website_name').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('web_name', null, ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- text field for 'Title'-->
                <div class="form-group">
                    <?php echo Form::label('web_desc', trans('back.website_description').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('web_desc', null, ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- text field for 'Meta_desc'-->
                <div class="form-group">
                    <?php echo Form::label('meta_desc', trans('back.meta_description').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('meta_desc', null, ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- text field for 'Meta_keyw'-->
                <div class="form-group">
                    <?php echo Form::label('meta_keyw', trans('back.meta_keywords').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('meta_keyw', null, ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- text field for 'Fb_url'-->
                <div class="form-group">
                    <?php echo Form::label('fb_url', trans('back.facebook_url').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('fb_url', null, ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- text field for 'Tw_url'-->
                <div class="form-group">
                    <?php echo Form::label('tw_url', trans('back.twitter_url').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('tw_url', null, ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- text field for 'analytics_code'-->
                <div class="form-group">
                    <?php echo Form::label('analytics_code', trans('back.google_analytics_code').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::textarea('analytics_code', null, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>

                <!-- text field for 'google_maps_api_key'-->
                <div class="form-group">
                    <label for="google_maps_api_key" class="col-sm-3 control-label no-padding-right"><?php echo trans('back.google_maps_api_key'); ?>: *
                        <span class="help-button" data-popover="#google_maps_api_key">?</span>
                    </label>
                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('google_maps_api_key', null, ['id' => 'google_maps_api_key', 'class' => 'form-control popover-info', 'data-toggle' => 'popover', 'data-placement' => 'bottom', 'data-content' => trans('back.popover_google_maps_api_key'), 'data-original-title' => trans('back.google_maps_api_key')]); ?>

                    </div>
                </div>

                <!-- select box for 'req_email_conf'-->
                <div class="form-group">
                    <?php echo Form::label('require_email_conf', trans('back.require_email_confirmation').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('require_email_conf', [
                        '1' => trans('back.yes'),
                        '0' => trans('back.no')
                        ], null, ['class'=>'form-control']);; ?>

                    </div>
                </div>

                <!-- select box for 'acc_conf'-->
                <div class="form-group">
                    <?php echo Form::label('auto_acc_confirm', trans('back.new_accounts_confirmation').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('auto_acc_confirm', [
                        '1' => trans('back.automatic'),
                        '0' => trans('back.manual')
                        ], null, ['class'=>'form-control']);; ?>

                    </div>
                </div>

                <!-- check box 'featured_first'-->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('featured_first', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <?php echo trans('back.show_featured_first'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- check box 'show_errors'-->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('show_errors', '1', config('app.debug'), ['class' => 'ace']);; ?>

                                <span class="lbl"> <?php echo trans('back.show_detailed_errors'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <h3 class="header smaller lighter red popover-info" id="google_recaptcha" data-toggle="popover" data-placement="bottom" data-content="<?php echo trans('back.popover_google_recaptcha'); ?>" data-original-title="<?php echo trans('back.google_recaptcha'); ?>">
                    <?php echo trans('back.captchas'); ?>

                    <span class="help-button" data-popover="#google_recaptcha">?</span>
                </h3>

                <div class="form-group">
                    <label for="public_key" class="col-sm-3 control-label no-padding-right"><?php echo trans('back.recaptcha_public_key'); ?>:
                    </label>
                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('public_key', config('recaptcha.public_key'), ['class' => 'form-control']); ?>

                    </div>
                </div>

                <div class="form-group">
                    <?php echo Form::label('private_key', trans('back.recaptcha_private_key').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('private_key', config('recaptcha.private_key'), ['class' => 'form-control']); ?>

                    </div>
                </div>

                <!-- check box 'captcha_admin_login'-->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('captcha_admin_login', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <?php echo trans('back.captcha_admin_login'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- check box 'captcha_user_login'-->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('captcha_user_login', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <?php echo trans('back.captcha_user_login'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- check box 'captcha_register'-->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('captcha_register', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <?php echo trans('back.captcha_user_registration'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- check box 'captcha_contact_forms'-->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('captcha_contact_forms', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <?php echo trans('back.captcha_contact_forms'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- check box 'captcha_reset_pass'-->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('captcha_reset_pass', '1', null, ['class' => 'ace']);; ?>

                                <span class="lbl"> <?php echo trans('back.captcha_reset_password'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>


                <h3 class="header smaller lighter purple">
                    <?php echo trans('back.cronjobs'); ?>

                </h3>

                <!-- text field for 'cron_key'-->
                <div class="form-group">
                    <label for="cron_key" class="col-sm-3 control-label no-padding-right"><?php echo trans('back.cronjob_key'); ?>: *
                        <span class="help-button" data-popover="#cron_key">?</span>
                    </label>
                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::text('cron_key', null, ['id' => 'cron_key', 'class' => 'form-control popover-info', 'data-toggle' => 'popover', 'data-placement' => 'top', 'data-content' => trans('back.popover_cron_jobs'), 'data-original-title' => trans('back.cronjob_key')]); ?>

                    </div>

                    <div class="col-sm-offset-3 col-xs-9">
			<span class="help-block no-margin-bottom">
				<?php echo trans('back.cronjob_url'); ?>: <strong><?php echo route('cronjobs', appCon()->cron_key); ?></strong>
			</span>
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


<?php $__env->startSection('modals'); ?>
    <?php echo $__env->make('admin.web-options.partials.change-website-type-modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-scripts'); ?>
    <script>
        $( document ).ready( function() {
            //autosize
            $( "#analytics_code" ).autosize();

            var upload_logo_button = $( '#upload-logo-button' );
            var logo_error = $( '#logo-error' );

            $('#logo').ace_file_input({

                before_change: function() {
                    upload_logo_button.removeAttr('disabled');
                    logo_error.removeClass('inline');
                    return true;
                },
                before_remove: function() {
                    upload_logo_button.prop('disabled', true);
                    logo_error.removeClass('inline');
                    return true;
                },

                no_file:'<?php echo trans('back.fi_no_file'); ?>',
                btn_choose:'<?php echo trans('back.fi_choose'); ?>',
                btn_change:'<?php echo trans('back.fi_change'); ?>',
                droppable:false,
                onchange:null,
                thumbnail:false, //| true | large
                allowExt:  ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff', 'bmp']
            })
                    .on('file.error.ace', function() {
                        upload_logo_button.prop('disabled', true);
                        logo_error.addClass('inline');
                    });

            //validation
            $( '#form-val' ).validate({
                rules: {
                    web_name: {
                        required: true
                    },
                    cron_key: {
                        required: true
                    }
                },

                messages: {
                    web_name: {
                        required: "<?php echo trans('back.website_name') . trans('back.required_not_empty'); ?>"
                    },
                    cron_key: {
                        required: "<?php echo trans('back.cronjob_key') . trans('back.required_not_empty'); ?>"
                    }
                }
            });

            //CHANGE WEBSITE TYPE SUBMIT
            $('#change-type-button').click(function () {
                $(this).button('loading');
                $('#form-change-type').submit();
            })
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>