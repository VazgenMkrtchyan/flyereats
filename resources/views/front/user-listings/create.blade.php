@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_add_listing')))

@section('content')
    <h1><i class="fa fa-plus"></i> {{  trans('front.add_listing') }}</h1>

    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#listing-data" aria-controls="listing-data" role="tab" data-toggle="tab"><i class="fa fa-cogs"></i> {{ trans('front.listing_details') }}</a></li>
        <li role="presentation"><a href="#listing-photos" aria-controls="listing-photos" role="tab" style="cursor: not-allowed;" onclick="return false;"><i class="fa fa-picture-o"></i> {{ trans('front.listing_photos') }}</a></li>
        @if (appCon()->listingPlansBased())
            <li role="presentation"><a href="#listing-plan" aria-controls="messages" role="tab" style="cursor: not-allowed;" onclick="return false;"><i class="fa fa-cog"></i> {{ trans('front.listing_plan') }}</a></li>
        @endif
        <!--<li role="presentation"><a href="#listing-enhancement" aria-controls="messages" role="tab" style="cursor: not-allowed;" onclick="return false;"><i class="fa fa-star"></i> {{ trans('front.listing_enhancement') }}</a></li>-->
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="listing-data">

            {{ Form::open(['route' => ['userlistings.store'], 'class' => 'form-horizontal', 'id' => 'form-val']) }}

            @include('front.user-listings.partials.listing-data')

            {{ Form::close() }}

        </div>
        <div role="tabpanel" class="tab-pane" id="listing-photos"></div>
        <div role="tabpanel" class="tab-pane" id="listing-plan"></div>
        <div role="tabpanel" class="tab-pane" id="listing-enhancement"></div>
    </div>
@stop


@section('additional-scripts')
    @include('front.user-listings.js.js-listing-data')
@stop
