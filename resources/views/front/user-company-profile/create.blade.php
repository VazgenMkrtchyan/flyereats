@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_create_company')))

@section('content')

    @include('front.user-company-profile.partials.not-displayed')

    <h1><i class="fa fa-plus"></i> {{ trans('front.create_compprofile') }}</h1>

    <!-- Form -->
    {{ Form::open(['route' => 'compprofile.store', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

            <!-- FIELDS -->
    @include('front.user-company-profile.partials.create-edit')

            <!-- submit button -->
    <div class="form-group margin-t-30">
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
            <button class="btn-main" type="submit">
                {{ trans('front.CREATE_COMPPROFILE') }}
            </button>
        </div>
    </div>

    <!-- Cancel Button -->
    <div class="form-group">
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
            <a href="{{ route('account_summary') }}">
                <button class="btn-main btn-grey" type="button">
                    {{ trans('front.CANCEL') }}
                </button>
            </a>
        </div>
    </div>

    {{ Form::close() }}
            <!-- End of form -->

@stop
 