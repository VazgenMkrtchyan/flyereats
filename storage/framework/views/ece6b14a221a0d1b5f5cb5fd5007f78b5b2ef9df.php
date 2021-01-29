

<?php $__env->startSection('meta-title', trans('back.overview_page')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.overview'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.overview_page'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <?php if(Auth::user()->hasPermission('admin.users.index')): ?>
                    <a href="<?php echo route('admin.users.index', ['moderationStatus' => 'pending']); ?>" class="btn btn-app btn-primary no-radius">
                        <i class="ace-icon fa fa-users bigger-230"></i>
                        <?php echo trans('back.overview_pending_users'); ?> (<?php echo $pendingUsers; ?>)
                    </a>
                <?php endif; ?>


                <?php if(Auth::user()->hasPermission('admin.listings.index')): ?>
                    <a href="<?php echo route('admin.listings.index', ['moderationStatus' => 'pending']); ?>" class="btn btn-app btn-warning no-radius">
                        <i class="ace-icon fa fa-list bigger-230"></i>
                        <?php echo trans('back.overview_pending_listings'); ?> (<?php echo $pendingListings; ?>)
                    </a>
                <?php endif; ?>

                <?php if(Auth::user()->IsSuper()): ?>
                    <a href="<?php echo route('admin.statistics.index'); ?>" class="btn btn-app btn-success no-radius">
                        <i class="ace-icon fa fa-info bigger-230"></i>
                        <?php echo trans('back.overview_website_statistics'); ?>

                    </a>
                <?php endif; ?>

                <a href="<?php echo route('admin.profile.edit'); ?>" class="btn btn-app btn-pink no-radius">
                    <i class="ace-icon fa fa-pencil-square-o bigger-230"></i>
                    <?php echo trans('back.oveview_edit_your_profile'); ?>

                </a>

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>