<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?php echo trans('back.login_page'); ?> - <?php echo trans('back.product_name_version'); ?></title>

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>">

    <!-- ################# HEAD SCRIPTS AND STYLES ################# -->
    <?php echo $__env->make('admin.layout.partials.css-scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>

<body class="login-layout light-login">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <h1>
                            <i class="ace-icon fa fa-car green"></i>
                            <span class="red"><?php echo trans('back.product_name'); ?></span>
                            <span class="grey" id="id-text2"><?php echo trans('back.product_version'); ?></span>
                        </h1>

                        <!-- SERVER SIDE VALIDATION ALERTS -->
                        <?php echo $__env->make('admin.layout.partials.alert-validation-server-side', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <!-- FLASH MESSAGES -->
                        <?php echo $__env->make('admin.layout.partials.flash-messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <?php if(demo_mode_on()): ?>
                        <div class="alert alert-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="ace-icon fa fa-times"></i></button>
                            <strong><?php echo trans('back.demo_credentials'); ?>:</strong><br>
                            <?php echo trans('back.username'); ?>: admin<br>
                            <?php echo trans('back.password'); ?>: admin
                        </div>
                            <?php endif; ?>

                    </div>

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <i class="ace-icon fa fa-lock green"></i>
                                        <?php echo trans('back.enter_your_info'); ?>

                                    </h4>

                                    <div class="space-6"></div>

                                    <?php echo Form::open(['route' => 'admin.sessions.store', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


                                    <fieldset>
                                        <label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<?php echo Form::text('username', null, ['class' => 'form-control', 'placeholder' => trans('back.username')]); ?>

                                                    <i class="ace-icon fa fa-user"></i>
												</span>
                                        </label>

                                        <label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<?php echo Form::password('password', ['class' => 'form-control', 'placeholder' => trans('back.password')]); ?>


                                                    <i class="ace-icon fa fa-lock"></i>
												</span>
                                        </label>

                                        <!-- CAPTCHA -->
                                        <?php if(appCon()->captcha_admin_login): ?>
                                            <?php echo Recaptcha::render(['callback' => 'recaptchaCallback']); ?>

                                            <input type="hidden" name="hiddenRecaptcha" id="hiddenRecaptcha">
                                        <?php endif; ?>

                                        <div class="space"></div>

                                        <div class="clearfix">
                                            <label class="inline">
                                                <input type="checkbox" name="remember_me" class="ace" value="1" />
                                                <span class="lbl"> <?php echo trans('back.remember_me'); ?></span>
                                            </label>

                                            <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                <i class="ace-icon fa fa-key"></i>
                                                <span class="bigger-110"><?php echo trans('back.login'); ?></span>
                                            </button>
                                        </div>

                                        <div class="space-4"></div>
                                    </fieldset>

                                    <?php echo Form::close(); ?>


                                </div><!-- /.widget-main -->

                                <div class="toolbar clearfix">
                                    <div>
                                        <a href="<?php echo route('password.getRemind'); ?>" class="forgot-password-link" target="_blank">
                                           <?php echo trans('back.i_forgot_my_password'); ?>

                                        </a>
                                    </div>

                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->

                    </div><!-- /.position-relative -->
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.main-content -->
</div><!-- /.main-container -->



<!-- #################  MAJOR (BASIC) SCRIPTS GOES HERE  ################# -->
<?php echo $__env->make('admin.layout.partials.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


</body>
</html>