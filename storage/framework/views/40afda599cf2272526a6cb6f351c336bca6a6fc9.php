<!-- Seller Details -->
<?php if(isset($seller)): ?>
    <?php echo $__env->make('front.browse-listings.partials.seller-info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php if($seller->displayCompany()): ?>
        <?php echo $__env->make('front.browse-listings.partials.company-info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        endif
    <?php endif; ?>
<?php endif; ?>


<div class="side-widget">
    <div class="header">
        <?php if(Input::has('userId')): ?>
            <?php echo trans('front.search_sellers_listings'); ?>

        <?php elseif(Input::has('show_loved')): ?>
            <?php echo trans('front.search_loved_listings'); ?>

        <?php elseif(Input::has('show_history')): ?>
            <?php echo trans('front.search_seen_listings'); ?>

        <?php else: ?>
            <?php echo trans('front.search_listings'); ?>

        <?php endif; ?>
    </div>
    <div class="content search-options">
        <!-- Form -->
        <?php echo Form::model(Input::all(), ['route' => 'do_search', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


        <div class="zip-distance">
            <div class="zip">
                <div class="form-group-s">
                    <?php echo Form::label('zip', appCon()->zip_format); ?>

                    <?php echo Form::text('zip', sessionOrDefault('zip'), ['class'=>'form-control']);; ?>

                </div>
            </div>
            <div class="distance">
                <div class="form-group-s">
                    <?php echo Form::label('distance', trans('front.distance_within')); ?>

                    <?php echo Form::select('distance', [
                    '' => trans('front.all_miles'),
                    ] + rangeDistance(), sessionOrDefault('distance'), ['class'=>'form-control']);; ?>

                </div>
            </div>
            <div class="zip-error"></div>

            <?php if(sessionOrDefault('zip')): ?>
                <div class="reset-zip-distance">
                    <?php echo trans('front.reset_zip_distance'); ?>

                </div>
            <?php endif; ?>
        </div>

        <div class="form-group-s">
            <?php echo Form::label('description', trans('front.description')); ?>

            <?php echo Form::text('description', null, ['class'=>'form-control', 'id' => 'description']);; ?>

        </div>

        <div class="form-group-s">
            <?php echo Form::label('make', trans('front.make')); ?>

            <?php echo Form::select('make', [
            '' => trans('front.all_makes')
            ] + $details['Makes'], null, ['class'=>'form-control', 'id' => 'make']);; ?>

        </div>

        <div class="form-group-s">
            <?php echo Form::label('model', trans('front.model')); ?>

            <?php echo Form::select('model', [
            '' => trans('front.all_models')
            ], null, ['class'=>'form-control', 'id' => 'model']);; ?>

        </div>

        <div class="form-group-s">
            <?php echo Form::label('condition', trans('front.condition')); ?>

            <?php echo Form::select('condition', [
            '' => trans('front.any_condition')
            ] + $details['Conditions'], null, ['class'=>'form-control']);; ?>

        </div>

        <div class="form-group-s">
            <?php echo Form::label('bodystyle', trans('front.body_style')); ?>

            <?php echo Form::select('bodystyle', [
            '' => trans('front.any_body_style')
            ] + $details['BodyStyles'], null, ['class'=>'form-control']);; ?>

        </div>

        <div class="form-group-s">
            <?php echo Form::label('fueltype', trans('front.fuel_type')); ?>

            <?php echo Form::select('fueltype', [
            '' => trans('front.any_fuel_type')
            ] + $details['FuelTypes'], null, ['class'=>'form-control']);; ?>

        </div>

        <div class="form-group-s">
            <?php echo Form::label('transmission', trans('front.transmission')); ?>

            <?php echo Form::select('transmission', [
            '' => trans('front.any_transmission')
            ] + $details['Transmissions'], null, ['class'=>'form-control']);; ?>

        </div>

        <!--by default hidden search options-->
        <div id="more-search-options">

            <div class="form-group-s">
                <?php echo Form::label('drivetype', trans('front.drive_type')); ?>

                <?php echo Form::select('drivetype', [
            '' => trans('front.any_drive_type')
            ] + $details['DriveTypes'], null, ['class'=>'form-control']);; ?>

            </div>

            <div class="form-group-s">
                <?php echo Form::label('extcolor', trans('front.ext_color')); ?>

                <?php echo Form::select('extcolor', [
            '' => trans('front.any_color')
            ] + $details['ExtColors'], null, ['class'=>'form-control']);; ?>

            </div>

            <div class="form-group-s">
                <?php echo Form::label('intcolor', trans('front.int_color')); ?>

                <?php echo Form::select('intcolor', [
            '' => trans('front.any_color')
            ] + $details['IntColors'], null, ['class'=>'form-control']);; ?>

            </div>


            <div class="range clearfix">
                <div class="range-name"><?php echo trans('front.price_range'); ?></div>
                <div class="range-select">
                    <div class="form-group-s">
                        <?php echo Form::select('min_price', [
                    '' => format_price(0),
                    ] + rangePrice(), null, ['class'=>'form-control']);; ?>

                    </div>
                </div>
                <div class="range-to"><?php echo trans('front.to'); ?></div>
                <div class="range-select">
                    <div class="form-group-s">
                        <?php echo Form::select('max_price', [
                    '' => trans('front.no_max')
                    ] + rangePrice(), null, ['class'=>'form-control']);; ?>

                    </div>
                </div>
            </div>

            <div class="range clearfix">
                <div class="range-name"><?php echo trans('front.year_range'); ?></div>
                <div class="range-select">
                    <div class="form-group-s">
                        <?php echo Form::select('min_year', [
                    '' => trans('front.any')
                    ] + array_combine(range(date('Y'), 1952), range(date('Y'), 1952)), null, ['class'=>'form-control']);; ?>

                    </div>
                </div>
                <div class="range-to"><?php echo trans('front.to'); ?></div>
                <div class="range-select">
                    <div class="form-group-s">
                        <?php echo Form::select('max_year', [
                    '' => trans('front.any')
                    ]  + array_combine(range(date('Y'), 1952), range(date('Y'), 1952)), null, ['class'=>'form-control']);; ?>

                    </div>
                </div>
            </div>

            <div class="range clearfix">
                <div class="range-name"><?php echo trans('front.mileage'); ?></div>
                <div class="range-select">
                    <div class="form-group-s">
                        <?php echo Form::select('min_mileage', [
                    '' => '0'
                    ] + rangeMileage(), null, ['class'=>'form-control']);; ?>

                    </div>
                </div>
                <div class="range-to"><?php echo trans('front.to'); ?></div>
                <div class="range-select">
                    <div class="form-group-s">
                        <?php echo Form::select('max_mileage', [
                    '' => trans('front.no_max'),
                    ] + rangeMileage(), null, ['class'=>'form-control']);; ?>

                    </div>
                </div>
            </div>

        </div>

        <div class="load-options">
            <span id="load-more-options"><i class="fa fa-plus"></i> <?php echo trans('front.more_search_options'); ?></span>
            <span id="hide-more-options"><i class="fa fa-minus"></i> <?php echo trans('front.less_search_options'); ?></span>
        </div>


        <?php echo Form::hidden('userId'); ?>

        <?php echo Form::hidden('show_loved'); ?>

        <?php echo Form::hidden('show_history'); ?>



        <button class="btn-main margin-b-13" type="submit">
            <?php echo trans('front.SEARCH'); ?>

        </button>

        <?php if(Input::except(['userId', 'show_loved', 'show_history'])): ?>
            <a href="<?php echo route('browselistings.index'); ?>">
                <button class="btn-main btn-grey" type="button">
                    <?php echo trans('front.reset_search'); ?>

                </button>
            </a>
            <?php endif; ?>

            <?php echo Form::close(); ?>

                    <!-- End of form -->
    </div>
</div>