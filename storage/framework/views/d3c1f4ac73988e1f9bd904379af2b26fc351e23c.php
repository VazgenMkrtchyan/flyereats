

<?php $__env->startSection('meta-title', trans('back.edit_company_profile')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.edit_company_profile'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.modify_company_profile_details'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <!-- LOGO -->
                <!-- Form -->
                <?php echo Form::open(['route' => ['admin.company-profiles.uploadlogo', $compprofile->id], 'class' => 'form-horizontal', 'files' => true, 'id' => 'company-logo']); ?>


                <h3 class="header smaller lighter red">
                    <?php echo trans('back.company_logo'); ?>

                </h3>

                <!-- Files Select Field-->
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">

                        <?php if($compprofile->logo): ?>
                            <img src="<?php echo $compprofile->logoUrl(); ?>">
                        <?php else: ?>
                            <p><strong><?php echo trans('back.no_logo_uploaded'); ?></strong></p>
                        <?php endif; ?>

                        <div class="form-group">
                            <div class="col-xs-10 col-sm-4">
                                <?php echo Form::file('logo', ['id' => 'logo']); ?>

                            </div>
                            <div id="logo-error" class="help-block col-xs-12 col-sm-reset red2" style="display: none">
                                <?php echo trans('back.not_valid_image'); ?>

                            </div>
                        </div>

                        <button id="upload-logo-button" class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-upload bigger-110"></i>
                            <?php echo trans('back.upload_logo'); ?>

                        </button>

                        <?php if($compprofile->logo): ?>
                            <a href="<?php echo route('admin.company-profiles.deletelogo', $compprofile->id); ?>">
                                <button class="btn btn-danger" type="button">
                                    <i class="ace-icon fa fa-trash-o bigger-110"></i>
                                    <?php echo trans('back.delete_logo'); ?>

                                </button>
                            </a>
                        <?php endif; ?>

                    </div>
                </div>

                <?php echo Form::close(); ?>

                        <!-- End of form -->
                <!-- ./LOGO -->

                <!-- Form -->
                <?php echo Form::model($compprofile, ['route' => ['admin.company-profiles.update', $compprofile->id], 'class' => 'form-horizontal', 'id' => 'form-val', 'method' => 'PATCH']); ?>


                        <!-- hidden field for old_state_id -->
                <?php echo Form::hidden('old_state_id', $compprofile->state_id); ?>

                        <!-- hidden field for old_city -->
                <?php echo Form::hidden('old_city', $compprofile->city); ?>

                        <!-- hidden field for old_addr_1 -->
                <?php echo Form::hidden('old_addr_1', $compprofile->addr_1); ?>

                        <!-- hidden field for old_zip -->
                <?php echo Form::hidden('old_zip', $compprofile->zip); ?>


                        <!-- FIELDS -->
                <?php echo $__env->make('admin.company-profiles.partials.create-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo Form::close(); ?>

                        <!-- End of form -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_top -->
    <?php echo Form::hidden('nav_li_top', 'company-profiles'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>