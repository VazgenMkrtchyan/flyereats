<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>">

    <title><?php echo $__env->yieldContent('meta-title', 'Script Installation Wizard'); ?></title>

    <!-- HEAD STYLES & SCRIPTS -->
    <?php echo $__env->make('front.layout.partials.css-scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- For Additional CSS scripts -->
    <?php echo $__env->yieldContent('additional-css'); ?>

    <!-- Live Reload -->
    <?php if(getenv('LIVE_RELOAD') == 'true'): ?>
        <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
    <?php endif; ?>

</head>
<body>

<div class="container" id="installation-wizard">

    <!-- SERVER SIDE VALIDATION ALERTS(almost never visible) -->
    <?php echo $__env->make('front.layout.partials.alert-validation-server-side', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- FLASH MESSAGES -->
    <?php echo $__env->make('front.layout.partials.flash-messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- #################  CONTENT GOES HERE  ################# -->
    <?php echo $__env->yieldContent('content'); ?>

</div>

<!-- SCRIPTS -->
<?php echo $__env->make('front.layout.partials.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


 <!-- #################  FOR ADDITIONAL SCRIPTS (page specific plugin, inline scripts)  ################# -->
<?php echo $__env->yieldContent('additional-scripts'); ?>
<?php echo $__env->yieldContent('additional-scripts-2'); ?>

</body>
</html>