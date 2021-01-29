<?php error_reporting(0); ?>
<!-- BOX -->
<div class="widget-box widget-color-blue2">
    <div class="widget-header">
        <h5 class="widget-title">
            <i class="ace-icon fa fa-list"></i>
            <?php echo trans('back.listings'); ?>


            <?php if($user): ?>
                of <strong><?php echo $user->present()->fullName; ?></strong> (<a href="<?php echo route('admin.users.index'); ?>" style="color: white"><?php echo trans('back.select_other_user'); ?></a>) (<a href="<?php echo route('admin.listings.index', Input::except('userId')); ?>" style="color: white"><?php echo trans('back.remove_user_filter'); ?></a>)
            <?php endif; ?>

            <span class="per_page">
                <?php echo Form::select('per_page', rangePerPage(), sessionOrWebc('ai_list_no', Route::currentRouteName()), ['class'=>'form-control']);; ?>

            </span>
        </h5>
    </div>

    <div class="widget-body">
        <div class="widget-main">

            <?php echo str_replace('/?', '?', $listings->appends(Input::all())->render()); ?>


            <?php if($listings->count()): ?>

                <div class="manage-listings">

                    <table class="table table-striped table-hover">
                        <tbody>

                        <?php foreach($listings as $listing): ?>

                            <tr>
                                <td>

                                    <div class="row">

                                        <div class="col-sm-2">
                                            <div class="l-photo">
                                                <img src="<?php echo $listing->present()->mainThumbUrl; ?>" class="img-thumbnail">
                                                <?php if($listing->isFeatured()): ?>
                                                    <span class="label label-danger"><?php echo trans('Sold'); ?></span>
                                                <?php endif; ?>
                                                <?php if($listing->isHighlighted()): ?>
                                                    <span class="label label-warning"><?php echo trans('back.highlighted'); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="l-actions">

                                            </div>
                                        </div>

                                        <div class="col-sm-7 bigger-110">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <?php echo @$listing->present()->listingName; ?> - <?php echo $listing->present()->listingPrice; ?>

                                                    <?php echo @$listing->present()->listingAddress; ?> <br>
                                                    <?php echo trans('back.seller'); ?>: <?php echo $listing->user->present()->fullName(); ?> <br>
                                                    <?php echo trans('back.created_at'); ?>: <?php echo format_date($listing->created_at); ?>

                                                </div>

                                                <?php echo false; ?>

                                                <div class="col-sm-6">
                                                    
                                                    <?php echo trans('back.listing_status'); ?>:
                                                    <?php if($listing->isActiveListing()): ?>
                                                        <span class="label label-success"><?php echo trans('back.active'); ?></span>
                                                    <?php else: ?>
                                                        <span class="label label-danger"><?php echo trans('back.inactive'); ?></span> || <?php echo trans('back.reasons'); ?>:
                                                        <?php if($listing->isArchived()): ?>
                                                            <?php echo trans('back.archived'); ?>

                                                        <?php endif; ?>
                                                        <?php if(! $listing->isApproved()): ?>
                                                            | <?php echo trans('back.moderation_status'); ?>: (<?php echo trans('back.' . $listing->st_moderation); ?>)
                                                        <?php endif; ?>
                                                        <?php if(! $listing->hasActiveListingPlan()): ?>
                                                           | <?php echo trans('back.no_active_plan'); ?>

                                                        <?php endif; ?>
                                                        <?php if(! $listing->user->isActiveUser()): ?>
                                                           | <?php echo trans('back.inactive_user'); ?>

                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- ACTIONS -->
                                        <div class="col-sm-3">
                                            <div class="margin-t-10 visible-xs"></div>
                                            <div class="pull-right">
                                                <div class="btn-group">
                                                    <button data-toggle="dropdown" class="btn btn btn-white btn-primary dropdown-toggle">
                                                        <i class="fa fa-cogs"></i> <?php echo trans('back.listing_actions'); ?>

                                                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-info">
                                                        <li>
                                                            <a href="<?php echo route('admin.listings.edit', $listing->id); ?>"><i class="fa fa-pencil"></i> <?php echo trans('back.edit'); ?></a>
                                                        </li>

                                                        <?php if($listing->isPending()): ?>
                                                            <li>
                                                                <a href="<?php echo route('admin.listings.approve', $listing->id); ?>"><i class="fa fa-thumbs-o-up"></i> <?php echo trans('back.approve'); ?></a>
                                                            </li>
                                                        <?php endif; ?>

                                                        <?php if(! $listing->isRejected()): ?>
                                                            <li>
                                                                <a href="<?php echo route('admin.listings.reject', $listing->id); ?>"><i class="fa fa-ban"></i> <?php echo trans('back.reject'); ?></a>
                                                            </li>
                                                        <?php endif; ?>

                                                        <?php if($listing->isRejected()): ?>
                                                            <li style="display:none;">
                                                                <a href="<?php echo route('admin.listings.undoreject', $listing->id); ?>"><i class="fa fa-undo"></i> <?php echo trans('back.undo_reject'); ?></a>
                                                            </li>
                                                        <?php endif; ?>

                                                        <li class="divider" ></li>

                                                        <li style="display:none;">
                                                            <a href="<?php echo route('admin.listings.destroy', $listing->id); ?>" data-delete="<?php echo csrf_token();; ?>" data-confirm="<?php echo trans('back.delete_listing_confirm'); ?>"><i class="fa fa-trash-o"></i> <?php echo trans('back.delete_listing'); ?></a>
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

                </div>

            <?php else: ?>

                <h4 class="red"><?php echo trans('back.no_listings_found'); ?></h4>

            <?php endif; ?>


            <?php echo str_replace('/?', '?', $listings->appends(Input::all())->render()); ?>


        </div>
    </div>
</div>