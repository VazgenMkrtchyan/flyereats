<h3 class="header smaller lighter purple">
    <?php echo trans('back.user_info'); ?>

</h3>

<!-- select box for 'user_id'-->
<div class="form-group">
    <?php echo Form::label('user_id', trans('back.company_profile_belongs_to').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

    <div class="col-xs-10 col-sm-5">
        <?php echo Form::select('user_id', ['' => trans('back.-select-')] + $users, Input::get('userId'), ['class'=>'form-control']);; ?>

    </div>
</div>

<h3 class="header smaller lighter green">
    <?php echo trans('back.company_info'); ?>

</h3>

<!-- text field for 'Name'-->
<div class="form-group">
    <?php echo Form::label('name', trans('back.company_name').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

    <div class="col-xs-10 col-sm-5">
        <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'description'-->
<div class="form-group">
    <?php echo Form::label('description', trans('back.description').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

    <div class="col-xs-10 col-sm-5">
        <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5]); ?>

    </div>
</div>

<!-- text field for 'email'-->
<div class="form-group">
    <?php echo Form::label('email', trans('back.email').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

    <div class="col-xs-10 col-sm-5">
        <?php echo Form::text('email', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'phone'-->
<div class="form-group">
    <?php echo Form::label('phone', trans('back.phone').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

    <div class="col-xs-10 col-sm-5">
        <?php echo Form::text('phone', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'fax'-->
<div class="form-group">
    <?php echo Form::label('fax', trans('back.fax').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

    <div class="col-xs-10 col-sm-5">
        <?php echo Form::text('fax', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'web_url'-->
<div class="form-group">
    <?php echo Form::label('web_url', trans('back.web_url').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

    <div class="col-xs-10 col-sm-5">
        <?php echo Form::text('web_url', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- select box for 'state_id'-->
<div class="form-group">
    <?php echo Form::label('state_id', appCon()->locality . ': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

    <div class="col-xs-10 col-sm-5">
        <?php echo Form::select('state_id', ['' => trans('back.-select-')] + $details['States'], null, ['class'=>'form-control']);; ?>

    </div>
</div>

<!-- text field for 'city'-->
<div class="form-group">
    <?php echo Form::label('city', trans('back.city').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

    <div class="col-xs-10 col-sm-5">
        <?php echo Form::text('city', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'addr_1'-->
<div class="form-group">
    <?php echo Form::label('addr_1', trans('back.address_line').': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

    <div class="col-xs-10 col-sm-5">
        <?php echo Form::text('addr_1', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'zip'-->
<div class="form-group">
    <?php echo Form::label('zip', appCon()->zip_format . ': *', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

    <div class="col-xs-10 col-sm-5">
        <?php echo Form::text('zip', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- GMAPS INIT -->
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <button type="button" class="btn btn-white btn-purple btn-inverse btn-sm" id="loadLocation">
            <span class="load-map">
            <?php echo trans('back.load_google_maps'); ?>

                <i class="fa fa-map-marker"></i>
            </span>
            <span class="reload-map">
            <?php echo trans('back.reload_google_maps'); ?>

                <i class="fa fa-refresh"></i>
            </span>
        </button>
        <span class="map-load-before"><?php echo trans('back.map_load_before'); ?></span>
        <span class="map-load-success"><?php echo trans('back.map_load_success'); ?></span>
        <span class="map-load-error"><?php echo trans('back.map_load_error'); ?></span>
    </div>
</div>

<div id="location" style="height: 400px; display: none"></div>
<!-- ./GMAPS INIT -->


<div class="clearfix form-actions">
    <div class="col-sm-offset-3 col-sm-9">
        <!-- submit for button -->
        <button class="btn btn-info" type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            <?php echo trans('back.submit'); ?>

        </button>

        &nbsp; &nbsp; &nbsp;

        <!-- cancel button -->
        <a href="<?php echo route('admin.company-profiles.index'); ?>">
            <button class="btn btn-danger" type="button">
                <i class="ace-icon fa fa-times bigger-110"></i>
                <?php echo trans('back.cancel'); ?>

            </button>
        </a>

    </div>
</div>


<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('admin.company-profiles.js.js-create-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>