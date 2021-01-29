@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_user_payments')))

@section('content')

    <h1><i class="fa fa-money"></i> {{ trans('front.your_payments') }}</h1>

    <div class="row">

        @if($payments->count())
            <div class="col-sm-12">
                <ul>
                    @foreach($payments as $payment)
                        <li>
                            <strong>{{ trans('front.transaction_id') }}:</strong> {{ $payment->txn_id }} | <strong>{{ trans('front.transaction_id') }}:</strong> {{ format_price($payment->amount) }} | <strong>{{ trans('front.date') }}:</strong> {{ format_date($payment->created_at) }}
                        </li>
                    @endforeach
                </ul>
            </div>

        @else
            <div>
                {{  trans('front.no_payments_made') }}
            </div>

        @endif

    </div>

@stop