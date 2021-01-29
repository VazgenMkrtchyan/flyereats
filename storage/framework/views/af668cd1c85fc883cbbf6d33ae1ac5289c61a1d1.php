

<?php $__env->startSection('meta-title', siteTitle(trans('front.title_contact_us'))); ?>

<?php $__env->startSection('content'); ?>

    <h1><i class="fa fa-envelope-o"></i> <?php echo trans('front.contact_us'); ?></h1>

    <!-- Form -->
    <?php echo Form::open(['route' => 'contactus.send', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


            <!-- text field for 'Name'-->
    <div class="form-group">
        <?php echo Form::label('name', trans('front.name').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

        </div>
    </div>

    <!-- text field for 'Email'-->
    <div class="form-group">
        <?php echo Form::label('email', trans('front.email').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::email('email', null, ['class' => 'form-control']); ?>

        </div>
    </div>

    <!-- text field for 'Subject'-->
    <div class="form-group">
        <?php echo Form::label('subject', trans('front.subject').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::text('subject', null, ['class' => 'form-control']); ?>

        </div>
    </div>

    <!-- text area for 'Message'-->
    <div class="form-group">
        <?php echo Form::label('message', trans('front.message').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::textarea('message', null, ['class' => 'form-control shadow', 'rows' => 5]); ?>

        </div>
    </div>

    <?php if(appCon()->captcha_contact_forms): ?>
        <div class="form-group">
            <div class='col-sm-3 col-md-2 control-label'></div>
            <div class="col-sm-6 col-md-4">
                <?php echo Recaptcha::render(['callback' => 'recaptchaCallback']); ?>

                <input type="hidden" name="hiddenRecaptcha" id="hiddenRecaptcha">
            </div>
        </div>
    <?php endif; ?>

    <div class="form-group margin-t-30">
        <!-- submit for button -->
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
            <button class="btn-main" type="submit">
                <?php echo trans('front.CONTACT_US'); ?>

            </button>
        </div>
    </div>

    <?php echo Form::close(); ?>

            <!-- End of form -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('front.contact-us.js.js-index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>