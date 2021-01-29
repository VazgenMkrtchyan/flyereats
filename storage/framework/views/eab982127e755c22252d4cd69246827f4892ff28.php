<div class="modal fade" id="modal-change-email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">


            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="exampleModalLabel"><?php echo trans('front.change_email'); ?></h3>
            </div>

            <!-- Form -->
            <?php echo Form::open(['route' => 'change_email_request', 'class' => 'form-horizontal', 'id' => 'form-change-email']); ?>


            <div class="modal-body">

                <!-- text field for 'Email'-->
                <div class="form-group">
                    <?php echo Form::label('email', trans('front.new_email').': *', ['class'=>'col-sm-3 control-label']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::email('email', null, ['class' => 'form-control']); ?>

                    </div>
                </div>


            <div class="modal-footer">
                <button class="btn-main btn-fixed" type="submit">
                    <?php echo trans('front.change_email'); ?>

                </button>
                <button type="button" class="btn-main btn-fixed btn-grey" data-dismiss="modal">
                    <?php echo trans('front.close'); ?>

                </button>
            </div>

            <?php echo Form::close(); ?>

            <!-- End of form -->

        </div>
    </div>

</div>