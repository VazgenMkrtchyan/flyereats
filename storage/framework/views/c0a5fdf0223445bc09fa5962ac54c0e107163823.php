

<?php $__env->startSection('meta-title', siteTitle(trans('front.title_account_summary'))); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('front.partials.alert-no-active-membership-plan', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <h1><i class="fa fa-info-circle"></i> <?php echo trans('front.account_summary'); ?></h1>

    <div class="row">

        <!--<div class="col-xs-12">

            <?php if(appCon()->membershipPlansBased()): ?>
                <div>
                    <h3>
                        <?php echo trans('front.membership_info'); ?>

                    </h3>

                    <?php if(Auth::user()->hasActiveMembershipPlan()): ?>
                        <?php echo trans('front.account_expiration'); ?>: <?php echo $user->expires_on ? format_date($user->expires_on) : trans('front.NEVER'); ?>

                        <br>
                        <?php echo trans('front.membership_plan'); ?>: <?php echo $user->membershipPlan->name; ?>

                        <br>
                        <?php echo trans('front.max_listings'); ?>: <?php echo $user->membershipPlan->max_listings ? $user->membershipPlan->max_listings : trans('front.UNLIMITED'); ?>

                    <?php else: ?>
                        <?php echo trans('front.no_active_membership_plan'); ?>

                    <?php endif; ?>
                    <div class="margin-b-13"></div>
                    <a href="<?php echo route('membershipplans.manage'); ?>">
                        <button class="btn-main btn-fixed" type="button">
                            <i class="fa fa-cog"></i> <?php echo trans('front.manage_membership'); ?>

                        </button>
                    </a>
                </div>-->

                <br>
            <?php endif; ?>


            <div>
                <h3>
                    <?php echo trans('front.listings_info'); ?>

                </h3>
                <?php echo trans('front.total_listings'); ?>: <?php echo Auth::user()->listings()->count(); ?> <a href="<?php echo route('userlistings.index'); ?>">(<?php echo trans('front.view'); ?>)</a> <br>
                <span class="text-success"><?php echo trans('front.active_listings'); ?>:</span> <?php echo Auth::user()->listings()->listingsFilter(['listingStatus' => 'active'])->count(); ?> <a href="<?php echo route('userlistings.index', ['show' => 'active']); ?>">(<?php echo trans('front.view'); ?>)</a> <br>
                <span class="text-danger"><?php echo trans('front.inactive_listings'); ?>:</span> <?php echo Auth::user()->listings()->listingsFilter(['listingStatus' => 'inactive'])->count(); ?> <a href="<?php echo route('userlistings.index', ['show' => 'inactive']); ?>">(<?php echo trans('front.view'); ?>)</a> <br>
            </div>

            <br>

            <div>
                <h3>
                    <?php echo trans('front.compprofile'); ?>

                </h3>
                <?php if(! Auth::user()->hasCompany()): ?>
                    <a href="<?php echo route('compprofile.create'); ?>">
                        <button class="btn-main btn-fixed" type="button">
                            <i class="fa fa-info"></i> <?php echo trans('front.create_compprofile'); ?>

                        </button>
                    </a>

                <?php else: ?>
                    <a href="https://www.ipswichautos.co.uk/my-listings">
                        <button class="btn-main btn-fixed" type="button">
                            <i class="fa fa-pencil"></i> Manage Your Cars
                        </button>
                    </a>
                    <a href="https://www.ipswichautos.co.uk/add-listing">
                        <button class="btn-main btn-fixed btn-red" type="button">
                            <i class="fa fa-car"></i> Add Your Car
                        </button>
                    </a>
                <?php endif; ?>
            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('additional-scripts'); ?>
    <?php echo $__env->make('admin.js.destroy', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>