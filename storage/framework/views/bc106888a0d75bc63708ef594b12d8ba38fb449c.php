<!-- Edit Shipping Modal -->
<div class="modal fade" id="posShippingModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?php echo app('translator')->getFromJson('sale.shipping'); ?></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<div class="checkbox">
								<br/>
								<label>
								<?php echo Form::checkbox('assign_delivery_modal', 1, !empty($transaction->assign_delivery) ? $transaction->assign_delivery: '',	[ 'class' => 'input-icheck','id'=>'assign_delivery_modal']);; ?> <?php echo e(__( 'delivery.assign_delivery' ), false); ?>

								</label>
							</div>
						</div>
					</div>

					<div class="col-md-6">
				        <div class="form-group">
				            <?php echo Form::label('shipping_details_modal', __('sale.shipping_details') . ':*' ); ?>

				            <?php echo Form::textarea('shipping_details_modal', !empty($transaction->shipping_details) ? $transaction->shipping_details : '', ['class' => 'form-control','placeholder' => __('sale.shipping_details'), 'required' ,'rows' => '4']);; ?>

				        </div>
				    </div>



				    <div class="col-md-6">
				        <div class="form-group">
				            <?php echo Form::label('shipping_charges_modal', __('sale.shipping_charges') . ':*' ); ?>

				            <div class="input-group">
				                <span class="input-group-addon">
				                    <i class="fa fa-info"></i>
				                </span>
				                <?php echo Form::text('shipping_charges_modal', !empty($transaction->shipping_charges) ? number_format($transaction->shipping_charges, config('constants.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : 0, ['class' => 'form-control input_number','placeholder' => __('sale.shipping_charges')]);; ?>

				            </div>
				        </div>
				    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="posShippingModalUpdate"><?php echo app('translator')->getFromJson('messages.update'); ?></button>
			    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->getFromJson('messages.cancel'); ?></button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/sale_pos/partials/edit_shipping_modal.blade.php ENDPATH**/ ?>