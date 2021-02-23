<!-- Edit Shipping Modal -->
<div class="modal fade" id="posShippingModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">@lang('sale.shipping')</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<div class="checkbox">
								<br/>
								<label>
								{!! Form::checkbox('assign_delivery_modal', 1, !empty($transaction->assign_delivery) ? $transaction->assign_delivery: '',	[ 'class' => 'input-icheck','id'=>'assign_delivery_modal']);  !!} {{ __( 'delivery.assign_delivery' ) }}
								</label>
							</div>
						</div>
					</div>

					<div class="col-md-6">
				        <div class="form-group">
				            {!! Form::label('shipping_details_modal', __('sale.shipping_details') . ':*' ) !!}
				            {!! Form::textarea('shipping_details_modal', !empty($transaction->shipping_details) ? $transaction->shipping_details : '', ['class' => 'form-control','placeholder' => __('sale.shipping_details'), 'required' ,'rows' => '4']); !!}
				        </div>
				    </div>



				    <div class="col-md-6">
				        <div class="form-group">
				            {!! Form::label('shipping_charges_modal', __('sale.shipping_charges') . ':*' ) !!}
				            <div class="input-group">
				                <span class="input-group-addon">
				                    <i class="fa fa-info"></i>
				                </span>
				                {!! Form::text('shipping_charges_modal', !empty($transaction->shipping_charges) ? @num_format($transaction->shipping_charges) : 0, ['class' => 'form-control input_number','placeholder' => __('sale.shipping_charges')]); !!}
				            </div>
				        </div>
				    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="posShippingModalUpdate">@lang('messages.update')</button>
			    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

