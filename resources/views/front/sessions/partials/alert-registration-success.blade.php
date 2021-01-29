<div class="alert alert-success alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert">
        <i class="ace-icon fa fa-times"></i>
    </button>

    <strong><i>{{ trans('front.registration_success') }}</i></strong>
    @if (! Session::get('registeredUser')->emailConfirmed())
        <br><strong>{{ trans('front.go_confirm_email') }}</strong>
    @endif
    @if (! Session::get('registeredUser')->isApproved())
        <br>{{ trans('front.account_pending_approval') }}
    @endif
</div>

