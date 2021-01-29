<?php $__env->startSection('meta-title', trans('back.browse_and_manage_membership_plans')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.membership_plans'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.browse_and_manage_membership_plans'); ?>

            </small>

            <a href="<?php echo route('admin.membership-plans.create'); ?>" class="pull-right">
                <button class="btn btn-white btn-pink btn-bold">
                    <span class="ace-icon fa fa-plus icon-on-left"></span>
                    <?php echo trans('back.add_membership_plan'); ?>

                </button>
            </a>
        </h1>
    </div><!-- /.page-header -->

    <?php echo $__env->make('admin.membership-plans.partials.note', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div id="accordion" class="accordion-style1 panel-group">

                    <?php foreach($userGroups as $userGroup): ?>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#userGroup<?php echo $userGroup->id; ?>" aria-expanded="false">
                                        <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp;<i><?php echo trans('back.user_group'); ?>:</i> <?php echo $userGroup->name; ?>

                                    </a>
                                </h4>
                            </div>

                            <div class="panel-collapse collapse" id="userGroup<?php echo $userGroup->id; ?>" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    <!-- MEMBERSHIP PLANS -->
                                    <?php echo $__env->make('admin.membership-plans.partials.membershipplans', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('admin.js.destroy', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>