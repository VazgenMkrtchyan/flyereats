

<?php $__env->startSection('meta-title', trans('back.front_interface')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.front_interface'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.adjust_front_interface_settings'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                <?php echo Form::model(appCon(), ['route' => 'admin.settings.front-int.update', 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


                        <!-- select box for 'color_scheme'-->
                <div class="form-group">
                    <?php echo Form::label('color_scheme', trans('back.color_scheme').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('color_scheme', [
                        'default' => trans('back.default_css'),
                        'green' => trans('back.green_css'),
                        'orange' => trans('back.orange_css'),
                        'pink' => trans('back.pink_css'),
                        'purple' => trans('back.purple_css')
                        ], null, ['class'=>'form-control']);; ?>

                    </div>
                </div>

                <!-- select box for 'ui_view'-->
                <div class="form-group">
                    <?php echo Form::label('ui_view', trans('back.default_listings_view').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('ui_view', [
                        'list' => trans('back.list'),
                        'grid' => trans('back.grid')
                        ], null, ['class'=>'form-control']);; ?>

                    </div>
                </div>

                <!-- select box for 'ui_list_sort'-->
                <div class="form-group">
                    <?php echo Form::label('ui_list_sort', trans('back.default_listings_sort').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('ui_list_sort', [
                        'year_DESC' => trans('back.year_DESC'),
                        'year_ASC' => trans('back.year_ASC'),
                        'date_DESC' => trans('back.date_DESC'),
                        'date_ASC' => trans('back.date_ASC'),
                        'price_DESC' => trans('back.price_DESC'),
                        'price_ASC' => trans('back.price_ASC'),
                        'mileage_ASC' => trans('back.mileage_ASC'),
                        'mileage_DESC' => trans('back.mileage_DESC')
                        ], null, ['class'=>'form-control']);; ?>

                    </div>
                </div>

                <!-- select box for 'ui_list_no'-->
                <div class="form-group">
                    <?php echo Form::label('ui_list_no', trans('back.default_listings_per_page').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('ui_list_no', [
                        '5' => '5',
                        '10' => '10',
                        '15' => '15',
                        '25' => '25',
                        '50' => '50'
                        ], null, ['class'=>'form-control']);; ?>

                    </div>
                </div>

                <!-- select box for 'ui_user_sort'-->
                <!--
                <div class="form-group">
                    <?php echo Form::label('ui_user_sort', trans('back.default_users_sort').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('ui_user_sort', [
                        'name_ASC' => trans('back.user_name_ASC'),
                        'name_DESC' => trans('back.user_name_DESC')
                        ], null, ['class'=>'form-control']);; ?>

                    </div>
                </div>
                -->


                <!-- select box for 'ui_user_no'-->
                <!--
                <div class="form-group">
                    <?php echo Form::label('ui_user_no', trans('back.default_users_per_page').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('ui_user_no', [
                        '5' => '5',
                        '10' => '10',
                        '15' => '15',
                        '20' => '20',
                        '25' => '25',
                        '30' => '30',
                        ], null, ['class'=>'form-control']);; ?>

                    </div>
                </div>
                -->

                <!-- submit for button -->
                <div class="clearfix form-actions">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            <?php echo trans('back.submit'); ?>

                        </button>
                    </div>
                </div>

                <?php echo Form::close(); ?>

                <!-- End of form -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>