<!-- Form -->
{{ Form::open(['route' => 'compprofilelogo.upload', 'class' => 'form-horizontal', 'files' => true, 'id' => 'company-logo']) }}

<h3><i class="fa fa-picture-o"></i> {{ trans('front.company_logo') }}</h3>

<!-- Files Select Field-->
<div class="form-group">
    <div class="col-sm-offset-3 col-md-offset-2">

        @if ($compprofile->logo)
            <img src="{{ $compprofile->logoUrl() }}">
        @else
            <p><strong>{{ trans('front.no_logo_uploaded') }}</strong></p>
        @endif

        <p>{{ Form::file('logo') }}</p>

        <div class="form-group margin-t-30">
            <!-- submit for button -->
            <div class="col-sm-6 col-md-4">
                <button class="btn-main" type="submit">
                    {{ trans('front.UPLOAD_LOGO') }}
                </button>
            </div>
        </div>

        @if ($compprofile->logo)
            <div class="form-group">
                <div class="col-sm-6 col-md-4">
                    <a href="{{ route('compprofilelogo.delete') }}">
                        <button class="btn-main btn-grey" type="button">
                            {{ trans('front.DELETE_LOGO') }}
                        </button>
                    </a>
                </div>
            </div>
        @endif

    </div>
</div>

{{ Form::close() }}
<!-- End of form -->