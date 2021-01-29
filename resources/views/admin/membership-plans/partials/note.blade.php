@if (! appCon()->membershipPlansBased())
    <div class="alert alert-danger">
        {{ trans('back.note_membership_plans_irrelevant') }}
    </div>
@endif