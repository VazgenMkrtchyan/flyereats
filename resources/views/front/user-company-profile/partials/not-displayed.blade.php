@if (! Auth::user()->userGroup->displayCompany())
    <div class="alert alert-warning" role="alert">
        <strong>{{ trans('front.note') }}:</strong> {{ trans('front.compprofile_not_shown') }}
    </div>
@endif