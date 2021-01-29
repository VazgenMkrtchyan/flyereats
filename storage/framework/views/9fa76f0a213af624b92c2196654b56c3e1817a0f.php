<h3><i class="fa fa-cogs"></i> <?php echo trans('front.company_details'); ?></h3>

<!-- text field for 'name'-->
<div class="form-group">
    <?php echo Form::label('name', trans('front.company_name').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'Description'-->
<div class="form-group">
    <?php echo Form::label('description', trans('front.description').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5]); ?>

    </div>
</div>

<!-- text field for 'email'-->
<div class="form-group">
    <?php echo Form::label('email', trans('front.email').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::text('email', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'phone'-->
<div class="form-group">
    <?php echo Form::label('phone', trans('front.phone').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::text('phone', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'fax'-->
<div class="form-group">
    <?php echo Form::label('fax', trans('front.fax').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::text('fax', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'web_url'-->
<div class="form-group">
    <?php echo Form::label('web_url', trans('front.web_url').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::text('web_url', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- select box for 'state_id'-->
<div class="form-group">
    <?php echo Form::label('state_id', appCon()->locality . ': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::select('state_id', ['' => trans('fromDB.-select_state-')] + $details['States'], null, ['class'=>'form-control']);; ?>

    </div>
</div>

<!-- text field for 'city'-->
<div class="form-group">
    <?php echo Form::label('city', trans('front.city').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::text('city', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'addr_1'-->
<div class="form-group">
    <?php echo Form::label('addr_1', trans('front.address_line').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::text('addr_1', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'zip'-->
<div class="form-group">
    <?php echo Form::label('zip', appCon()->zip_format . ': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::text('zip', null, ['class' => 'form-control']); ?>

    </div>
</div>


<!-- GMAPS INIT -->
<div class="form-group">
    <div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10">
        <button type="button" class="btn-main btn-fixed btn-small" id="loadLocation">
            <span class="load-map">
            <?php echo trans('front.load_google_maps'); ?>

                <i class="fa fa-map-marker"></i>
            </span>
            <span class="reload-map">
            <?php echo trans('front.reload_google_maps'); ?>

                <i class="fa fa-refresh"></i>
            </span>
        </button>
        <span class="map-load-before"><?php echo trans('front.map_load_before'); ?></span>
        <span class="map-load-success"><?php echo trans('front.map_load_success'); ?></span>
        <span class="map-load-error"><?php echo trans('front.map_load_error'); ?></span>
    </div>
</div>

<div id="location" style="height: 400px; display: none"></div>
<!-- ./GMAPS INIT -->


<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('front.user-company-profile.js.js-create-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>