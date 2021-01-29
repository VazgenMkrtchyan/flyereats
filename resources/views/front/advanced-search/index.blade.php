@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_advanced_search')))

@section('content')

    <h1><i class="fa fa-search"></i> {{ trans('front.advanced_search') }}</h1>

    <!-- Form -->
    {{ Form::open(['route' => 'do_search', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

    <div class="advanced-search">

        <div class="form-group" style="display:none;">
            {{ Form::label('user_group_id', trans('front.user_group').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
            <div class="col-sm-6 col-md-4">
                {{ Form::select('user_group_id', ['' => trans('front.all_groups')] + $details['UserGroups'], null, ['class'=>'form-control']); }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('make', trans('front.make').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
            <div class="col-sm-6 col-md-4">
                {{ Form::select('make', [
                '' => trans('front.all_makes')
                ] + $details['Makes'], Input::get('make'), ['class'=>'form-control', 'id' => 'make']); }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('model', trans('front.model').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
            <div class="col-sm-6 col-md-4">
                {{ Form::select('model', [
                '' => trans('front.all_models')
                ], null, ['class'=>'form-control', 'id' => 'model']); }}
            </div>
        </div>

        

        <div class="form-group">
            {{ Form::label('bodystyle', trans('front.body_style').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
            <div class="col-sm-6 col-md-4">
                {{ Form::select('bodystyle', [
                '' => trans('front.any_body_style')
                ] + $details['BodyStyles'], Input::get('bodystyle'), ['class'=>'form-control']); }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('fueltype', trans('front.fuel_type').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
            <div class="col-sm-6 col-md-4">
                {{ Form::select('fueltype', [
                '' => trans('front.any_fuel_type')
                ] + $details['FuelTypes'], Input::get('fueltype'), ['class'=>'form-control']); }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('transmission', trans('front.transmission').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
            <div class="col-sm-6 col-md-4">
                {{ Form::select('transmission', [
                '' => trans('front.any_transmission')
                ] + $details['Transmissions'], Input::get('transmission'), ['class'=>'form-control']); }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('drivetype', trans('front.drive_type').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
            <div class="col-sm-6 col-md-4">
                {{ Form::select('drivetype', [
                '' => trans('front.any_drive_type')
                ] + $details['DriveTypes'], Input::get('drivetype'), ['class'=>'form-control']); }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('extcolor', trans('front.ext_color').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
            <div class="col-sm-6 col-md-4">
                {{ Form::select('extcolor', [
                '' => trans('front.any_color')
                ] + $details['ExtColors'], Input::get('extcolor'), ['class'=>'form-control']); }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('intcolor', trans('front.int_color').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
            <div class="col-sm-6 col-md-4">
                {{ Form::select('intcolor', [
                '' => trans('front.any_color')
                ] + $details['IntColors'], Input::get('intcolor'), ['class'=>'form-control']); }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('min_price', trans('front.price_range').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
            <div class="col-sm-6 col-md-4">
                {{ Form::select('min_price', [
                    '' => format_price(0),
                    ] + rangePrice(), Input::get('min_price'), ['class'=>'form-control range']); }}
                <span class="range-to">{{ trans('front.to') }}</span>
                {{ Form::select('max_price', [
                    '' => trans('front.no_max')
                    ] + rangePrice(), Input::get('max_price'), ['class'=>'form-control range']); }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('min_year', trans('front.year_range').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
            <div class="col-sm-6 col-md-4">
                {{ Form::select('min_year', [
                    '' => trans('front.any')
                    ] + array_combine(range(date('Y'), 1952), range(date('Y'), 1952)), Input::get('min_year'), ['class'=>'form-control range']); }}
                <span class="range-to">{{ trans('front.to') }}</span>
                {{ Form::select('max_year', [
                    '' => trans('front.any')
                    ]  + array_combine(range(date('Y'), 1952), range(date('Y'), 1952)), Input::get('max_year'), ['class'=>'form-control range']); }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('min_mileage', trans('front.mileage').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
            <div class="col-sm-6 col-md-4">
                {{ Form::select('min_mileage', [
                    '' => '0'
                    ] + rangeMileage(), Input::get('min_mileage'), ['class'=>'form-control range']); }}
                <span class="range-to">{{ trans('front.to') }}</span>
                {{ Form::select('max_mileage', [
            '' => trans('front.no_max'),
            ] + rangeMileage(), Input::get('max_mileage'), ['class'=>'form-control range']); }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('distance', trans('front.location').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
            <div class="col-sm-6 col-md-4">
                {{ Form::select('distance', [
                    '' => trans('front.all_miles'),
                    ] + rangeDistance(), sessionOrDefault('distance'), ['class'=>'form-control range']); }}
                <span class="range-to">{{ trans('front.of') }}</span>
                <div>
                    {{ Form::text('zip', sessionOrDefault('zip'), ['class'=>'form-control range', 'placeholder' => 'POSTCODE', 'id' => 'zip']); }}
                </div>
            </div>
        </div>
<div class="form-group">
            {{ Form::label('condition', trans('front.condition').':', ['class'=>'col-sm-3 col-md-2 control-label']) }}
            <div class="col-sm-6 col-md-4">
                {{ Form::select('condition', [
                '' => trans('front.any_condition')
                ] + $details['Conditions'], Input::get('condition'), ['class'=>'form-control']); }}
            </div>
        </div>
        <div class="form-group margin-t-30">
            <!-- submit for button -->
            <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
                <button class="btn-main" type="submit">
                    {{ trans('front.SEARCH') }}
                </button>
            </div>
        </div>

    </div>

    {{ Form::close() }}

@stop


@section('additional-scripts')
    @include('front.advanced-search.js.js-index')
@stop