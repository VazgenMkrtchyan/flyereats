<!-- Seller Details -->
@if (isset($seller))
    @include('front.browse-listings.partials.seller-info')

    @if ($seller->displayCompany())
        @include('front.browse-listings.partials.company-info')
        endif
    @endif
@endif


<div class="side-widget">
    <div class="header">
        @if (Input::has('userId'))
            {{ trans('front.search_sellers_listings') }}
        @elseif (Input::has('show_loved'))
            {{ trans('front.search_loved_listings') }}
        @elseif (Input::has('show_history'))
            {{ trans('front.search_seen_listings') }}
        @else
            {{ trans('front.search_listings') }}
        @endif
    </div>
    <div class="content search-options">
        <!-- Form -->
        {{ Form::model(Input::all(), ['route' => 'do_search', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

        

       

        <div class="form-group-s">
            {{ Form::label('make', trans('front.make')) }}
            {{ Form::select('make', [
            '' => trans('front.all_makes')
            ] + $details['Makes'], null, ['class'=>'form-control', 'id' => 'make']); }}
        </div>

        <div class="form-group-s">
            {{ Form::label('model', trans('front.model')) }}
            {{ Form::select('model', [
            '' => trans('front.all_models')
            ], null, ['class'=>'form-control', 'id' => 'model']); }}
        </div>

        <div class="form-group-s">
            {{ Form::label('condition', trans('Body Type')) }}
            {{ Form::select('condition', [
            '' => trans('Any Body Type')
            ] + $details['Conditions'], null, ['class'=>'form-control']); }}
        </div>

        <div class="form-group-s" style="display:none;">
            {{ Form::label('bodystyle', trans('front.body_style')) }}
            {{ Form::select('bodystyle', [
            '' => trans('front.any_body_style')
            ] + $details['BodyStyles'], null, ['class'=>'form-control']); }}
        </div>

        <div class="form-group-s">
            {{ Form::label('fueltype', trans('front.fuel_type')) }}
            {{ Form::select('fueltype', [
            '' => trans('front.any_fuel_type')
            ] + $details['FuelTypes'], null, ['class'=>'form-control']); }}
        </div>

        <div class="form-group-s">
            {{ Form::label('transmission', trans('front.transmission')) }}
            {{ Form::select('transmission', [
            '' => trans('front.any_transmission')
            ] + $details['Transmissions'], null, ['class'=>'form-control']); }}
        </div>

        <!--by default hidden search options-->
        <div id="more-search-options">

            <div class="form-group-s" style="display:none;">
                {{ Form::label('drivetype', trans('front.drive_type')) }}
                {{ Form::select('drivetype', [
            '' => trans('front.any_drive_type')
            ] + $details['DriveTypes'], null, ['class'=>'form-control']); }}
            </div>

            <div class="form-group-s">
                {{ Form::label('extcolor', trans('front.ext_color')) }}
                {{ Form::select('extcolor', [
            '' => trans('front.any_color')
            ] + $details['ExtColors'], null, ['class'=>'form-control']); }}
            </div>

            <div class="form-group-s" style="display:none;">
                {{ Form::label('intcolor', trans('front.int_color')) }}
                {{ Form::select('intcolor', [
            '' => trans('front.any_color')
            ] + $details['IntColors'], null, ['class'=>'form-control']); }}
            </div>


            <div class="range clearfix">
                <div class="range-name">{{ trans('front.price_range') }}</div>
                <div class="range-select">
                    <div class="form-group-s">
                        {{ Form::select('min_price', [
                    '' => format_price(0),
                    ] + rangePrice(), null, ['class'=>'form-control']); }}
                    </div>
                </div>
                <div class="range-to">{{ trans('front.to') }}</div>
                <div class="range-select">
                    <div class="form-group-s">
                        {{ Form::select('max_price', [
                    '' => trans('front.no_max')
                    ] + rangePrice(), null, ['class'=>'form-control']); }}
                    </div>
                </div>
            </div>

            <div class="range clearfix">
                <div class="range-name">{{ trans('front.year_range') }}</div>
                <div class="range-select">
                    <div class="form-group-s">
                        {{ Form::select('min_year', [
                    '' => trans('front.any')
                    ] + array_combine(range(date('Y'), 1952), range(date('Y'), 1952)), null, ['class'=>'form-control']); }}
                    </div>
                </div>
                <div class="range-to">{{ trans('front.to') }}</div>
                <div class="range-select">
                    <div class="form-group-s">
                        {{ Form::select('max_year', [
                    '' => trans('front.any')
                    ]  + array_combine(range(date('Y'), 1952), range(date('Y'), 1952)), null, ['class'=>'form-control']); }}
                    </div>
                </div>
            </div>

            <div class="range clearfix">
                <div class="range-name">{{ trans('front.mileage') }}</div>
                <div class="range-select">
                    <div class="form-group-s">
                        {{ Form::select('min_mileage', [
                    '' => '0'
                    ] + rangeMileage(), null, ['class'=>'form-control']); }}
                    </div>
                </div>
                <div class="range-to">{{ trans('front.to') }}</div>
                <div class="range-select">
                    <div class="form-group-s">
                        {{ Form::select('max_mileage', [
                    '' => trans('front.no_max'),
                    ] + rangeMileage(), null, ['class'=>'form-control']); }}
                    </div>
                </div>
            </div>

             <div class="form-group-s">
            {{ Form::label('description', trans('front.description')) }}
            {{ Form::text('description', null, ['class'=>'form-control', 'id' => 'description']); }}
        </div>

        </div>

        <div class="load-options">
            <span id="load-more-options"><i class="fa fa-plus"></i> {{ trans('front.more_search_options') }}</span>
            <span id="hide-more-options"><i class="fa fa-minus"></i> {{ trans('front.less_search_options') }}</span>
        </div>


        {{ Form::hidden('userId') }}
        {{ Form::hidden('show_loved') }}
        {{ Form::hidden('show_history') }}


        <button class="btn-main margin-b-13" type="submit">
            {{ trans('front.SEARCH') }}
        </button>

        @if (Input::except(['userId', 'show_loved', 'show_history']))
            <a href="{{ route('browselistings.index') }}">
                <button class="btn-main btn-grey" type="button">
                    {{ trans('front.reset_search') }}
                </button>
            </a>
            @endif

            {{ Form::close() }}
                    <!-- End of form -->
    </div>
</div>