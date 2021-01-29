@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_account_summary')))

@section('content')

    @include('front.partials.alert-no-active-membership-plan')

    <h1><i class="fa fa-info-circle"></i> {{ trans('front.account_summary') }}</h1>

    <div class="row">

        <!--<div class="col-xs-12">

            @if (appCon()->membershipPlansBased())
                <div>
                    <h3>
                        {{ trans('front.membership_info') }}
                    </h3>

                    @if (Auth::user()->hasActiveMembershipPlan())
                        {{ trans('front.account_expiration') }}: {{ $user->expires_on ? format_date($user->expires_on) : trans('front.NEVER') }}
                        <br>
                        {{ trans('front.membership_plan') }}: {{ $user->membershipPlan->name }}
                        <br>
                        {{ trans('front.max_listings') }}: {{ $user->membershipPlan->max_listings ? $user->membershipPlan->max_listings : trans('front.UNLIMITED') }}
                    @else
                        {{ trans('front.no_active_membership_plan') }}
                    @endif
                    <div class="margin-b-13"></div>
                    <a href="{{ route('membershipplans.manage') }}">
                        <button class="btn-main btn-fixed" type="button">
                            <i class="fa fa-cog"></i> {{ trans('front.manage_membership') }}
                        </button>
                    </a>
                </div>-->

                <br>
            @endif


            <div>
                <h3>
                    {{ trans('front.listings_info') }}
                </h3>
                {{ trans('front.total_listings') }}: {{ Auth::user()->listings()->count() }} <a href="{{ route('userlistings.index') }}">({{ trans('front.view') }})</a> <br>
                <span class="text-success">{{ trans('front.active_listings') }}:</span> {{ Auth::user()->listings()->listingsFilter(['listingStatus' => 'active'])->count() }} <a href="{{ route('userlistings.index', ['show' => 'active']) }}">({{ trans('front.view') }})</a> <br>
                <span class="text-danger">{{ trans('front.inactive_listings') }}:</span> {{ Auth::user()->listings()->listingsFilter(['listingStatus' => 'inactive'])->count() }} <a href="{{ route('userlistings.index', ['show' => 'inactive']) }}">({{ trans('front.view') }})</a> <br>
            </div>

            <br>

            <div>
                <h3>
                    {{ trans('front.compprofile') }}
                </h3>
                @if (! Auth::user()->hasCompany())
                    <a href="{{ route('compprofile.create') }}">
                        <button class="btn-main btn-fixed" type="button">
                            <i class="fa fa-info"></i> {{ trans('front.create_compprofile') }}
                        </button>
                    </a>

                @else
                    <a href="https://www.ipswichautos.co.uk/my-listings">
                        <button class="btn-main btn-fixed" type="button">
                            <i class="fa fa-pencil"></i> Manage Your Cars
                        </button>
                    </a>
                    <a href="https://www.ipswichautos.co.uk/add-listing">
                        <button class="btn-main btn-fixed btn-red" type="button">
                            <i class="fa fa-car"></i> Add Your Car
                        </button>
                    </a>
                @endif
            </div>

        </div>

    </div>

@stop


@section('additional-scripts')
    @include('admin.js.destroy')
@stop
