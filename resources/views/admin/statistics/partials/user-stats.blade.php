<div class="widget-container-col" style="display:none;">
	<div class="widget-box widget-color-pink">
		<div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-users"></i> {{ trans('back.user_statistics') }}</h5>

			<div class="widget-toolbar">
				<a href="#" data-action="collapse">
					<i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
				</a>
			</div>

		</div>

		<div class="widget-body">
			<div class="widget-main">
				<strong>{{ trans('back.total_users') }}:</strong> {{ $userStats['total'] }}
                <br><strong>{{ trans('back.simple_users') }}:</strong> {{ $userStats['simple'] }}
				@if ($userStats['simple'])
                    <a href="{{ route('admin.users.index') }}">({{ trans('back.view') }})</a>
                @endif
				<br><strong>{{ trans('back.administrators') }}:</strong> {{ $userStats['administrators'] }}
				@if ($userStats['administrators'])
                    <a href="{{ route('admin.administrators.index') }}">({{ trans('back.view') }})</a>
                @endif
                <br><strong>{{ trans('back.super_users') }}:</strong> {{ $userStats['super'] }}<br>

				<hr>

				<strong>{{ trans('back.last_24_hours') }}:</strong> {{ $userStats['24hours'] }} <br>
				<strong>{{ trans('back.last_7_days') }}:</strong> {{ $userStats['7days'] }} <br>
				<strong>{{ trans('back.last_30_days') }}:</strong> {{ $userStats['30days'] }} <br>

				<hr>

				<strong>{{ trans('back.active') }}:</strong> {{ $userStats['active'] }}
				@if ($userStats['active'])
                    <a href="{{ route('admin.users.index', ['userStatus' => 'active']) }}">(View)</a>
                @endif
                <br><strong>{{ trans('back.inactive') }}:</strong> {{ $userStats['inactive'] }}
                @if ($userStats['inactive'])
                    <a href="{{ route('admin.users.index', ['userStatus' => 'inactive']) }}">({{ trans('back.view') }})</a>
                @endif
                <br><strong>{{ trans('back.unconfirmed_email') }}:</strong> {{ $userStats['emailUnconfirmed'] }}
				@if ($userStats['emailUnconfirmed'])
                    <a href="{{ route('admin.users.index', ['emailStatus' => 'unconfirmed']) }}">({{ trans('back.view') }})</a>
                @endif
                <br><strong>{{ trans('back.pending') }}:</strong> {{ $userStats['pending'] }}
				@if ($userStats['pending'])
                    <a href="{{ route('admin.users.index', ['moderationStatus' => 'pending']) }}">({{ trans('back.view') }})</a>
                @endif
                <br>

			</div>

		</div>
	</div>
</div>