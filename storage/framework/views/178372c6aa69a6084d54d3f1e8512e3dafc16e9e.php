<!-- BOX -->
<div class="widget-box widget-color-blue2">
	<div class="widget-header">
		<h5 class="widget-title">
			<i class="ace-icon fa fa-money"></i>
			<?php echo trans('back.payments'); ?>

            <span class="per_page">
                <?php echo Form::select('per_page', rangePerPage(), sessionOrWebc('ai_payments_no', Route::currentRouteName()), ['class'=>'form-control']);; ?>

            </span>
		</h5>
	</div>

	<div class="widget-body">
		<div class="widget-main">

            <?php echo str_replace('/?', '?', $payments->appends(Input::all())->render()); ?>


			<?php if($payments->count()): ?>

			<table class="table table-striped table-hover">
				<tbody>

				<?php foreach($payments as $payment): ?>

				<tr>
					<td>

                        <div class="row">

                            <div class="col-sm-9 bigger-110">
                                <?php echo trans('back.transaction_id'); ?>: #<strong><?php echo $payment->txn_id; ?></strong><br>
                                <?php echo trans('back.user'); ?>: <strong><?php echo $payment->user ? $payment->user->present()->fullName() : trans('back.DELETED_USER'); ?></strong>
                            </div>

                            <!-- ACTIONS -->
                            <div class="col-sm-3">
                                <div class="margin-t-10 visible-xs"></div>
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                            <i class="fa fa-cogs"></i> <?php echo trans('back.payment_actions'); ?>

                                            <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                        </button>

                                        <ul class="dropdown-menu dropdown-info">
                                            <li>
                                                <a href="<?php echo route('admin.payments.destroy', $payment->id); ?>" data-delete="<?php echo csrf_token(); ?>" data-confirm="<?php echo trans('back.delete_payment_confirm'); ?>"><i class="fa fa-trash-o"></i> <?php echo trans('back.delete_payment'); ?></a>
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

			<?php else: ?>

			<h4 class="red"><?php echo trans('back.no_payment_records_found'); ?></h4>

			<?php endif; ?>

			<?php echo str_replace('/?', '?', $payments->appends(Input::all())->render()); ?>


		</div>
	</div>
</div>