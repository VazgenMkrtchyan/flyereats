<!-- BOX -->
<div class="widget-box widget-color-blue2">
    <div class="widget-header">
        <h5 class="widget-title">
            <i class="ace-icon fa fa-list"></i>
            <?php echo trans('back.user_groups'); ?>

        </h5>
    </div>

    <div class="widget-body">
        <div class="widget-main">

            <?php if($userGroups->count()): ?>

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
                    <!-- Form (for updating order)-->
                    <?php echo Form::open(['route' => 'admin.user-groups.updateorder', 'method' => 'PATCH']); ?>


                    <?php foreach($userGroups as $userGroup): ?>

                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-sm-6 bigger-110">
                                        <?php echo trans('back.user_group_name'); ?>: <strong><?php echo $userGroup->name; ?></strong> <br>
                                        <?php echo trans('back.users'); ?>: <?php echo $userGroup->users()->count(); ?>

                                        <a href="<?php echo route('admin.users.index', ['userGroup' => $userGroup->id]); ?>">(<?php echo trans('back.view'); ?>)</a>
                                    </div>

                                    <!-- ORDER -->
                                    <div class="col-sm-3">
                                        <div class="margin-t-5 visible-xs"></div>
                                        <span class="visible-xs"><?php echo trans('back.ORDER'); ?>: </span><?php echo Form::text('order_'.$userGroup->id, $userGroup->order, ['class' => 'input-mini']); ?>

                                    </div>
                                    <!-- ./ORDER -->

                                    <!-- ACTIONS -->
                                    <div class="col-sm-3">
                                        <div class="margin-t-10 visible-xs"></div>
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                                    <i class="fa fa-cogs"></i> <?php echo trans('back.user_group_actions'); ?>

                                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                                </button>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a href="<?php echo route('admin.user-groups.edit', $userGroup->id);; ?>"><i class="fa fa-pencil"></i> <?php echo trans('back.edit'); ?></a>
                                                    </li>

                                                    <li class="divider"></li>

                                                    <li>
                                                        <a href="<?php echo route('admin.user-groups.destroy', $userGroup->id);; ?>" data-delete="<?php echo csrf_token(); ?>" data-confirm="<?php echo trans('back.delete_user_group_confirm'); ?>"><i class="fa fa-trash-o"></i> <?php echo trans('back.delete_user_group'); ?></a>
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
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i> Update Order</button>
                    </div>
                </div>

                <?php echo Form::close(); ?>

                <!-- End of form -->

                <div class="clearfix"></div>

            <?php else: ?>

                <h4 class="red">No User Groups found!</h4>

            <?php endif; ?>

        </div>
    </div>
</div>