@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_proceed_to_payment')))

@section('content')

    <h1>{{ trans('front.proceeding') }}... <img src="{{ asset('templates/misc/loadingAJAX.gif') }}"></h1>

    <div>{{ trans('front.redirecting_be_patient') }}</div>

    <hr>

    <form action="@if (appCon()->pp_sandbox) https://www.sandbox.paypal.com/cgi-bin/webscr @else https://www.paypal.com/cgi-bin/webscr @endif" method="post" id="proceed">

        <!-- Identify your business so that you can collect the payments. -->
        <input type="hidden" name="business" value="{{ appCon()->pp_email }}">
        <input type="hidden" name="notify_url" value="{{ route('paypal_ipn') }}">

        <input type="hidden" name="return" value="{{ route('userpayments.payment_status', ['success' => $invoice]) }}">
        <input type="hidden" name="cancel_return" value="{{ route('userpayments.payment_status', ['failure' => $invoice]) }}">

        <!-- Specify a Buy Now button. -->
        <input type="hidden" name="cmd" value="_xclick">

        <!-- Specify details about the plan details -->
        <input type="hidden" name="item_name"
               value="@if ($for == 'listingPlan')
               {{ $orderFor->name }} (Listing Plan #{{ $orderFor->id }})
               @else
                       For Listing Enhancement (#{{ $orderFor->id }})
               @endif">
        <input type="hidden" name="amount" value="{{ $orderFor->price }}">
        <input type="hidden" name="currency_code" value="{{ appCon()->pp_curr_code }}">

        <input type="hidden" name="invoice" value="{{ $invoice }}">

        <div>
            <button type="submit" class="btn btn-info">
                {{ trans('front.PROCEED') }}
            </button>
            {{ trans('front.click_to_redirect') }}
        </div>
    </form>

@stop

@section('additional-scripts')
    @include('front.process-payment.js.js-listing-plan')
@stop