<div class="widget-box widget-color-grey">
    <div class="widget-header">
        <h5 class="widget-title">
            <i class="ace-icon fa fa-search"></i>
            {{ trans('back.search_payments') }}
        </h5>

        <div class="widget-toolbar">
            <a href="#" data-action="collapse">
                <i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
            </a>
        </div>

    </div>

    <div class="widget-body">
        <div class="widget-main">

            <!-- Form -->
            {{ Form::open(['route' => 'admin.payments.index', 'method' => 'GET']) }}

            <!-- select box for 'status'-->
            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('status', 'Payment Status:', ['class'=>'control-label']) }}
                    {{ Form::select('status', [
                    '' => 'Any Status',
                    'completed' => trans('back.completed').' ('.$counter['status.completed'].')',
                    'notCompleted' => trans('back.other_status').' ('.$counter['status.notCompleted'].')'
                    ], Input::get('status'), ['class'=>'form-control']) }}
                </div>
            </div>

            <!-- select box for 'paymentFor'-->
            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('paymentFor', trans('back.payment_for').':', ['class'=>'control-label']) }}
                    {{ Form::select('paymentFor', [
                    '' => trans('back.all_payments'),
                    'membershipPlan' => trans('back.for_membership_plan').' ('.$counter['for.membershipPlan'].')',
                    'listingPlan' => trans('back.for_listing_plan').' ('.$counter['for.listingPlan'].')',
                    'listingHigh' => trans('back.for_listing_highlighting').' ('.$counter['for.listingHigh'].')',
                    'listingFeat' => trans('back.for_listing_featuring').' ('.$counter['for.listingFeat'].')'
                    ], Input::get('paymentFor'), ['class'=>'form-control']) }}
                </div>
            </div>

            <div class="clearfix"></div>

        </div>

        <div class="widget-toolbox padding-8 clearfix center">
            <button class="btn btn-sm btn-grey">
                <i class="ace-icon fa fa-search"></i>
                {{ trans('back.search') }}
            </button>

            @if (count(Input::except('page')))
                <a href="{{ route('admin.payments.index') }}">
                    <button class="btn btn-sm btn-default" type="button">
                        <i class="ace-icon fa fa-undo"></i>
                        {{ trans('back.reset') }}
                    </button>
                </a>
            @endif
        </div>

        {{ Form::close() }}
        <!-- End of form -->

    </div>
</div>
