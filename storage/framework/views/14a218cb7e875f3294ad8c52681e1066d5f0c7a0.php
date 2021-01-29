<?php if($userGroup->membershipPlans()->count()): ?>

    <!-- Form (for updating order)-->
    <?php echo Form::open(['route' => 'admin.membership-plans.updateorder', 'method' => 'PATCH']); ?>


    <table class="table table-striped table-hover">

        <thead class="hidden-xs">
        <tr>
            <th>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-6 bigger-110">
                        #<?php echo trans('back.ORDER'); ?>

                    </div>
                </div>
            </th>
        </tr>
        </thead>

        <tbody>
        <?php foreach($userGroup->membershipPlans()->ordered()->get() as $membershipPlan): ?>

            <tr>
                <td>

                    <div class="row">

                        <div class="col-sm-6 bigger-110">
                            <?php echo trans('back.name'); ?>: <strong><?php echo $membershipPlan->name; ?></strong> <br>
                            <?php echo trans('back.users'); ?>: <?php echo $membershipPlan->users()->count(); ?>

                            <a href="<?php echo route('admin.users.index', ['membershipPlan' => $membershipPlan->id]); ?>">(<?php echo trans('back.view'); ?>)</a>
                        </div>

                        <!-- ORDER -->
                        <div class="col-sm-3">
                            <div class="margin-t-5 visible-xs"></div>
                            <span class="visible-xs"><?php echo trans('back.ORDER'); ?>: </span><?php echo Form::text('order_'.$membershipPlan->id, $membershipPlan->order, ['class' => 'input-mini']); ?>

                        </div>
                        <!-- ./ORDER -->

                        <!-- ACTIONS -->
                        <div class="col-sm-3">
                            <div class="margin-t-10 visible-xs"></div>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                        <i class="fa fa-cogs"></i> <?php echo trans('back.membership_plan_actions'); ?>

                                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-info">
                                        <li>
                                            <a href="<?php echo route('admin.membership-plans.edit', $membershipPlan->id);; ?>"><i class="fa fa-pencil"></i> <?php echo trans('back.edit'); ?></a>
                                        </li>

                                        <li class="divider"></li>

                                        <li>
                                            <a href="<?php echo route('admin.membership-plans.destroy', $membershipPlan->id);; ?>" data-delete="<?php echo csrf_token(); ?>" data-confirm="<?php echo trans('back.delete_membership_plan_confirm'); ?>"><i class="fa fa-trash-o"></i> <?php echo trans('back.delete_membership_plan'); ?></a>
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

    <div class="row">
        <div class="col-sm-offset-6 col-sm-6">
            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i> <?php echo trans('back.update_order'); ?></button>
        </div>
    </div>

    <?php echo Form::close(); ?>


<?php else: ?>

    <h4 class="red"><?php echo trans('back.no_membership_plans_found'); ?></h4>

<?php endif; ?>