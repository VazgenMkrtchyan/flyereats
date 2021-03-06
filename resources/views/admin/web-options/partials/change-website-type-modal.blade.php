<div id="change-type-modal" class="modal fade" tabindex="-1" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="blue no-margin">{{ trans('back.change_website_type') }}</h3>
            </div>

            <div class="modal-body">

                <div class="alert alert-info">
                    @if (appCon()->listingPlansBased())
                        {{ trans('back.from_lp_to_mp') }}
                    @else
                        {{ trans('back.from_mp_to_lp') }}
                    @endif
                </div>

                <div class="alert alert-warning">
                    {{ trans('back.change_website_type_warning') }}
                </div>

                {{ Form::open(['route' => 'admin.settings.changeType', 'class' => 'form-horizontal', 'id' => 'form-change-type']) }}

                @foreach($userGroups as $userGroup)
                    <h4>{{ trans('back.user_group_settings', ['user_group' => $userGroup->name]) }}</h4>

                    @if (appCon()->listingPlansBased())
                        <div class="form-group">
                            {{ Form::label('membership_plan_for_' . $userGroup->id, trans('back.apply_membership_plan').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                            <div class="col-xs-10 col-sm-5">
                                {{ Form::select('membership_plan_for_' . $userGroup->id, ['' => trans('back.-none-')] + $userGroup->membershipPlans()->pluck('name', 'id')->all(), null, ['class'=>'form-control']); }}
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            {{ Form::label('listing_plan_for_' . $userGroup->id, trans('back.apply_listing_plan').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                            <div class="col-xs-10 col-sm-5">
                                {{ Form::select('listing_plan_for_' . $userGroup->id, ['' => trans('back.-none-')] + $userGroup->listingPlans()->pluck('name', 'id')->all(), null, ['class'=>'form-control']); }}
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('notify_user_group_' .$userGroup->id, '1', null, ['class' => 'ace']); }}
                                    <span class="lbl"> {{ trans('back.notify_user_group', ['user_group' => $userGroup->name]) }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{ Form::close() }}

            </div>

            <div class="modal-footer">
                <p>
                    <button class="btn btn-info" data-loading-text='{{ trans('back.updating') }} <i class="ace-icon fa fa-spinner fa-spin bigger-110"></i>' id="change-type-button">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        {{ trans('back.change') }}
                    </button>
                    <button class="btn btn-danger" data-dismiss="modal">
                        <i class="ace-icon fa fa-times bigger-110"></i>
                        {{ trans('back.close') }}
                    </button>
                </p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>