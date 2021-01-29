<!-- THIS PARTIAL IS USED IN AJAX LOAD TOO! -->

<div class="row">
    @for ($i = 0; $i < count($photos); $i++)
        <div class="col-sm-6 col-lg-3" data-photo-block="{{ $photos[$i]->id }}">

            <div class="uploaded-photo">

                <div class="photo">
                    <img src="{{ asset($photos[$i]->present()->thumbUrl()) }}" class="img-responsive img-rounded" data-photo="{{ $photos[$i]->id }}">
                </div>


                <div class="photo-actions">

                    @if ($i != 0)
                        <button type="button" class="btn btn-primary" data-move-photo="{{ $photos[$i]->id }}" data-move-target="{{ $photos[$i-1]->id }}" data-move-left>
                            <i class="fa fa-arrow-left"></i>
                        </button>
                    @endif


                    <button type="button" class="btn btn-primary" data-delete-photo="{{ $photos[$i]->id }}">
                        <i class="fa fa-trash-o"></i>
                        {{ trans('front.delete') }}
                    </button>


                    @if ($i != count($photos)-1)
                        <button type="button" class="btn btn-primary" data-move-photo="{{ $photos[$i]->id }}" data-move-target="{{ $photos[$i+1]->id }}" data-move-right>
                            <i class="fa fa-arrow-right"></i>
                        </button>
                    @endif

                </div>


                @if ($i >= $listing->maxPhotosNo() AND $listing->maxPhotosNo() != 'UNLIMITED')
                    <div class="not-shown" data-not-shown-notify>
                        ({{ trans('front.not_shown') }})
                    </div>
                @endif

            </div>
        </div>
    @endfor
</div>