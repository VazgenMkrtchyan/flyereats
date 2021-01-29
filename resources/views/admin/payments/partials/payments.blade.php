<!-- BOX -->
<div class="widget-box widget-color-blue2">
	<div class="widget-header">
		<h5 class="widget-title">
			<i class="ace-icon fa fa-money"></i>
			{{ trans('back.payments') }}
            <span class="per_page">
                {{ Form::select('per_page', rangePerPage(), sessionOrWebc('ai_payments_no', Route::currentRouteName()), ['class'=>'form-control']); }}
            </span>
		</h5>
	</div>

	<div class="widget-body">
		<div class="widget-main">

            {{ str_replace('/?', '?', $payments->appends(Input::all())->render()) }}

			@if($payments->count())

			<table class="table table-striped table-hover">
				<tbody>

				@foreach($payments as $payment)

				<tr>
					<td>

                        <div class="row">

                            <div class="col-sm-9 bigger-110">
                                {{ trans('back.transaction_id') }}: #<strong>{{ $payment->txn_id }}</strong><br>
                                {{ trans('back.user') }}: <strong>{{ $payment->user ? $payment->user->present()->fullName() : trans('back.DELETED_USER') }}</strong>
                            </div>

                            <!-- ACTIONS -->
                            <div class="col-sm-3">
                                <div class="margin-t-10 visible-xs"></div>
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                            <i class="fa fa-cogs"></i> {{ trans('back.payment_actions') }}
                                            <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                        </button>

                                        <ul class="dropdown-menu dropdown-info">
                                            <li>
                                                <a href="{{ route('admin.payments.destroy', $payment->id) }}" data-delete="{{ csrf_token() }}" data-confirm="{{ trans('back.delete_payment_confirm') }}"><i class="fa fa-trash-o"></i> {{ trans('back.delete_payment') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- ./ACTIONS -->

                        </div>

					</td>
				</tr>

				@endforeach

				</tbody>
			</table>

			@else

			<h4 class="red">{{ trans('back.no_payment_records_found') }}</h4>

			@endif

			{{ str_replace('/?', '?', $payments->appends(Input::all())->render()) }}

		</div>
	</div>
</div>