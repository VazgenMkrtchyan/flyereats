@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_edit_company')))

@section('content')

    @include('front.user-company-profile.partials.not-displayed')

    <h1><i class="fa fa-pencil"></i> {{ trans('front.edit_compprofile') }}</h1>


    @include('front.user-company-profile.partials.upload-delete-logo')

            <!-- Form -->
    {{ Form::model($compprofile, ['route' => 'compprofile.update', 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'form-val']) }}

            <!-- hidden field for old_state_id -->
    {{ Form::hidden('old_state_id', $compprofile->state_id) }}
            <!-- hidden field for old_city -->
    {{ Form::hidden('old_city', $compprofile->city) }}
            <!-- hidden field for old_addr_1 -->
    {{ Form::hidden('old_addr_1', $compprofile->addr_1) }}
            <!-- hidden field for old_zip -->
    {{ Form::hidden('old_zip', $compprofile->zip) }}

            <!-- FIELDS -->
    @include('front.user-company-profile.partials.create-edit')

            <!-- submit button -->
    <div class="form-group margin-t-30">
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
            <button class="btn-main" type="submit">
                {{ trans('front.UPDATE_COMPPROFILE') }}
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