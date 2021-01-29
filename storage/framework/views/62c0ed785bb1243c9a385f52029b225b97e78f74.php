

<?php $__env->startSection('meta-title', trans('installation.title_step_2')); ?>

<?php $__env->startSection('content'); ?>

    <h1><i class="fa fa-battery-half"></i> <?php echo trans('installation.step_2'); ?> <small>(<?php echo trans('installation.super_user'); ?>)</small></h1>

    <div class="bs-callout bs-callout-info">
        <?php echo trans('installation.enter_super_user_details'); ?>

    </div>


    <!-- Super User Details -->
    <?php echo Form::open(['route' => 'install.step2_submit', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


    <!-- text field for 'First_name'-->
    <div class="form-group">
        <?php echo Form::label('first_name', trans('front.first_name').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::text('first_name', null, ['class' => 'form-control']); ?>

        </div>
    </div>

    <!-- text field for 'Last_name'-->
    <div class="form-group">
        <?php echo Form::label('last_name', trans('front.last_name').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::text('last_name', null, ['class' => 'form-control']); ?>

        </div>
    </div>

    <!-- text field for 'Username'-->
    <div class="form-group">
        <?php echo Form::label('username', trans('front.username').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::text('username', null, ['class' => 'form-control']); ?>

        </div>
    </div>

    <!-- text field for 'Email'-->
    <div class="form-group">
        <?php echo Form::label('email', trans('front.email').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::email('email', null, ['class' => 'form-control']); ?>

        </div>
    </div>

    <!-- password -->
    <div class="form-group">
        <?php echo Form::label('password', trans('front.password').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::password('password', ['class' => 'form-control']); ?>

        </div>
    </div>

    <!-- password confirmation-->
    <div class="form-group">
        <?php echo Form::label('password_confirmation', trans('front.password_confirmation').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::password('password_confirmation', ['class' => 'form-control']); ?>

        </div>
    </div>


    <div class="form-group margin-t-30">
        <!-- submit for button -->
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
            <button class="btn-main" type="submit">
                <?php echo trans('installation.FINISH'); ?>

            </button>
        </div>
    </div>

    <?php echo Form::close(); ?>

    <!-- End of form -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-scripts'); ?>
    <script>
        $( document ).ready( function() {

            //validation
            $( '#form-val' ).validate({
                rules: {
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    username: {
                        required: true,
                        minlength: 4
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        equalTo: "#password"
                    }
                },

                messages: {
                    first_name: {
                        required: "<?php echo trans('front.first_name') . trans('front.required_not_empty'); ?>"
                    },
                    last_name: {
                        required: "<?php echo trans('front.last_name') . trans('front.required_not_empty'); ?>"
                    },
                    username: {
                        required: "<?php echo trans('front.username') . trans('front.required_not_empty'); ?>",
                        minlength: "<?php echo trans('front.username') . trans('front.required_length'); ?>"
                    },
                    email: {
                        required: "<?php echo trans('front.email') . trans('front.required_not_empty'); ?>"
                    },
                    password: {
                        required: "<?php echo trans('front.password') . trans('front.required_not_empty'); ?>",
                        minlength: "<?php echo trans('front.password') . trans('front.required_length'); ?>"
                    },
                    password_confirmation: {
                        equalTo: "<?php echo trans('front.passwords_not_match'); ?>"
                    }
                }
            });

        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('helpers.installation-wizard.layout-wizard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>