

<?php $__env->startSection('meta-title', trans('back.admin_interface')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.admin_interface'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.adjust_admin_interface_settings'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- Form -->
                <?php echo Form::model(appCon(), ['route' => 'admin.settings.admin-int.update', 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


                <!-- select box for 'ai_list_no'-->
                <div class="form-group">
                    <?php echo Form::label('ai_list_no', trans('back.default_listings_per_page').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('ai_list_no', rangePerPage(), null, ['class'=>'form-control']);; ?>

                    </div>
                </div>

                <!-- select box for 'ai_list_sort'-->
                <div class="form-group">
                    <?php echo Form::label('ai_list_sort', trans('back.default_listings_sort').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('ai_list_sort', [
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
                        ], null, ['class'=>'form-control']);; ?>

                    </div>
                </div>

                <!-- select box for 'ai_user_no'-->
                <div class="form-group">
                    <?php echo Form::label('ai_user_no', trans('back.default_users_per_page').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('ai_user_no', rangePerPage(), null, ['class'=>'form-control']);; ?>

                    </div>
                </div>

                <!-- select box for 'ai_user_sort'-->
                <div class="form-group">
                    <?php echo Form::label('ai_user_sort', trans('back.default_users_sort').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('ai_user_sort', [
                        'name_ASC' => 'Last Name (A-Z)',
                        'name_DESC' => 'Last Name (Z-A)',
                        'date_DESC' => 'Registration Date (Latest)',
                        'date_ASC' => 'Registration Date (Oldest)'
                        ], null, ['class'=>'form-control']);; ?>

                    </div>
                </div>

                <!-- select box for 'ai_listing_plans_no'-->
                <div class="form-group">
                    <?php echo Form::label('ai_listing_plans_no', trans('back.default_listing_plans_per_page').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('ai_listing_plans_no', rangePerPage(), null, ['class'=>'form-control']);; ?>

                    </div>
                </div>

                <!-- select box for 'ai_payments_no'-->
                <div class="form-group">
                    <?php echo Form::label('ai_payments_no', trans('back.default_payments_per_page').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('ai_payments_no', rangePerPage(), null, ['class'=>'form-control']);; ?>

                    </div>
                </div>

                <!-- select box for 'ai_administrators_no'-->
                <div class="form-group">
                    <?php echo Form::label('ai_administrators_no', trans('back.default_administrators_per_page').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('ai_administrators_no', rangePerPage(), null, ['class'=>'form-control']);; ?>

                    </div>
                </div>

                <!-- select box for 'ai_compprofiles_no'-->
                <div class="form-group">
                    <?php echo Form::label('ai_compprofiles_no', trans('back.default_company_profiles_per_page').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('ai_compprofiles_no', rangePerPage(), null, ['class'=>'form-control']);; ?>

                    </div>
                </div>

                <!-- select box for 'ai_datafields_no'-->
                <div class="form-group">
                    <?php echo Form::label('ai_datafields_no', trans('back.default_data_fields_per_page').':', ['class'=>'col-sm-3 control-label no-padding-right']); ?>

                    <div class="col-xs-10 col-sm-5">
                        <?php echo Form::select('ai_datafields_no', rangePerPage(), null, ['class'=>'form-control']);; ?>

                    </div>
                </div>


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