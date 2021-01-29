<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title><?php echo $__env->yieldContent('meta-title'); ?></title>

    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>">

    <!-- ADDITIONAL STYLES -->
    <?php echo $__env->yieldContent('additional-css-before'); ?>
            <!-- ################# HEAD SCRIPTS AND STYLES ################# -->
    <?php echo $__env->make('admin.layout.partials.css-scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- Live Reload -->
    <?php if(File::exists(base_path('LIVE_RELOAD'))): ?>
        <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
        <?php endif; ?>

                <!-- ADDITIONAL STYLES -->
        <?php echo $__env->yieldContent('additional-css'); ?>

</head>

<body class="no-skin">

<!-- #################  NAVBAR GOES HERE  ################# -->
<?php echo $__env->make('admin.layout.partials.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="main-container" id="main-container">

    <!-- #################  SIDEBAR GOES HERE  ################# -->
    <?php echo $__env->make('admin.layout.partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- #################  PAGE CONTENT GOES HERE  ################# -->
    <div class="main-content">
        <div class="page-content">
            <!-- SERVER SIDE VALIDATION ALERTS -->
            <?php echo $__env->make('admin.layout.partials.alert-validation-server-side', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <!-- DEMO MODE -->
            <?php if(demo_mode_on()): ?>
                <div class="alert alert-warning">
                    Website is in <strong>Demo Mode</strong>. All changes are disabled!
                </div>
                <?php endif; ?>

                        <!-- FLASH MESSAGES -->
                <?php echo $__env->make('admin.layout.partials.flash-messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <!-- PAGE CONTENT -->
                <?php echo $__env->yieldContent('page-content'); ?>
        </div>
    </div>


    <!-- #################  FOOTER GOES HERE  ################# -->
    <?php echo $__env->make('admin.layout.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- for modal elements-->
    <?php echo $__env->yieldContent('modals'); ?>

            <!-- ICON for 'MOVING UP' -->
    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>

</div><!-- /.main-container -->

<!-- for dynamic JavaScript Variables Inclusion -->
<?php echo $__env->make('helpers.JSVariables', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- #################  MAJOR (BASIC) SCRIPTS GOES HERE  ################# -->
<?php echo $__env->make('admin.layout.partials.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <!-- #################  FOR ADDITIONAL SCRIPTS (page specific plugins, inline scripts)  ################# -->
<?php echo $__env->yieldContent('additional-scripts'); ?>
<?php echo $__env->yieldContent('additional-scripts-2'); ?>

</body>
</html>