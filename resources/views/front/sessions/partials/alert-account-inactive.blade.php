<div class="alert alert-danger alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert">
        <i class="ace-icon fa fa-times"></i>
    </button>

    <strong><i>{{ trans('front.account_inactive') }}</i></strong><br>
    <strong>{{ trans('front.reasons') }}:</strong>
    <ul>
        @if (! Session::get('inactiveUser')->isApproved())
            <li>
                <strong>{{ trans('front.moderation_status') }}:</strong> {{ trans('front.'.Session::get('inactiveUser')->st_moderation) }}!
            </li>
        @endif
        @if (! Session::get('inactiveUser')->emailConfirmed())
            <li>
                <strong>{{ trans('front.email_status') }}:</strong> {{ trans('front.unconfirmed_email', ['resend_link' => route('resend_confirmation')]) }})
            </li>
        @endif
    </ul>
</div>

