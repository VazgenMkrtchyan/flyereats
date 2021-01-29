@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_resend_confirmation')))

@section('content')

    <h1>{{ trans('front.resend_confirmation') }}</h1>

    <!-- Form -->
    {{ Form::open(['route' => 'resend_confirmation.post', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

    <!-- text field for 'email'-->
    <div class="form-group">
        {{ Form::label('email', trans('front.email').': *', ['class'=>'col-sm-3 col-md-2 control-label']) }}
        <div class="col-sm-6 col-md-4">
            {{ Form::email('email', null, ['class' => 'form-control']) }}
        </div>
    </div>


    <!-- submit button -->
    <div class="form-group margin-t-30">
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-4">
            <button class="btn-main" type="submit">
                {{ trans('front.RESEND') }}
            </button>
        </div>
    </div>


    {{ Form::close() }}
    <!-- End of form -->

@stop

@section('additional-scripts')
    @include('front.register.js.js-resend-confirmation')
@stop

