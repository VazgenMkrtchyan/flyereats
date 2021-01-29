<!-- BOX -->
<div class="widget-box widget-color-blue2">
    <div class="widget-header">
        <h5 class="widget-title">
            <i class="ace-icon fa fa-user"></i>
            <?php echo trans('back.users'); ?>

            <span class="per_page">
                <?php echo Form::select('per_page', rangePerPage(), sessionOrWebc('ai_user_no', Route::currentRouteName()), ['class'=>'form-control']);; ?>

            </span>
        </h5>
    </div>

    <div class="widget-body">
        <div class="widget-main">

            <?php echo str_replace('/?', '?', $users->appends(Input::all())->render()); ?>


            <?php if($users->count()): ?>

                <table class="table table-striped table-hover">
                    <tbody>

                    <?php foreach($users as $user): ?>

                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-sm-6 bigger-110">
                                        <?php echo trans('back.user'); ?>: <strong><?php echo $user->present()->fullName; ?></strong><br>
                                        <?php echo trans('back.listings'); ?>: <?php echo $user->listings()->count(); ?> (<a href="<?php echo route('admin.listings.index', ['userId' => $user->id]); ?>"><?php echo trans('back.view'); ?></a>)<br>
                                        <?php echo trans('back.user_status'); ?>:
                                        <?php if($user->isActiveUser()): ?>
                                            <span class="label label-success"><?php echo trans('back.active'); ?></span>
                                        <?php else: ?>
                                            <span class="label label-danger"><?php echo trans('back.inactive'); ?></span> | <?php echo trans('back.reasons'); ?>:
                                            <?php if(! $user->emailConfirmed()): ?>
                                                <?php echo trans('back.unconfirmed_email'); ?> |
                                            <?php endif; ?>
                                            <?php if(! $user->isApproved()): ?>
                                                <?php echo trans('back.moderation_status'); ?> (<?php echo trans('back.' . $user->st_moderation); ?>) |
                                            <?php endif; ?>
                                            <?php if(! $user->hasActiveMembershipPlan()): ?>
                                                <?php echo trans('back.no_active_membership_plan'); ?> |
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                                    <!-- ACTIONS -->
                                    <div class="col-sm-6">
                                        <div class="margin-t-10 visible-xs"></div>
                                        <div class="pull-right">

                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                                    <i class="fa fa-cogs"></i> <?php echo trans('back.user_actions'); ?>

                                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                                </button>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a href="<?php echo route('admin.users.edit', $user->id); ?>"><i class="fa fa-pencil"></i> <?php echo trans('back.edit'); ?></a>
                                                    </li>

                                                    <li>
                                                        <a href="<?php echo route('admin.users.delete', $user->id); ?>"><i class="fa fa-trash-o"></i> <?php echo trans('back.delete_user'); ?></a>
                                                    </li>

                                                    <li class="divider"></li>

                                                    <?php if($user->hasCompany()): ?>
                                                        <li>
                                                            <a href="<?php echo route('admin.company-profiles.edit', $user->compprofile->id); ?>"><i class="fa fa-pencil"></i> <?php echo trans('back.edit_company_profile'); ?></a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo route('admin.company-profiles.destroy', $user->compprofile->id); ?>" data-delete="<?php echo csrf_token(); ?>"><i class="fa fa-trash-o"></i> <?php echo trans('back.delete_company_profile'); ?></a>
                                                        </li>
                                                    <?php else: ?>
                                                        <li>
                                                            <a href="<?php echo route('admin.company-profiles.create', ['userId' => $user->id]); ?>"><i class="fa fa-plus"></i> <?php echo trans('back.add_company_profile'); ?></a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <li>
                                                        <a href="<?php echo route('admin.listings.create', ['userId' => $user->id]); ?>"><i class="fa fa-plus"></i> <?php echo trans('back.add_listing'); ?></a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- ./ACTIONS -->

                                </div>

                            </td>
                        </tr>

                    <?php endforeach; ?>

                    </tbody>
                </table>

            <?php else: ?>

                <h4 class="red"><?php echo trans('back.no_users_found'); ?></h4>

            <?php endif; ?>

            <?php echo str_replace('/?', '?', $users->appends(Input::all())->render()); ?>


        </div>
    </div>
</div>