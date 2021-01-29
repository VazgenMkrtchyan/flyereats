<!-- Form (for updating order)-->
<?php echo Form::open(['route' => 'admin.data_makes.update_order', 'method' => 'PATCH']); ?>


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

    <?php foreach($makes as $make): ?>

        <tr>
            <td>

                <div class="row">

                    <div class="col-sm-6">
                        <?php echo trans('back.name'); ?>: <strong><?php echo $make->name; ?></strong><br>
                        <?php echo trans('back.models'); ?>: <strong><?php echo $make->modelsNo; ?></strong> <a href="<?php echo route('admin.data_models.index', $make->id); ?>" class="btn btn-white btn-bold btn-success btn-minier"><?php echo trans('back.browse_models'); ?></a> <br>
                        <?php echo trans('back.listings'); ?>: <strong><?php echo $make->listingsNo; ?></strong>
                    </div>

                    <!-- ORDER -->
                    <div class="col-sm-3">
                        <div class="margin-t-5 visible-xs"></div>
                        <span class="visible-xs"><?php echo trans('back.ORDER'); ?>: </span><?php echo Form::text('order_'.$make->id, $make->order, ['class' => 'input-mini']); ?>

                    </div>
                    <!-- ./ORDER -->

                    <!-- ACTIONS -->
                    <div class="col-sm-3">
                        <div class="margin-t-10 visible-xs"></div>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                    <i class="fa fa-cogs"></i> <?php echo trans('back.make_actions'); ?>

                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                </button>

                                <ul class="dropdown-menu dropdown-info">
                                    <li>
                                        <a href="<?php echo route('admin.data_makes.edit', $make->id); ?>"><i class="fa fa-pencil"></i> <?php echo trans('back.edit'); ?></a>
                                    </li>

                                    <li class="divider"></li>

                                    <li>
                                        <a href="<?php echo route('admin.data_makes.destroy', $make->id); ?>" data-delete="<?php echo csrf_token(); ?>" data-confirm="<?php echo trans('back.delete_make_confirm'); ?>"><i class="fa fa-trash-o"></i> <?php echo trans('back.delete_make'); ?></a>
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

<?php echo str_replace('/?', '?', $makes->render()); ?>