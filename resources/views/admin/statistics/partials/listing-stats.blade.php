<div class="widget-container-col">
	<div class="widget-box widget-color-blue2">
		<div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-list"></i> {{ trans('back.listing_statistics') }}</h5>

			<div class="widget-toolbar">
				<a href="#" data-action="collapse">
					<i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
				</a>
			</div>

		</div>

		<div class="widget-body">
			<div class="widget-main">
				<strong>{{ trans('back.total_listings') }}:</strong> {{ $listingStats['total'] }}
				@if($listingStats['total'])
                    <a href="{{ route('admin.listings.index') }}">({{ trans('back.view') }})</a>
                @endif
                <br><strong>{{ trans('back.simple') }}:</strong> {{ $listingStats['simple'] }}
				@if($listingStats['simple'])
                    <a href="{{ route('admin.listings.index', ['listingType' => 'simple']) }}">({{ trans('back.view') }})</a>
                @endif
                <br><strong>{{ trans('back.highlighted') }}:</strong> {{ $listingStats['highlighted'] }}
				@if($listingStats['highlighted'])
                    <a href="{{ route('admin.listings.index', ['listingType' => 'highlighted']) }}">({{ trans('back.view') }})</a>
                @endif
                <br><strong>{{ trans('back.featured') }}:</strong> {{ $listingStats['featured'] }}
				@if($listingStats['featured']) <a href="{{ route('admin.listings.index', ['listingType' => 'featured']) }}">({{ trans('back.view') }})</a> @endif <br>

				<hr>

				<strong>{{ trans('back.last_24_hours') }}:</strong> {{ $listingStats['24hours'] }} <br>
				<strong>{{ trans('back.last_7_days') }}:</strong> {{ $listingStats['7days'] }} <br>
				<strong>{{ trans('back.last_30_days') }}:</strong> {{ $listingStats['30days'] }} <br>

				<hr>

				<strong>{{ trans('back.active') }}:</strong> {{ $listingStats['active'] }}
				@if($listingStats['active'])
                    <a href="{{ route('admin.listings.index', ['listingStatus' => 'active']) }}">({{ trans('back.view') }})</a>
                @endif
                <br><strong>{{ trans('back.inactive') }}:</strong> {{ $listingStats['inactive'] }}
                @if($listingStats['inactive'])
                    <a href="{{ route('admin.listings.index', ['listingStatus' => 'inactive']) }}">({{ trans('back.view') }})</a>
                @endif
                <br><strong>{{ trans('back.pending') }}:</strong> {{ $listingStats['pending'] }}
				@if($listingStats['pending'])
                    <a href="{{ route('admin.listings.index', ['moderationStatus' => 'pending']) }}">({{ trans('back.view') }})</a>
                @endif
                <br>

			</div>

		</div>
	</div>
</div>