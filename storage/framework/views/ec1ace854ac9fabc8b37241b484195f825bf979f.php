<!-- text field for 'route_names'-->
<div class="form-group">
    <?php echo Form::label('route_names', trans('back.route_names').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

    <div class="col-xs-10 col-sm-5">
        <?php echo Form::text('route_names', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'description'-->
<div class="form-group">
    <?php echo Form::label('description', trans('back.description').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

    <div class="col-xs-10 col-sm-5">
        <?php echo Form::text('description', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'order'-->
<div class="form-group">
    <?php echo Form::label('order', trans('back.order').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

    <div class="col-xs-10 col-sm-5">
        <?php echo Form::text('order', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- check box 'system_protected'-->
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <div class="checkbox">
            <label>
                <?php echo Form::checkbox('system_protected', '1', true, ['class' => 'ace']);; ?>

                <span class="lbl"> <?php echo trans('back.delete_protected'); ?></span>
            </label>
        </div>
    </div>
</div>


<div class="clearfix form-actions">
    <div class="col-sm-offset-3 col-sm-9">
        <!-- submit for button -->
        <button class="btn btn-info" type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            <?php echo trans('back.submit'); ?>

        </button>

        &nbsp; &nbsp; &nbsp;

        <!-- cancel button -->
        <a href="<?php echo route('admin.permissions.index', $parent->id); ?>">
            <button class="btn btn-danger" type="button">
                <i class="ace-icon fa fa-times bigger-110"></i>
                <?php echo trans('back.cancel'); ?>

            </button>
        </a>

    </div>
</div>



<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('admin.permissions.js.js-create-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>