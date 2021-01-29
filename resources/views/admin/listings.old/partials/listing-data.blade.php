<h3 class="header smaller lighter red">
    {{ trans('back.user_and_listing_settings') }}
</h3>

<!-- select box for 'user_id'-->
<div class="form-group">
    {{ Form::label('user_id', trans('back.user').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('user_id', ['' => trans('back.-select-')] + $users, Input::get('userId'), ['class'=>'form-control']); }}
    </div>
</div>


@if (appCon()->listingPlansBased())

    <div class="form-group"><!-- select box for 'listing_plan_id'-->
        {{ Form::label('listing_plan_id', trans('back.listing_plan').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
        <div class="col-xs-10 col-sm-5">
            {{ Form::select('listing_plan_id', ['' => trans('back.-select_user-')], null, ['class'=>'form-control']); }}
        </div>
    </div>

    <div id="expiration-settings" style="display: none;">

        <!-- load listing plan button -->
        <div class="form-group load-settings">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="button" class="btn btn-white btn-pink btn-inverse btn-sm" id="loadListingPlan" disabled="disabled">{{ trans('back.load_listing_plan') }}</button>
                <img src="{{ asset('templates/misc/loadingAJAX.gif') }}" style="width: 25px; display: none" id="listingPlanApiLoading">
                <span id="listingPlanLoaded" style="color: green; display: none">{{ trans('back.listing_plan_loaded') }}</span>
            </div>
        </div>

        <!-- text field for 'expires_on'-->
        <div class="form-group">
            {{ Form::label('expires_on', trans('back.expiration_date').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
            <div class="col-xs-10 col-sm-5">
                <div class="input-group">
                    {{ Form::text('expires_on',
                    (isset($listing) AND $listing->expires_on) ? $listing->expires_on->format('Y-m-d') : null,
                    ['class' => 'form-control date-picker', 'data-date-format' => 'yyyy-mm-dd']) }}

                    <span class="input-group-addon">
			<i class="fa fa-calendar bigger-110"></i>
			</span>
                </div>
                ({{ trans('back.leave_empty_to_never_expire') }})
            </div>
        </div>

    </div>

@endif


<div class="form-group"><!-- select box for 'st_moderation'-->
    {{ Form::label('st_moderation', trans('back.moderation_status').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('st_moderation', [
        'approved' => trans('back.approved'),
        'pending' => trans('back.pending'),
        'rejected' => trans('back.rejected')
        ], null, ['class'=>'form-control']); }}
    </div>
</div>


<!-- select box for 'listing_type'-->
<div class="form-group">
    {{ Form::label('listing_enhancement', trans('back.listing_enhancement').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('listing_enhancement', [
        '' => trans('back.-none-'),
        'highlighted' => trans('back.highlighted'),
        'featured' => trans('back.featured')
        ], isset($listing) ? ($listing->isFeatured() ? 'featured' : 'highlighted') : null, ['class'=>'form-control']); }}
    </div>
</div>


<!-- text field for 'high_or_feat_till'-->
<div class="form-group" id="enhanced_till" style="display: none;">
    {{ Form::label('high_or_feat_till', trans('back.enhanced_till').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        <div class="input-group">
            {{ Form::text('high_or_feat_till',
            (isset($listing) AND $listing->high_or_feat_till) ? $listing->high_or_feat_till->format('Y-m-d') : null,
            ['class' => 'form-control date-picker', 'data-date-format' => 'yyyy-mm-dd']) }}

            <span class="input-group-addon">
			<i class="fa fa-calendar bigger-110"></i>
			</span>
        </div>
        ({{ trans('back.leave_empty_to_never_expire') }})
    </div>
</div>


<h3 class="header smaller lighter purple">
    {{ trans('back.vehicle_details') }}
</h3>


<!-- select box for 'year'-->
<div class="form-group">
    {{ Form::label('year', trans('back.year').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::selectRange('year', date('Y'), date('Y')-50, null, ['class'=>'form-control']); }}
    </div>
</div>

<!-- select box for 'make_id'-->
<div class="form-group">
    {{ Form::label('make_id', trans('back.make').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('make_id', ['' => trans('back.-make-')] + $details['Makes'], null, ['class'=>'form-control']); }}
    </div>
</div>

<!-- select box for 'model_id'-->
<div class="form-group">
    {{ Form::label('model_id', trans('back.model').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('model_id', ['' => trans('back.-select_make-')], null, ['class'=>'form-control']); }}
        <img src="{{ asset('templates/misc/loadingAJAX.gif') }}" style="width: 25px; display: none" id="modelsLoading">
    </div>
</div>

<!-- select box for 'det_condition_id'-->
<div class="form-group">
    {{ Form::label('det_condition_id', trans('back.condition').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('det_condition_id',
['' => trans('back.-condition-')] + $details['Conditions'], null, ['class'=>'form-control']); }}
    </div>
</div>

<!-- select box for 'det_bodystyle_id'-->
<div class="form-group">
    {{ Form::label('det_bodystyle_id', trans('back.body_style').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('det_bodystyle_id', ['' => trans('back.-body_style-')] + $details['BodyStyles'], null, ['class'=>'form-control']); }}
    </div>
</div>

<!-- select box for 'det_extcolor_id'-->
<div class="form-group">
    {{ Form::label('det_extcolor_id', trans('back.ext_color').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('det_extcolor_id', ['' => trans('back.-ext_color-')] + $details['ExtColors'], null, ['class'=>'form-control']); }}
    </div>
</div>

<!-- select box for 'det_intcolor_id'-->
<div class="form-group">
    {{ Form::label('det_intcolor_id', trans('back.int_color').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('det_intcolor_id', ['' => trans('back.-int_color-')] + $details['IntColors'], null, ['class'=>'form-control']); }}
    </div>
</div>

<!-- select box for 'det_transmission_id'-->
<div class="form-group">
    {{ Form::label('det_transmission_id', trans('back.transmission').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('det_transmission_id', ['' => trans('back.-transmission-')] + $details['Transmissions'], null, ['class'=>'form-control']); }}
    </div>
</div>

<!-- select box for 'det_drivetype_id'-->
<div class="form-group">
    {{ Form::label('det_drivetype_id', trans('back.drive_type').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('det_drivetype_id', ['' => trans('back.-drive_type-')] + $details['DriveTypes'], null, ['class'=>'form-control']); }}
    </div>
</div>

<!-- select box for 'det_fueltype_id'-->
<div class="form-group">
    {{ Form::label('det_fueltype_id', trans('back.fuel_type').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('det_fueltype_id', ['' => trans('back.-fuel_type-')] + $details['FuelTypes'], null, ['class'=>'form-control']); }}
    </div>
</div>

<!-- select box for 'doors'-->
<div class="form-group">
    {{ Form::label('doors', trans('back.doors').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::selectRange('doors', 2, 6, null, ['class'=>'form-control']); }}
    </div>
</div>

<!-- select box for 'passengers'-->
<div class="form-group">
    {{ Form::label('passengers', trans('back.passengers').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::selectRange('passengers', 2, 10, null, ['class'=>'form-control']); }}
    </div>
</div>

<!-- select box for 'engine_cyl'-->
<div class="form-group">
    {{ Form::label('engine_cyl', trans('back.engine_cylinders').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::selectRange('engine_cyl', 2, 10, null, ['class'=>'form-control']); }}
    </div>
</div>

<!-- text field for 'Engine_cap'-->
<div class="form-group">
    {{ Form::label('engine_cap', trans('back.engine_capacity').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('engine_cap', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'mileage'-->
<div class="form-group">
    {{ Form::label('mileage', trans('back.mileage').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('mileage', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'price'-->
<div class="form-group">
    {{ Form::label('price', trans('back.price').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('price', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'description'-->
<div class="form-group">
    {{ Form::label('description', trans('back.description').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5]) }}
    </div>
</div>


<!-- FEATURES -->
<h3 class="header smaller lighter blue">
    {{ trans('back.vehicle_features') }}
</h3>

<div class="row">
    @foreach ($details['Features'] as $featureId => $feature)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="checkbox">
                <label>
                    {{ Form::checkbox('feature_'.$featureId, $featureId,
                    isset($listing) ? ($listing->features()->where('features.id', $featureId)->count() ? true:false): false,
                    ['class' => 'ace']) }}
                    <span class="lbl"> {{ $feature }}</span>
                </label>
            </div>
        </div>
    @endforeach
</div>

<div class="clearfix"></div>
<!-- ./FEATURES -->


<h3 class="header smaller lighter brown" style="display:none;">
    {{ trans('back.vehicle_location') }}
</h3>

<!-- load address button -->
<div class="form-group load-settings" style="display:none;">
    <div class="col-sm-offset-3 col-sm-9">
        <button type="button" class="btn btn-white btn-pink btn-inverse btn-sm" id="loadAddress">{{ trans('back.load_user_address') }}</button>
        <img src="{{ asset('templates/misc/loadingAJAX.gif') }}" style="width: 25px; display: none" id="addressApiLoading">
        <span id="addressLoaded" style="color: green; display: none;">{{ trans('back.user_address_loaded') }}</span>
    </div>
</div>

<!-- select box for 'state_id'-->
<div class="form-group" style="display:none;">
    {{ Form::label('state_id', appCon()->locality . ': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::select('state_id', ['' => trans('fromDB.-select_state-')] + $details['States'], null, ['class'=>'form-control']); }}
    </div>
</div>

<!-- text field for 'city'-->
<div class="form-group" style="display:none;">
    {{ Form::label('city', trans('back.city').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('city', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'addr_1'-->
<div class="form-group" style="display:none;">
    {{ Form::label('addr_1', trans('back.address_line').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('addr_1', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- text field for 'Zip'-->
<div class="form-group" style="display:none;">
    {{ Form::label('zip', appCon()->zip_format . ': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
    <div class="col-xs-10 col-sm-5">
        {{ Form::text('zip', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- GMAPS INIT -->
<div class="form-group" style="display:none;">
    <div class="col-sm-offset-3 col-sm-9">
        <button type="button" class="btn btn-white btn-purple btn-inverse btn-sm" id="loadLocation">
            <span class="load-map">
            {{ trans('back.load_google_maps') }}
                <i class="fa fa-map-marker"></i>
            </span>
            <span class="reload-map">
            {{ trans('back.reload_google_maps') }}
                <i class="fa fa-refresh"></i>
            </span>
        </button>
        <span class="map-load-before">{{ trans('back.map_load_before') }}</span>
        <span class="map-load-success">{{ trans('back.map_load_success') }}</span>
        <span class="map-load-error">{{ trans('back.map_load_error') }}</span>
    </div>
</div>

<div id="location" style="height: 400px; display: none"></div>
<!-- ./GMAPS INIT -->


<h3 class="header smaller lighter orange">
    {{ trans('back.archive_listing') }}
</h3>

<!-- check box 'st_archived'-->
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <div class="checkbox">
            <label>
                {{ Form::checkbox('st_archived', '1', null, ['class' => 'ace']); }}
                <span class="lbl"> {{ trans('back.archived') }}</span>
            </label>
        </div>
    </div>
</div>


<div class="clearfix form-actions">
    <div class="col-sm-offset-3 col-sm-9">
        <!-- submit for button -->
        <button class="btn btn-info" type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            {{ trans('back.submit') }}
        </button>

        &nbsp; &nbsp; &nbsp;

        <!-- cancel button -->
        <a href="{{ route('admin.listings.index', Session::get('listing_search_url')) }}">
            <button class="btn btn-danger" type="button">
                <i class="ace-icon fa fa-times bigger-110"></i>
                {{ trans('back.cancel') }}
            </button>
        </a>

    </div>
</div>