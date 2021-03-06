<h3>
    <i class="fa fa-cogs"></i> <?php echo trans('front.main_details'); ?>

</h3>

<!-- select box for 'make_id'-->
<div class="form-group">
    <?php echo Form::label('make_id', trans('front.make').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::select('make_id', ['' => trans('front.-make-')] + $details['Makes'], null, ['class'=>'form-control']);; ?>

    </div>
</div>

<!-- select box for 'model_id'-->
<div class="form-group">
    <?php echo Form::label('model_id', trans('front.model').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::select('model_id', ['' => trans('front.-select_make-')], null, ['class'=>'form-control']);; ?>

    </div>
</div>

<div class="form-group">
    <?php echo Form::label('year', trans('front.year').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::selectRange('year', date('Y'), date('Y')-50, null, ['class'=>'form-control']);; ?>

    </div>
</div>

<!-- select box for 'det_condition_id'-->
<div class="form-group">
    <?php echo Form::label('det_condition_id', trans('front.condition').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::select('det_condition_id', ['' => trans('front.-condition-')] + $details['Conditions'], null, ['class'=>'form-control']);; ?>

    </div>
</div>

<!-- select box for 'det_bodystyle_id'-->
<div class="form-group">
    <?php echo Form::label('det_bodystyle_id', trans('front.body_style').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::select('det_bodystyle_id', ['' => trans('front.-body_style-')] + $details['BodyStyles'], null, ['class'=>'form-control']);; ?>

    </div>
</div>

<!-- select box for 'det_extcolor_id'-->
<div class="form-group">
    <?php echo Form::label('det_extcolor_id', trans('front.ext_color').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::select('det_extcolor_id', ['' => trans('front.-ext_color-')] + $details['ExtColors'], null, ['class'=>'form-control']);; ?>

    </div>
</div>

<!-- select box for 'det_intcolor_id'-->
<div class="form-group">
    <?php echo Form::label('det_intcolor_id', trans('front.int_color').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::select('det_intcolor_id', ['' => trans('front.-int_color-')] + $details['IntColors'], null, ['class'=>'form-control']);; ?>

    </div>
</div>

<!-- select box for 'det_transmission_id'-->
<div class="form-group">
    <?php echo Form::label('det_transmission_id', trans('front.transmission').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::select('det_transmission_id', ['' => trans('front.-transmission-')] + $details['Transmissions'], null, ['class'=>'form-control']);; ?>

    </div>
</div>

<!-- select box for 'det_drivetype_id'-->
<div class="form-group">
    <?php echo Form::label('det_drivetype_id', trans('front.drive_type').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::select('det_drivetype_id', ['' => trans('front.-drive_type-')] + $details['DriveTypes'], null, ['class'=>'form-control']);; ?>

    </div>
</div>

<!-- select box for 'det_fueltype_id'-->
<div class="form-group">
    <?php echo Form::label('det_fueltype_id', trans('front.fuel_type').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::select('det_fueltype_id', ['' => trans('front.-fuel_type-')] + $details['FuelTypes'], null, ['class'=>'form-control']);; ?>

    </div>
</div>

<!-- select box for 'doors'-->
<div class="form-group">
    <?php echo Form::label('doors', trans('front.doors').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::selectRange('doors', 2, 6, null, ['class'=>'form-control']);; ?>

    </div>
</div>

<!-- select box for 'passengers'-->
<div class="form-group">
    <?php echo Form::label('passengers', trans('front.passengers').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::selectRange('passengers', 2, 10, null, ['class'=>'form-control']);; ?>

    </div>
</div>

<!-- select box for 'engine_cyl'-->
<div class="form-group">
    <?php echo Form::label('engine_cyl', trans('front.engine_cylinders').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::selectRange('engine_cyl', 2, 10, null, ['class'=>'form-control']);; ?>

    </div>
</div>

<!-- text field for 'Engine_cap'-->
<div class="form-group">
    <?php echo Form::label('engine_cap', trans('front.engine_capacity').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::text('engine_cap', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'Mileage'-->
<div class="form-group">
    <?php echo Form::label('mileage', trans('front.mileage').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::text('mileage', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'Price'-->
<div class="form-group">
    <?php echo Form::label('price', trans('front.price').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::text('price', null, ['class' => 'form-control']); ?>

    </div>
</div>

<!-- text field for 'Description'-->
<div class="form-group">
    <?php echo Form::label('description', trans('front.description').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5]); ?>

    </div>
</div>

<h3>
    <i class="fa fa-check-square-o"></i> <?php echo trans('front.vehicle_features'); ?>

</h3>

<div class="row">
    <?php foreach($details['Features'] as $featureId => $feature): ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('feature_'.$featureId, $featureId,
                    isset($listing) ? ($listing->features()->where('features.id', $featureId)->count() ? true:false): false,
                    ['class' => 'ace']); ?>

                    <span class="lbl"> <?php echo $feature; ?></span>
                </label>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<br>

<!--<h3>
    <i class="fa fa-map-marker"></i> <?php echo trans('front.vehicle_location'); ?>

</h3>-->

<!-- load address button -->
<!--<div class="form-group">
    <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
        <button type="button" class="btn-main btn-fixed btn-small" id="loadAddress"><?php echo trans('front.load_address'); ?>

            <i class="fa fa-globe"></i>
        </button>
    </div>
</div>-->

<!-- select box for 'state_id'-->
<!--<div class="form-group">
    <?php echo Form::label('state_id', appCon()->locality . ': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::select('state_id', ['' => trans('fromDB.-select_state-')] + $details['States'], null, ['class'=>'form-control']);; ?>

    </div>
</div>-->

<!-- text field for 'city'-->
<!--<div class="form-group">
    <?php echo Form::label('city', trans('front.city').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::text('city', null, ['class' => 'form-control']); ?>

    </div>
</div>-->

<!-- text field for 'addr_1'-->
<!--<div class="form-group">
    <?php echo Form::label('addr_1', trans('front.address_line').': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::text('addr_1', null, ['class' => 'form-control']); ?>

    </div>
</div>-->


<!-- text field for 'Zip'-->
<!--<div class="form-group">
    <?php echo Form::label('zip', appCon()->zip_format . ': *', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

    <div class="col-sm-6 col-md-4">
        <?php echo Form::text('zip', null, ['class' => 'form-control']); ?>

    </div>
</div>-->


<!-- GMAPS INIT -->
<!--<div class="form-group">
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
</div>-->

<!--<div id="location" style="height: 400px; display: none"></div>-->
<!-- ./GMAPS INIT -->


<div class="form-group margin-t-30">
    <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
        <button class="btn-main" type="submit">
            <?php if(isPage(['userlistings.create'])): ?>
                <?php echo trans('front.submit_and_continue'); ?>

                <i class="fa fa-chevron-right"></i>
            <?php else: ?>
                <?php echo trans('front.update_listing'); ?>

            <?php endif; ?>
        </button>
    </div>
</div>