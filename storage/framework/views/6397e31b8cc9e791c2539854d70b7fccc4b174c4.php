<!-- Form (for updating order)-->
<?php echo Form::open(['route' => ['admin.data_features.update_order'], 'method' => 'PATCH']); ?>


<table id="simple-table" class="table table-striped table-hover">

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

    <?php foreach($features as $feature): ?>

        <tr>
            <td>

                <div class="row">

                    <div class="col-sm-6">
                        <?php echo trans('back.name'); ?>: <strong><?php echo $feature->name; ?></strong><br>
                        <?php echo trans('back.listings'); ?>: <strong><?php echo $feature->listingsNo; ?></strong>
                    </div>

                    <!-- ORDER -->
                    <div class="col-sm-3">
                        <div class="margin-t-5 visible-xs"></div>
                        <span class="visible-xs"><?php echo trans('back.ORDER'); ?>: </span><?php echo Form::text('order_'.$feature->id, $feature->order, ['class' => 'input-mini']); ?>

                    </div>
                    <!-- ./ORDER -->

                    <!-- ACTIONS -->
                    <div class="col-sm-3">
                        <div class="margin-t-10 visible-xs"></div>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                    <i class="fa fa-cogs"></i> <?php echo trans('back.feature_actions'); ?>

                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                </button>

                                <ul class="dropdown-menu dropdown-info">
                                    <li>
                                        <a href="<?php echo route('admin.data_features.edit', [$feature->id]); ?>"><i class="fa fa-pencil"></i> <?php echo trans('back.edit'); ?></a>
                                    </li>

                                    <li class="divider"></li>

                                    <li>
                                        <a href="<?php echo route('admin.data_features.destroy', [$feature->id]); ?>" data-delete="<?php echo csrf_token(); ?>" data-confirm="<?php echo trans('back.delete_feature_confirm'); ?>"><i class="fa fa-trash-o"></i> <?php echo trans('back.delete_feature'); ?></a>
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

<!-- End of form -->

<?php echo str_replace('/?', '?', $features->render()); ?>