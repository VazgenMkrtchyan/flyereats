
@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_vehicle_listings')))

@section('content')

    @if (! empty($seller))
        <h2>
            <i class="fa fa-bars"></i> {{ trans('front.listings_of') }} <b>{{ $seller->present()->fullName }}</b>
        </h2>
    @endif

    @if (Input::has('show_history'))
        <h2>
            <i class="fa fa-history"></i> {{ trans('front.seen_listings') }}
        </h2>
    @endif

    @if (Input::has('show_loved'))
        <h2>
            <i class="fa fa-heart"></i> {{ trans('front.loved_listings') }}
        </h2>
    @endif

    <div class="row">

        <div class="col-md-9">

            <div class="results-view-pref clearfix">

                @if (empty($seller))
                    <div class="user-groups">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (Input::has('userGroup'))
                                    {{ $userGroups[Input::get('userGroup')] }}
                                @else
                                    {{ trans('front.all_listings') }} ({{ $counter }})
                                @endif
                                <span class="caret"></span>
                            </button>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('browselistings.index', Input::except(['userGroup', 'page'])) }}">{{ trans('front.all_listings') }} ({{ $counter }})</a></li>
                                @foreach($userGroups as $id => $name)
                                    <li><a href="{{ route('browselistings.index', ['userGroup' => $id] + Input::except(['userGroup', 'page'])) }}">{{ $name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif


                <div class="view-options">
                    <!-- per page -->
                    <div class="dropdown">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            {{ sessionOrWebc('ui_list_no', 'per_page') }} {{ trans('front.results') }}
                            <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="" data-per-page="5">5 {{ trans('front.results') }}</a></li>
                            <li><a href="" data-per-page="10">10 {{ trans('front.results') }}</a></li>
                            <li><a href="" data-per-page="15">15 {{ trans('front.results') }}</a></li>
                            <li><a href="" data-per-page="25">25 {{ trans('front.results') }}</a></li>
                            <li><a href="" data-per-page="50">50 {{ trans('front.results') }}</a></li>
                        </ul>
                    </div>

                    <!--sort by -->
                    <div class="dropdown">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            {{ trans('front.'.sessionOrWebc('ui_list_sort', 'sort_by')) }}
                            <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="" data-sort-by="date_DESC">{{ trans('front.date_DESC') }}</a></li>
                            <li><a href="" data-sort-by="date_ASC">{{ trans('front.date_ASC') }}</a></li>
                            <li><a href="" data-sort-by="year_DESC">{{ trans('front.year_DESC') }}</a></li>
                            <li><a href="" data-sort-by="year_ASC">{{ trans('front.year_ASC') }}</a></li>
                            <li><a href="" data-sort-by="price_DESC">{{ trans('front.price_DESC') }}</a></li>
                            <li><a href="" data-sort-by="price_ASC">{{ trans('front.price_ASC') }}</a></li>
                            <li><a href="" data-sort-by="mileage_ASC">{{ trans('front.mileage_ASC') }}</a></li>
                            <li><a href="" data-sort-by="mileage_DESC">{{ trans('front.mileage_DESC') }}</a></li>
                        </ul>
                    </div>


                    <div id="list-view" class="list-grid @if(sessionOrWebc('ui_view', 'view') == 'list') active @endif"><i class="fa fa-th-list"></i></div>
                    <div id="grid-view" class="list-grid @if(sessionOrWebc('ui_view', 'view') == 'grid') active @endif"><i class="fa fa-th"></i></div>
                </div>

            </div>

            <!-- LISTINGS -->
            <div class="listing-results clearfix">
                @if (count($listings))

                    @foreach ($listings as $listing)

                        @include('front.browse-listings.partials.listing', ['listgrid' => sessionOrWebc('ui_view', 'view')])

                    @endforeach

                @else
                    <div class="no-results-found">
                            No listings found.
                    </div>
                @endif
            </div>

            {{ str_replace('/?', '?', $listings->appends(Session::get('search_url'))->render()) }}

        </div>

        <!-- QUICK SEARCH -->
        <div class="col-md-3">
            @include('front.browse-listings.partials.index-side-widget')
        </div>

    </div>

@stop

@section('additional-scripts')
    @include('front.browse-listings.js.js-index')
@stop