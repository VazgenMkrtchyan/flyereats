<div class="widget-box widget-color-grey">
	<div class="widget-header">
		<h5 class="widget-title">
			<i class="ace-icon fa fa-search"></i>
			{{ trans('back.search_listings') }}
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
			{{ Form::model(Input::all(), ['route' => 'admin.listings.index', 'method' => 'GET']) }}

			@if (Input::has('user'))
					<!-- hidden field for user -->
			{{ Form::hidden('user', Input::get('user')) }}
			@endif

					<!-- select box for 'Sortby'-->
			<div class="col-sm-3">
				<div class="form-group">
					{{ Form::label('sortby', trans('back.sort_by').':', ['class'=>'control-label']) }}
					{{ Form::select('sortby', [
					'year_DESC' => trans('back.year_DESC'),
					'year_ASC' => trans('back.year_ASC'),
					'date_DESC' => trans('back.date_DESC'),
					'date_ASC' => trans('back.date_ASC'),
					'views_DESC' => trans('back.views_DESC'),
					'views_ASC' => trans('back.views_ASC'),
					'price_DESC' => trans('back.price_DESC'),
					'price_ASC' => trans('back.price_ASC'),
					'mileage_ASC' => trans('back.mileage_ASC'),
					'mileage_DESC' => trans('back.mileage_DESC')
					], getOrWebc('ai_list_sort', 'sortby'), ['class'=>'form-control']); }}
				</div>
			</div>

			<!-- select box for 'userGroup'-->
			<div class="col-sm-3">
				<div class="form-group">
					{{ Form::label('userGroup', trans('back.user_group').':', ['class'=>'control-label']) }}
					{{ Form::select('userGroup', ['' => trans('back.any_group')] + $details['UserGroups'], null, ['class'=>'form-control']) }}
				</div>
			</div>

			<!-- select box for 'make'-->
			<div class="col-sm-3">
				<div class="form-group">
					{{ Form::label('make', trans('back.make').':', ['class'=>'control-label']) }}
					{{ Form::select('make', ['' => trans('back.any_make')] + $details['Makes'], null, ['class'=>'form-control']) }}
				</div>
			</div>

			<!-- select box for 'listingStatus'-->
			<div class="col-sm-3">
				<div class="form-group">
					{{ Form::label('listingStatus', trans('back.listing_status').':', ['class'=>'control-label']) }}
					{{ Form::select('listingStatus', [
					'' => trans('back.any_status'),
					'active' => trans('back.active').' ('.$counter['listingStatus.active'].')',
					'inactive' => trans('back.inactive').' ('.$counter['listingStatus.inactive'].')',
					], null, ['class'=>'form-control']) }}
				</div>
			</div>

			<!-- select box for 'listingType'-->
			<div class="col-sm-3">
				<div class="form-group">
					{{ Form::label('listingType', trans('back.listing_type').':', ['class'=>'control-label']) }}
					{{ Form::select('listingType', [
					'' => trans('back.any_type'),
					'simple' => trans('back.simple').' ('.$counter['listingType.simple'].')',
					'highlighted' => trans('back.highlighted').' ('.$counter['listingType.highlighted'].')',
					'featured' => trans('back.featured').' ('.$counter['listingType.featured'].')'
					], null, ['class'=>'form-control']) }}
				</div>
			</div>

			<!-- select box for 'moderationStatus'-->
			<div class="col-sm-3">
				<div class="form-group">
					{{ Form::label('moderationStatus', trans('back.moderation_status').':', ['class'=>'control-label']) }}
					{{ Form::select('moderationStatus', [
                    '' => trans('back.any_status'),
                    'approved' => trans('back.approved').' ('.$counter['moderationStatus.approved'].')',
                    'pending' => trans('back.pending').' ('.$counter['moderationStatus.pending'].')',
                    'rejected' => trans('back.rejected').' ('.$counter['moderationStatus.rejected'].')',
                    ], null, ['class'=>'form-control']); }}
				</div>
			</div>


			@if (appCon()->listingPlansBased())
				<div class="col-sm-3"><!-- select box for 'listing plan'-->
					<div class="form-group">
						{{ Form::label('listingPlan', trans('back.listing_plan').':', ['class'=>'control-label']) }}
						{{ Form::select('listingPlan', [
                        '' => trans('back.any_listing_plan'),
                        'without' => trans('back.without_listing_plan').' ('.$counter['listing_plans.without'].')'
                        ] + $details['ListingPlans'], null, ['class'=>'form-control']) }}
					</div>
				</div>
			@endif


			<div class="col-sm-3"><!-- select box for 'description'-->
				<div class="form-group">
					{{ Form::label('description', trans('back.description').':', ['class'=>'control-label']) }}
					{{ Form::text('description', null, ['class'=>'form-control']) }}
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
				<a href="{{ route('admin.listings.index') }}">
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
