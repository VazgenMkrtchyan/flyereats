@extends('front.layout.master')

@section('meta-title', 'Car Sellers')

@section('content')

<h1>Browse Sellers</h1>

<div class="row">

	<div class="col-sm-9">

		<!-- SORT - PER PAGE -->
        {{ Form::open(['route' => 'do_users_search', 'class' => 'form-horizontal', 'id' => 'search_filters']) }}

        <div class="row">

            <div class="pull-right">
                <div class="col-sm-6">
                    <strong>Sellers Per Page:</strong>
                    {{ Form::select('per_page', [
                    '5' => '5',
                    '10' => '10',
                    '15' => '15',
                    '20' => '20',
                    '25' => '25',
                    '30' => '30',
                    '50' => '50',
                    ], getOrWebc('ui_user_no', 'per_page'), ['class'=>'form-control', 'id' => 'per_page']); }}
                </div>

                <div class="col-sm-6">
                    <strong>Sort by:</strong>
                    {{ Form::select('sortby', [
                    '' => '-SORT BY-',
                    'name_ASC' => 'Alphabetical (A-Z)',
                    'name_DESC' => 'Alphabetical (Z-A)'
                    ], getOrWebc('ui_user_sort', 'sortby'), ['class'=>'form-control']); }}
                </div>
            </div>

        </div>

        {{ Form::close() }}

		<hr>

		<!-- USERS -->
        @if($users->count())

            @foreach($users as $user)

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route('browseusers.view', $user->id) }}">
                                <strong>{{ $user->present()->fullName }}</strong>
                            </a> <br>
                            Listings: {{ $user->listings()->count() }}
                        </div>
                        <div class="col-sm-6">
                            Truputis dar info....
                        </div>
                    </div>
                    <hr>
                </div>

            @endforeach


            <div class="clearfix"></div>
            {{ str_replace('/?', '?', $users->appends(Session::get('users_search_url'))->render()) }}

        @else
            <div>
                No users found.
            </div>

        @endif

	</div>

	<!-- SEARCH BAR -->
	<div class="col-sm-3">
        <strong>Search</strong>
        <hr>
        <!-- Form -->
        {{ Form::open(['route' => 'do_users_search', 'class' => 'form-horizontal']) }}

        <!-- TYPES -->
        {{ Form::select('userGroup', [
        '' => '-ANY SELLER TYPE-',
        '1' => 'Individuals',
        '2' => 'Agents'
        ], Input::get('userGroup'), ['class'=>'form-control']); }}

        <!--LOCATIONS-->
        <div id="locationsAJAX">
            @if (! Input::has('location'))
                <div>
                    {{ Form::select('locations[0]', ['' => '-ANY LOCATION-'] + $details['Locations'], null, ['class'=>'form-control']) }}
                </div>
            @endif
        </div>
        <div id="loadingLocations" style="display: none">Loading Locations <img src="{{ asset('templates/misc/loadingAJAX.gif') }}" width="30px"></div>
        <!-- select template -->
        <div class="hidden" data-location-template>
            {{ Form::select(null, [], null, ['class'=>'form-control']) }}
        </div>

        <!-- search button -->
        <hr>
        <button class="btn btn-info" type="submit">
            Search
        </button>

        <a href="{{ route('browseusers.index') }}">
            <button class="btn btn-default" type="button">
                Reset Search
            </button>
        </a>

        {{ Form::close() }}
        <!-- End of form -->
	</div>

</div>

@stop


@section('additional-scripts')
    @include('front.browse-users.js.js-index')
@stop