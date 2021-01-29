<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="<?php echo appCon()->meta_keyw; ?>">
    <meta name="description" content="<?php $__env->startSection('meta-description'); ?><?php echo appCon()->meta_desc; ?><?php echo $__env->yieldSection(); ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>">

    <title><?php echo $__env->yieldContent('meta-title', appCon()->web_name); ?></title>

    <!-- Open Graph Data (for FaceBook and Google+ Share)-->
    <?php echo $__env->yieldContent('og-data'); ?>

            <!-- HEAD STYLES & SCRIPTS -->
    <?php echo $__env->make('front.layout.partials.css-scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- For Additional CSS scripts -->
    <?php echo $__env->yieldContent('additional-css'); ?>


            <!-- Live Reload -->
    <?php if(File::exists(base_path('LIVE_RELOAD'))): ?>
        <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
    <?php endif; ?>
     <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</head>
<body class="site">

<?php if(demo_mode_on()): ?>
    <div class="demo-info">
        <?php echo Form::open(['route' => 'misc.change_theme', 'id' => 'change_color_scheme']); ?>

        <div class="form-group">
            <?php echo Form::select('color_scheme', [
            'default' => "Blue Theme",
            'green' => "Green Theme",
            'orange' => "Orange Theme",
            'pink' => "Pink Theme",
            'purple' => "Purple Theme",
            ], sessionOrWebc('color_scheme', 'color_scheme'), ['class' => 'form-control', 'id' => 'color_scheme']); ?>

        </div>
        <?php echo Form::close(); ?>

        <div class="admin-panel">
            <a href="<?php echo route('admin.sessions.create'); ?>" target="_blank" class="btn-main" role="button">ADMIN PANEL</a>
        </div>
    </div>
<?php endif; ?>

<?php echo $__env->make('front.layout.partials.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if(\Request::route()->getName() == 'index'): ?>
<section class="story section--slider-thingy">
        <!-- Form -->

            <!-- End of form -->

        <div class="homeSlider">
          <div class=""><img src="http://cartraderweb.site/luton/uploads/slider/luton-slider-bg.jpg" ></div>
            
        </div>
  <div class="title-Slider">FIND YOUR PERFECT CAR MATCH</div>
         <?php echo Form::open(['route' => 'do_search', 'id' => 'quick-search']); ?>


        <div class="index-quick-search">

            <div class="row upper-options">
                <div class="col-sm-8 no-sides-padding">
                    <?php foreach($details['Conditions'] as $id => $condition): ?>
                        <label class="radio-inline">
                            <input type="radio" name="condition" id="carCond" value="<?php echo $id; ?>"> <?php echo $condition; ?>

                        </label>
                    <?php endforeach; ?>
                    <label class="radio-inline">
                        <input type="radio" name="condition" id="carCond" value="" checked> <?php echo trans('front.all'); ?>

                    </label>
                </div>
                <div class="col-sm-4 hidden-xs"><a href="<?php echo route('advanced-search.index'); ?>"><?php echo trans('front.advanced_search'); ?> <i class="fa fa-chevron-right"></i></a></div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="search-option">
                        <?php echo Form::select('make', [
                '' => trans('front.all_makes')
                ] + $details['Makes'], null, ['class'=>'form-control', 'id' => 'make']);; ?>

                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="search-option">
                        <?php echo Form::select('model', [
                        '' => trans('front.all_models')
                        ], null, ['class'=>'form-control', 'id' => 'model']);; ?>

                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="search-option">
                        <?php echo Form::select('max_price', [
                        '' => trans('front.no_max_price')
                        ] + rangePrice(), null, ['class'=>'form-control']);; ?>

                    </div>
                </div>

                <div class="col-lg-4 col-sm-4 no-sides-padding zip-range">
                    <div class="row">
                        <!--<div class="col-xs-6 range">
                            <?php echo Form::select('distance', [
                            '' => trans('front.all') . ' ' . mileageUnits()
                            ] + rangeDistance(), sessionOrDefault('distance'), ['class'=>'form-control']);; ?>

                        </div>-->
                        <div class="col-xs-6 zip">
                            <span><?php echo trans('front.of'); ?></span>
                            <?php echo Form::text('zip', sessionOrDefault('zip'), ['class'=>'form-control', 'placeholder' => 'Post Code']);; ?>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-2 search-btn">
                    <button class="btn-main" type="submit">
                        <?php echo trans('front.SEARCH'); ?>

                    </button>
                </div>

            </div>

            <div class="adv-search visible-xs"><a href="<?php echo route('advanced-search.index'); ?>"><?php echo trans('front.advanced_search'); ?> <i class="fa fa-chevron-right"></i></a></div>

        </div>

        <?php echo Form::close(); ?>

</section>
<?php endif; ?>
<div class="container" id="site-content">

    <div class="logo-mobile">
        <a href="<?php echo route('index'); ?>"><img src="<?php echo asset( 'uploads/logos/'. (demo_mode_on() ? ('auto_' . sessionOrWebc('color_scheme', 'color_scheme') . '.png') : appCon()->logo) ); ?>"></a>
    </div>

    <!-- SERVER SIDE VALIDATION ALERTS(almost never visible) -->
    <?php echo $__env->make('front.layout.partials.alert-validation-server-side', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- FLASH MESSAGES -->
    <?php echo $__env->make('front.layout.partials.flash-messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- #################  CONTENT GOES HERE  ################# -->
    <?php echo $__env->yieldContent('content'); ?>

</div>

<!-- FOOTER -->
<?php echo $__env->make('front.layout.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        <!-- for modal elements-->
<?php echo $__env->yieldContent('modals'); ?>


        <!-- SCRIPTS -->
<?php echo $__env->make('front.layout.partials.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        <!-- #################  FOR ADDITIONAL SCRIPTS (page specific plugin, inline scripts)  ################# -->
<?php echo $__env->yieldContent('additional-scripts'); ?>
<?php echo $__env->yieldContent('additional-scripts-2'); ?>

        <!-- GOOGLE ANALYTICS CODE -->
<?php echo appCon()->analytics_code; ?>


</body>
</html>