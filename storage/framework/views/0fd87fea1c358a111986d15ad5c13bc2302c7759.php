

<?php $__env->startSection('meta-title', siteTitle(trans('front.title_advanced_search'))); ?>

<?php $__env->startSection('content'); ?>

    <h1><i class="fa fa-search"></i> <?php echo trans('front.advanced_search'); ?></h1>

    <!-- Form -->
    <?php echo Form::open(['route' => 'do_search', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


    <div class="advanced-search">

        <div class="form-group">
            <?php echo Form::label('user_group_id', trans('front.user_group').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

            <div class="col-sm-6 col-md-4">
                <?php echo Form::select('user_group_id', ['' => trans('front.all_groups')] + $details['UserGroups'], null, ['class'=>'form-control']);; ?>

            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('make', trans('front.make').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

            <div class="col-sm-6 col-md-4">
                <?php echo Form::select('make', [
                '' => trans('front.all_makes')
                ] + $details['Makes'], Input::get('make'), ['class'=>'form-control', 'id' => 'make']);; ?>

            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('model', trans('front.model').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

            <div class="col-sm-6 col-md-4">
                <?php echo Form::select('model', [
                '' => trans('front.all_models')
                ], null, ['class'=>'form-control', 'id' => 'model']);; ?>

            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('condition', trans('front.condition').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

            <div class="col-sm-6 col-md-4">
                <?php echo Form::select('condition', [
                '' => trans('front.any_condition')
                ] + $details['Conditions'], Input::get('condition'), ['class'=>'form-control']);; ?>

            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('bodystyle', trans('front.body_style').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

            <div class="col-sm-6 col-md-4">
                <?php echo Form::select('bodystyle', [
                '' => trans('front.any_body_style')
                ] + $details['BodyStyles'], Input::get('bodystyle'), ['class'=>'form-control']);; ?>

            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('fueltype', trans('front.fuel_type').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

            <div class="col-sm-6 col-md-4">
                <?php echo Form::select('fueltype', [
                '' => trans('front.any_fuel_type')
                ] + $details['FuelTypes'], Input::get('fueltype'), ['class'=>'form-control']);; ?>

            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('transmission', trans('front.transmission').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

            <div class="col-sm-6 col-md-4">
                <?php echo Form::select('transmission', [
                '' => trans('front.any_transmission')
                ] + $details['Transmissions'], Input::get('transmission'), ['class'=>'form-control']);; ?>

            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('drivetype', trans('front.drive_type').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

            <div class="col-sm-6 col-md-4">
                <?php echo Form::select('drivetype', [
                '' => trans('front.any_drive_type')
                ] + $details['DriveTypes'], Input::get('drivetype'), ['class'=>'form-control']);; ?>

            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('extcolor', trans('front.ext_color').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

            <div class="col-sm-6 col-md-4">
                <?php echo Form::select('extcolor', [
                '' => trans('front.any_color')
                ] + $details['ExtColors'], Input::get('extcolor'), ['class'=>'form-control']);; ?>

            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('intcolor', trans('front.int_color').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

            <div class="col-sm-6 col-md-4">
                <?php echo Form::select('intcolor', [
                '' => trans('front.any_color')
                ] + $details['IntColors'], Input::get('intcolor'), ['class'=>'form-control']);; ?>

            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('min_price', trans('front.price_range').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

            <div class="col-sm-6 col-md-4">
                <?php echo Form::select('min_price', [
                    '' => format_price(0),
                    ] + rangePrice(), Input::get('min_price'), ['class'=>'form-control range']);; ?>

                <span class="range-to"><?php echo trans('front.to'); ?></span>
                <?php echo Form::select('max_price', [
                    '' => trans('front.no_max')
                    ] + rangePrice(), Input::get('max_price'), ['class'=>'form-control range']);; ?>

            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('min_year', trans('front.year_range').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

            <div class="col-sm-6 col-md-4">
                <?php echo Form::select('min_year', [
                    '' => trans('front.any')
                    ] + array_combine(range(date('Y'), 1952), range(date('Y'), 1952)), Input::get('min_year'), ['class'=>'form-control range']);; ?>

                <span class="range-to"><?php echo trans('front.to'); ?></span>
                <?php echo Form::select('max_year', [
                    '' => trans('front.any')
                    ]  + array_combine(range(date('Y'), 1952), range(date('Y'), 1952)), Input::get('max_year'), ['class'=>'form-control range']);; ?>

            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('min_mileage', trans('front.mileage').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

            <div class="col-sm-6 col-md-4">
                <?php echo Form::select('min_mileage', [
                    '' => '0'
                    ] + rangeMileage(), Input::get('min_mileage'), ['class'=>'form-control range']);; ?>

                <span class="range-to"><?php echo trans('front.to'); ?></span>
                <?php echo Form::select('max_mileage', [
            '' => trans('front.no_max'),
            ] + rangeMileage(), Input::get('max_mileage'), ['class'=>'form-control range']);; ?>

            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('distance', trans('front.location').':', ['class'=>'col-sm-3 col-md-2 control-label']); ?>

            <div class="col-sm-6 col-md-4">
                <?php echo Form::select('distance', [
                    '' => trans('front.all_miles'),
                    ] + rangeDistance(), sessionOrDefault('distance'), ['class'=>'form-control range']);; ?>

                <span class="range-to"><?php echo trans('front.of'); ?></span>
                <div>
                    <?php echo Form::text('zip', sessionOrDefault('zip'), ['class'=>'form-control range', 'placeholder' => 'ZIP', 'id' => 'zip']);; ?>

                </div>
            </div>
        </div>

        <div class="form-group margin-t-30">
            <!-- submit for button -->
            <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
                <button class="btn-main" type="submit">
                    <?php echo trans('front.SEARCH'); ?>

                </button>
            </div>
        </div>

    </div>

    <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('front.advanced-search.js.js-index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>