<?php $__env->startSection('meta-title', siteTitle(trans('front.title_sign_in'))); ?>

<?php $__env->startSection('content'); ?>

    <?php if(Session::has('inactiveUser')): ?>
        <?php echo $__env->make('front.sessions.partials.alert-account-inactive', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <?php if(Session::has('registeredUser')): ?>
        <?php echo $__env->make('front.sessions.partials.alert-registration-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <?php if(demo_mode_on()): ?>
        <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>

            <p class="text-center">
                <strong><?php echo trans('back.demo_credentials'); ?>:</strong><br>
                <?php echo trans('back.username'); ?>: user<br>
                <?php echo trans('back.password'); ?>: user
            </p>
        </div>
    <?php endif; ?>

    <h1><?php echo trans('front.login_to_acc'); ?></h1>

    <!-- Form -->
    <?php echo Form::open(['route' => 'sessions.store', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


            <!-- text field for 'Username'-->
    <div class="form-group">
        <?php echo Form::label('username', trans('front.username').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::text('username', null, ['class' => 'form-control']); ?>

        </div>
    </div>

    <!-- password -->
    <div class="form-group">
        <?php echo Form::label('password', trans('front.password').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::password('password', ['class' => 'form-control']); ?>

        </div>
    </div>

    <?php if(appCon()->captcha_user_login): ?>
        <div class="form-group">
            <div class='col-sm-3 col-md-2 control-label'></div>
            <div class="col-sm-6 col-md-4">
                <?php echo Recaptcha::render(['callback' => 'recaptchaCallback']); ?>

                <input type="hidden" name="hiddenRecaptcha" id="hiddenRecaptcha">
            </div>
        </div>
    <?php endif; ?>


    <div class="form-group">
        <!-- check box 'Remember_me'-->
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-9">
            <a href="<?php echo route('password.getRemind'); ?>"><?php echo trans('front.forgot_password'); ?></a>
        </div>
    </div>


    <!-- submit for button -->
    <div class="form-group margin-t-30">
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
            <button class="btn-main" type="submit">
                <?php echo trans('front.LOGIN'); ?>

            </button>
        </div>
    </div>


    <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('front.sessions.js.js-create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>