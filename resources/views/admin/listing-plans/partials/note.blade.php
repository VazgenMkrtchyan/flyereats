@if (! appCon()->listingPlansBased())
    <div class="alert alert-danger">
        {{ trans('back.note_listing_plans_irrelevant') }}
    </div>
@endif