<div class="listing-photos">
    <div class="row">
        @for ($i = 0; $i < count($photos); $i++)

            <div class="col-sm-6 col-md-4 col-lg-3 center" data-photo-block="{{ $photos[$i]->id }}">

                <div>
                    <img src="{{ $photos[$i]->present()->thumbUrl() }}" class="img-thumbnail img-responsive" data-photo="{{ $photos[$i]->id }}">
                </div>

                <div class="photo-actions margin-t-10 margin-b-10">
                    @if ($i != 0)
                        <button type="button" class="btn btn-white btn-primary btn-bold" data-move-photo="{{ $photos[$i]->id }}" data-move-target="{{ $photos[$i-1]->id }}" data-move-left>
                            <i class="ace-icon fa fa-arrow-left bigger-120"></i>
                        </button>
                    @endif


                    <button type="button" class="btn btn-white btn-danger btn-bold" data-delete-photo="{{ $photos[$i]->id }}">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                        {{ trans('back.delete') }}
                    </button>


                    @if ($i != count($photos)-1)
                        <button type="button" class="btn btn-white btn-primary btn-bold" data-move-photo="{{ $photos[$i]->id }}" data-move-target="{{ $photos[$i+1]->id }}" data-move-right>
                            <i class="ace-icon fa fa-arrow-right bigger-120"></i>
                        </button>
                    @endif


                    @if ($i >= $listing->maxPhotosNo() AND $listing->maxPhotosNo() != 'UNLIMITED')
                        <p data-not-shown-notify style="color: red">({{ trans('back.not_shown') }})</p>
                    @endif
                </div>

            </div>

        @endfor
    </div>
</div>

@if (! count($listing->photos))
    <div class="alert alert-danger">{{ trans('back.no_photos_uploaded') }}</div>
@endif