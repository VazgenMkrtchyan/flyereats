<h3><i class="fa fa-picture-o"></i> {{ trans('front.listing_photos') }}</h3>

<!--when photos limit is reached-->
<div class="alert alert-warning" role="alert" id="photos-limit-alert" style="display: none">
    <p><strong>{{ trans('front.note') }}:</strong> {{ trans('front.listing_reached_photos_limit') }}</p>
    @if (appCon()->membershipPlansBased())
        <p>{{ trans('front.to_upload_membership_plan', ['select_link' => route('membershipplans.manage')]) }}</p>
    @elseif ($listing->listing_plan_id)
        <p>{{ trans('front.to_upload_listing_plan') }}</p>
    @endif
</div>

<!--when listing has no plan & website is listing plans based-->
@if (appCon()->listingPlansBased() AND ! $listing->listing_plan_id)
    <div class="alert alert-warning" role="alert">
        <p><strong>{{ trans('front.note') }}:</strong> {{ trans('front.default_photos_limit_alert', ['max_photos' => ($max = $listing->maxPhotosNo()) ? $max : trans('front.UNLIMITED')]) }}
    </div>
@endif

<div class="manage-photos">

    <div class="row">
        <div class="col-xs-12">

            <!-- add files button -->
            <div>
                <button type="button" class="btn btn-success" id="add-files">
                    <i class="fa fa-upload"></i>
                    <span>{{ trans('front.select_photos') }}</span>
                </button>
            </div>

            <!-- photos previews -->
            <div class="row">
                <div id="previews" class="col-xs-12 clearfix"></div>
            </div>

            <!-- photo preview template used by dropzone -->
            <div id="photo-preview-template" class="file-row" style="display: none">
                <div class="dropzone-photo-preview">
                    <div>
                        <span class="preview"><img data-dz-thumbnail class="img-thumbnail"></span>
                    </div>
                    <div>
                        <p class="size" data-dz-size></p>
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width:0;" data-dz-uploadprogress></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- dropzone fallback upload if older browser -->
            <div id="fallback" style="display: none">

                <div class="alert alert-warning" role="alert" id="fallback-alert">
                    <strong>{{ trans('front.note') }}:</strong> {{ trans('front.update_browser_for_multiple_upload') }}
                </div>

                <!-- Form -->
                {{ Form::open(['route' => ['photomanager.upload', $listing->id], 'files' => true]) }}
                        <!-- hidden field for csrf token -->
                {{ Form::hidden('_token', csrf_token()) }}
                        <!-- hidden field for fallback -->
                {{ Form::hidden('fallback', 'true') }}
                        <!-- file field-->
                <div class="form-group">
                    <label for="file">{{ trans('front.select_file') }}</label>
                    <input name="file" type="file">
                </div>
                <button type="submit" class="btn btn-success">{{ trans('front.upload_photo') }}</button>
                {{ Form::close() }}
                        <!-- End of form -->
            </div>

        </div>

    </div>

    <hr>

    <h3><i class="fa fa-upload"></i> {{ trans('front.photos_uploaded') }}: <span id="photosUploaded">{{ $listing->photos()->count() }}</span> ({{ trans('front.max_photos') }}: {{ $listing->maxPhotosNo() }})</h3>
    <!-- listing photos-->
    <div id="listingPhotos" data-max-photos="{{ $listing->maxPhotosNo() }}" class="margin-t-30">

        @include('front.user-listings.partials.listing-photos-ajax')

    </div>

</div>