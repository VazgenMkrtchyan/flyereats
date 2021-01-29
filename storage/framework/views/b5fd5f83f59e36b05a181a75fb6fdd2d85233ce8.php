

<?php $__env->startSection('meta-title', 'Data Fields Manager'); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.data_fields'); ?> (<?php echo $parent->name; ?>)
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.browse_and_manage_models'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="margin-b-10">
                    <a href="<?php echo route('admin.data_models.create', $parent->id); ?>">
                        <button class="btn btn-white btn-pink btn-bold">
                            <span class="ace-icon fa fa-plus icon-on-left"></span>
                            <?php echo trans('back.add_model'); ?>

                        </button>
                    </a>
                    <span class="per_page">
                        <?php echo Form::select('per_page', rangePerPage(), sessionOrWebc('ai_datafields_no', Route::currentRouteName()), ['class'=>'form-control', 'data-redirect' => route('admin.data_models.index', Route::input('makeId'))]);; ?>

                    </span>
                </div>

                <!-- MODELS -->
                <!-- Form (for updating order)-->
                <?php echo Form::open(['route' => ['admin.data_models.update_order', $parent->id], 'method' => 'PATCH']); ?>


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

                    <?php foreach($models as $model): ?>

                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?php echo trans('back.name'); ?>: <strong><?php echo $model->name; ?></strong> <br>
                                        <?php echo trans('back.listings'); ?>: <strong><?php echo $model->listingsNo; ?></strong>
                                    </div>

                                    <!-- ORDER -->
                                    <div class="col-sm-3">
                                        <div class="margin-t-5 visible-xs"></div>
                                        <span class="visible-xs"><?php echo trans('back.ORDER'); ?>: </span><?php echo Form::text('order_'.$model->id, $model->order, ['class' => 'input-mini']); ?>

                                    </div>
                                    <!-- ./ORDER -->

                                    <!-- ACTIONS -->
                                    <div class="col-sm-3">
                                        <div class="margin-t-10 visible-xs"></div>
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                                    <i class="fa fa-cogs"></i> <?php echo trans('back.model_actions'); ?>

                                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                                </button>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a href="<?php echo route('admin.data_models.edit', [$parent->id, $model->id]); ?>"><i class="fa fa-pencil"></i> <?php echo trans('back.edit'); ?></a>
                                                    </li>

                                                    <li class="divider"></li>

                                                    <li>
                                                        <a href="<?php echo route('admin.data_models.destroy', [$parent->id, $model->id]); ?>" data-delete="<?php echo csrf_token(); ?>" data-confirm="<?php echo trans('back.delete_model_confirm'); ?>"><i class="fa fa-trash-o"></i> <?php echo trans('back.delete_model'); ?></a>
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


                <?php echo str_replace('/?', '?', $models->render()); ?>



            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_identifier -->
    <?php echo Form::hidden('nav_li_identifier', 'admin.data_makes.index'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('admin.js.destroy', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>