@extends('front.layout.master')

@section('meta-title', 'View Seller')

@section('content')

    <h1>{{ $seller->first_name }} {{ $seller->last_name }}</h1>

    <div class="row">

        <div class="col-sm-9">

            <div id="TabContent" class="tab-content">

                <div class="tab-pane fade active in" id="aboutseller">
                    Some info about the seller...
                </div>

                <div class="tab-pane fade" id="sellerlocation">
                    LOCATION INFO
                </div>

            </div>


        </div>

        <div class="col-sm-3">
            <a href="#aboutseller" data-toggle="tab">About</a> <br>
            <a href="" data-toggle="modal" data-target="#modal-contact">Contact</a> <br>
            <a href="#sellerlocation" data-toggle="tab">Location</a> <br>
            <a href="{{ route('browselistings.index', ['userId' => $seller->id]) }}">View Listings</a>

        </div>

    </div>

    <!-- contact user modal -->
    @include('front.browse-users.partials.modal-contact')
@stop


@section('additional-scripts')
    @include('front.browse-users.js.js-view')
@stop