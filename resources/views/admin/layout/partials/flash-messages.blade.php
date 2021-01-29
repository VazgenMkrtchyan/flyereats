@if (Session::has('flash_notification.message'))
    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="ace-icon fa fa-times"></i></button>

        {{ Session::get('flash_notification.message') }}
    </div>
@endif