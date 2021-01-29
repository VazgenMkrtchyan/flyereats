

<?php $__env->startSection('meta-title', trans('installation.title_step_1')); ?>

<?php $__env->startSection('content'); ?>

    <h1><i class="fa fa-battery-empty"></i> <?php echo trans('installation.step_1'); ?> <small>(<?php echo trans('installation.enter_server_details'); ?>)</small></h1>

    <div class="bs-callout bs-callout-info">
        <?php echo trans('installation.enter_correct_mysql'); ?>

    </div>


    <!-- MYSQL Details -->
    <?php echo Form::open(['route' => 'install.step1_submit', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


    <!-- text field for 'db_host'-->
    <div class="form-group">
        <?php echo Form::label('db_host', trans('installation.host_name').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::text('db_host', null, ['class' => 'form-control']); ?>

        </div>
    </div>

    <!-- text field for 'db_name'-->
    <div class="form-group">
        <?php echo Form::label('db_name', trans('installation.db_name').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::text('db_name', null, ['class' => 'form-control']); ?>

        </div>
    </div>

    <!-- text field for 'db_username'-->
    <div class="form-group">
        <?php echo Form::label('db_username', trans('installation.db_username').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::text('db_username', null, ['class' => 'form-control']); ?>

        </div>
    </div>

    <!-- db_password -->
    <div class="form-group">
        <?php echo Form::label('db_password', trans('installation.db_password').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

        <div class="col-sm-6 col-md-4">
            <?php echo Form::password('db_password', ['class' => 'form-control']); ?>

        </div>
    </div>


    <div class="form-group margin-t-30">
        <!-- submit for button -->
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
            <button class="btn-main" type="submit">
                <?php echo trans('installation.CONTINUE'); ?>

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
                    db_host: {
                        required: true
                    },
                    db_name: {
                        required: true
                    },
                    db_username: {
                        required: true
                    }
                },

                messages: {
                    db_host: {
                        required: "<?php echo trans('installation.host_name') . trans('front.required_not_empty'); ?>"
                    },
                    db_name: {
                        required: "<?php echo trans('installation.db_name') . trans('front.required_not_empty'); ?>"
                    },
                    db_username: {
                        required: "<?php echo trans('installation.db_username') . trans('front.required_not_empty'); ?>"
                    }
                }
            });

        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('helpers.installation-wizard.layout-wizard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>