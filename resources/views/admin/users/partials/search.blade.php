<div class="widget-box widget-color-grey">
	<div class="widget-header">
		<h5 class="widget-title">
			<i class="ace-icon fa fa-search"></i>
			{{ trans('back.search_users') }}
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
			{{ Form::open(['route' => 'admin.users.index', 'method' => 'GET']) }}

			<!-- search field -->
			<div class="col-sm-3">
				<div class="form-group">
					{{ Form::label('search', trans('back.search').':', ['class'=>'control-label']) }}
					{{ Form::text('search', Input::get('search'), ['class'=>'form-control', 'placeholder' => trans('back.user_email_or_name')]) }}
				</div>
			</div>

			<!-- select box for 'sortBy'-->
			<div class="col-sm-3">
				<div class="form-group">
					{{ Form::label('sortBy', trans('back.sort_by').':', ['class'=>'control-label']) }}
					{{ Form::select('sortBy', [
					'name_ASC' => trans('back.user_name_ASC'),
					'name_DESC' => trans('back.user_name_DESC'),
					'date_DESC' => trans('back.user_date_DESC'),
					'date_ASC' => trans('back.user_date_ASC')
					], getOrWebc('ai_user_sort', 'sortBy'), ['class'=>'form-control']); }}
				</div>
			</div>

			<!-- select box for 'userStatus'-->
			<div class="col-sm-3">
				<div class="form-group">
					{{ Form::label('userStatus', 'User Status (Overall):', ['class'=>'control-label']) }}
					{{ Form::select('userStatus', [
					'' => trans('back.-any-'),
					'active' => trans('back.active').' ('.$counter['userStatus.active'].')',
					'inactive' => trans('back.inactive').' ('.$counter['userStatus.inactive'].')'
					], Input::get('userStatus'), ['class'=>'form-control']) }}
				</div>
			</div>

			<!-- select box for 'moderationStatus'-->
			<div class="col-sm-3">
				<div class="form-group">
					{{ Form::label('moderationStatus', trans('back.moderation_status').':', ['class'=>'control-label']) }}
					{{ Form::select('moderationStatus', [
                    '' => trans('back.-any-'),
                    'approved' => trans('back.approved').' ('.$counter['moderationStatus.approved'].')',
                    'rejected' => trans('back.rejected').' ('.$counter['moderationStatus.rejected'].')',
                    'pending' => trans('back.pending').' ('.$counter['moderationStatus.pending'].')'
                    ], Input::get('moderationStatus'), ['class'=>'form-control']); }}
				</div>
			</div>

			<!-- select box for 'userGroup'-->
			<div class="col-sm-3">
				<div class="form-group">
					{{ Form::label('userGroup', trans('back.user_group').':', ['class'=>'control-label']) }}
					{{ Form::select('userGroup', ['' => trans('back.-any-')] + $details['UserGroups'], Input::get('userGroup'), ['class'=>'form-control']); }}
				</div>
			</div>


			@if (appCon()->membershipPlansBased())
				<div class="col-sm-3"><!-- select box for 'membershipPlan'-->
					<div class="form-group">
						{{ Form::label('membershipPlan', trans('back.membership_plan').':', ['class'=>'control-label']) }}
						{{ Form::select('membershipPlan', [
                        '' => trans('back.-any-'),
                        'without' => trans('back.without_plan').' ('.$counter['membershipPlan.without'].')'
                        ] + $details['MembershipPlans'], Input::get('membershipPlan'), ['class'=>'form-control']); }}
					</div>
				</div>
			@endif


			<div class="col-sm-3"><!-- select box for 'emailStatus'-->
				<div class="form-group">
					{{ Form::label('emailStatus', trans('back.email_status').':', ['class'=>'control-label']) }}
					{{ Form::select('emailStatus', [
                    '' => trans('back.-any-'),
                    'confirmed' => trans('back.confirmed').' ('.$counter['emailStatus.confirmed'].')',
                    'unconfirmed' => trans('back.unconfirmed').' ('.$counter['emailStatus.unconfirmed'].')'
                    ], Input::get('emailStatus'), ['class'=>'form-control']); }}
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
			<a href="{{ route('admin.users.index') }}">
				<button class="btn btn-sm btn-default" type="button">
					<i class="ace-icon fa fa-undo"></i>
					{{ trans('back.reset') }}
				</button>
			</a>
			@endif
		</div>

		<!-- hidden field for action (used when adding listing) -->
		@if (Input::has('action'))
			{{ Form::hidden('action', Input::get('action')) }}
		@endif

		{{ Form::close() }}
		<!-- End of form -->

	</div>
</div>
