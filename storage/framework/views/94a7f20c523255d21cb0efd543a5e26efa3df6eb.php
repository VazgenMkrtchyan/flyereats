<?php $__env->startSection('meta-title', siteTitle(trans('front.title_user_payments'))); ?>

<?php $__env->startSection('content'); ?>

    <h1><i class="fa fa-money"></i> <?php echo trans('front.your_payments'); ?></h1>

    <div class="row">

        <?php if($payments->count()): ?>
            <div class="col-sm-12">
                <ul>
                    <?php foreach($payments as $payment): ?>
                        <li>
                            <strong><?php echo trans('front.transaction_id'); ?>:</strong> <?php echo $payment->txn_id; ?> | <strong><?php echo trans('front.transaction_id'); ?>:</strong> <?php echo format_price($payment->amount); ?> | <strong><?php echo trans('front.date'); ?>:</strong> <?php echo format_date($payment->created_at); ?>

                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        <?php else: ?>
            <div>
                <?php echo trans('front.no_payments_made'); ?>

            </div>

        <?php endif; ?>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>