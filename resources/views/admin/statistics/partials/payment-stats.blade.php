<div class="widget-container-col margin-t-15" style="display:none;">
	<div class="widget-box widget-color-red3">
		<div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-money"></i> {{ trans('back.payment_statistics') }}</h5>

			<div class="widget-toolbar">
				<a href="#" data-action="collapse">
					<i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
				</a>
			</div>

		</div>

		<div class="widget-body">
			<div class="widget-main" style="display:none;">
				<strong>{{ trans('back.total') }}:</strong> {{ format_price($paymentStats['total']) }}
				@if($paymentStats['total']) <a href="{{ route('admin.payments.index') }}">({{ trans('back.view') }})</a> @endif <br>
				<strong>{{ trans('back.last_24_hours') }}:</strong> {{ format_price($paymentStats['24hours']) }} <br>
				<strong>{{ trans('back.last_7_days') }}:</strong> {{ format_price($paymentStats['7days']) }} <br>
				<strong>{{ trans('back.last_30_days') }}:</strong> {{ format_price($paymentStats['30days']) }} <br>

			</div>

		</div>
	</div>
</div>