<?php $__env->startSection('meta-title', trans('back.edit_listing')); ?>

<?php $__env->startSection('page-content'); ?>

    <div class="page-header">
        <h1>
            <?php echo trans('back.edit_listing'); ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo trans('back.modify_listing_details'); ?>

            </small>
        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <ul id="myTab" class="nav nav-tabs bigger-110">
                    <li class="active">
                        <a href="#listing-data" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo trans('back.listing_details'); ?></a>
                    </li>
                    <li>
                        <a href="#listing-photos" data-toggle="tab"><i class="fa fa-picture-o"></i> <?php echo trans('back.listing_photos'); ?></a>
                    </li>
                </ul>

                <div class="tab-content no-border">
                    <div class="tab-pane in active" id="listing-data">
                        <?php echo Form::model($listing ,['route' => ['admin.listings.update', $listing->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>


                        <?php echo Form::hidden('old_state_id', $listing->state_id); ?>

                        <?php echo Form::hidden('old_city', $listing->city); ?>

                        <?php echo Form::hidden('old_addr_1', $listing->addr_1); ?>

                        <?php echo Form::hidden('old_zip', $listing->zip); ?>

                        <?php echo Form::hidden('old_expires_on', $listing->expires_on ? $listing->expires_on->format('Y-m-d') : null ); ?>

                        <?php echo Form::hidden('old_high_or_feat_till', $listing->high_or_feat_till ? $listing->high_or_feat_till->format('Y-m-d') : null ); ?>

                        <?php echo Form::hidden('old_st_moderation', $listing->st_moderation); ?>


                        <?php echo $__env->make('admin.listings.partials.listing-data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <?php echo Form::close(); ?>

                    </div>

                    <div class="tab-pane" id="listing-photos">
                        <?php echo $__env->make('admin.listings.partials.listing-photos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->


    <!-- hidden field for nav_li_top -->
    <?php echo Form::hidden('nav_li_top', 'listings'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('admin.listings.js.js-listing-data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('admin.listings.js.js-listing-photos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('additional-css-before'); ?>
    <link rel="stylesheet" href="<?php echo asset('templates/admin/css/dropzone.css'); ?>" />
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>