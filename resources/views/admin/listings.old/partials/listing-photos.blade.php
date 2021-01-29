<h3 class="header smaller lighter red">
    {{ trans('back.upload_photos') }}
</h3>

<!-- dropzone -->
<form action="{{ route('admin.listing-photos.upload', $listing->id) }}" class="dropzone" id="dropzone" method="POST">
    <!-- hidden field for csrf token -->
    {{ Form::hidden('_token', csrf_token()) }}
</form>


<!-- dropzone fallback upload if older browser -->
<div id="fallback" style="display: none">

    <div class="alert alert-warning" role="alert" id="fallback-alert">
        <strong>{{ trans('back.note') }}:</strong> {{ trans('back.update_browser_for_multiple_upload') }}
    </div>

    <!-- Form -->
    {{ Form::open(['route' => ['admin.listing-photos.upload', $listing->id], 'files' => true]) }}
            <!-- hidden field for csrf token -->
    {{ Form::hidden('_token', csrf_token()) }}
            <!-- hidden field for fallback -->
    {{ Form::hidden('fallback', 'true') }}
            <!-- file field-->
    <div class="form-group">
        <label for="file">{{ trans('back.select_file') }}</label>
        <input name="file" type="file">
    </div>
    <button type="submit" class="btn btn-success">{{ trans('back.upload_photo') }}</button>
    {{ Form::close() }}

</div>


<h3 class="header smaller lighter green">
    {{ trans('back.manage_photos') }}
</h3>

<!-- listing photos-->
<div id="listingPhotos" data-max-photos="{{ $listing->maxPhotosNo() }}">
    @include('admin.listings.partials.listing-photos-ajax')
</div>