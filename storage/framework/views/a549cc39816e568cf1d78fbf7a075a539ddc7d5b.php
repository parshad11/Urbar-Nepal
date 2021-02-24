<?php $__env->startSection('title', __('sale.edit_sale')); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->getFromJson('sale.edit_sale'); ?> <small>(<?php echo app('translator')->getFromJson('sale.invoice_no'); ?>: <span class="text-success">#<?php echo e($transaction->invoice_no, false); ?>)</span></small></h1>
</section>
<!-- Main content -->
<section class="content">
<input type="hidden" id="amount_rounding_method" value="<?php echo e($pos_settings['amount_rounding_method'] ?? '', false); ?>">
<input type="hidden" id="amount_rounding_method" value="<?php echo e($pos_settings['amount_rounding_method'] ?? 'none', false); ?>">
<?php if(!empty($pos_settings['allow_overselling'])): ?>
	<input type="hidden" id="is_overselling_allowed">
<?php endif; ?>
<?php if(session('business.enable_rp') == 1): ?>
    <input type="hidden" id="reward_point_enabled">
<?php endif; ?>
<input type="hidden" id="item_addition_method" value="<?php echo e($business_details->item_addition_method, false); ?>">
	<?php echo Form::open(['url' => action('SellPosController@update', ['id' => $transaction->id ]), 'method' => 'put', 'id' => 'edit_sell_form' ]); ?>


	<?php echo Form::hidden('location_id', $transaction->location_id, ['id' => 'location_id', 'data-receipt_printer_type' => !empty($location_printer_type) ? $location_printer_type : 'browser']);; ?>

	<div class="row">
		<div class="col-md-12 col-sm-12">
			<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
				<?php if(!empty($transaction->selling_price_group_id)): ?>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fas fa-money-bill-alt"></i>
								</span>
								<?php echo Form::hidden('price_group', $transaction->selling_price_group_id, ['id' => 'price_group']); ?>

								<?php echo Form::text('price_group_text', $transaction->price_group->name, ['class' => 'form-control', 'readonly']);; ?>

								<span class="input-group-addon">
									<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.price_group_help_text') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
								</span> 
							</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if(in_array('types_of_service', $enabled_modules) && !empty($transaction->types_of_service)): ?>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fas fa-external-link-square-alt text-primary service_modal_btn"></i>
								</span>
								<?php echo Form::text('types_of_service_text', $transaction->types_of_service->name, ['class' => 'form-control', 'readonly']);; ?>


								<?php echo Form::hidden('types_of_service_id', $transaction->types_of_service_id, ['id' => 'types_of_service_id']); ?>


								<span class="input-group-addon">
									<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.types_of_service_help') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
								</span> 
							</div>
							<small><p class="help-block <?php if(empty($transaction->selling_price_group_id)): ?> hide <?php endif; ?>" id="price_group_text"><?php echo app('translator')->getFromJson('lang_v1.price_group'); ?>: <span><?php if(!empty($transaction->selling_price_group_id)): ?><?php echo e($transaction->price_group->name, false); ?><?php endif; ?></span></p></small>
						</div>
					</div>
					<div class="modal fade types_of_service_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
						<?php if(!empty($transaction->types_of_service)): ?>
						<?php echo $__env->make('types_of_service.pos_form_modal', ['types_of_service' => $transaction->types_of_service], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if(in_array('subscription', $enabled_modules)): ?>
					<div class="col-md-4 pull-right col-sm-6">
						<div class="checkbox">
							<label>
				              <?php echo Form::checkbox('is_recurring', 1, $transaction->is_recurring, ['class' => 'input-icheck', 'id' => 'is_recurring']);; ?> <?php echo app('translator')->getFromJson('lang_v1.subscribe'); ?>?
				            </label><button type="button" data-toggle="modal" data-target="#recurringInvoiceModal" class="btn btn-link"><i class="fa fa-external-link"></i></button><?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.recurring_invoice_help') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="clearfix"></div>
				<div class="<?php if(!empty($commission_agent)): ?> col-sm-3 <?php else: ?> col-sm-4 <?php endif; ?>">
					<div class="form-group">
						<?php echo Form::label('contact_id', __('contact.customer') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-user"></i>
							</span>
							<input type="hidden" id="default_customer_id" name="default_customer_id"
							value="<?php echo e($transaction->contact_id, false); ?>" >
							<input type="hidden" id="default_customer_name" name="default_customer_name" 
							value="<?php echo e($transaction->contact->name, false); ?>" >
							<?php echo Form::select('contact_id', 
								[], null, ['class' => 'form-control mousetrap select2', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone']);; ?>

						</div>
					</div>
				</div>

				<div class="col-md-3">
		          <div class="form-group">
		            <div class="multi-input">
		              <?php echo Form::label('pay_term_number', __('contact.pay_term') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('tooltip.pay_term') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
		              <br/>
		              <?php echo Form::number('pay_term_number', $transaction->pay_term_number, ['class' => 'form-control width-40 pull-left', 'placeholder' => __('contact.pay_term')]);; ?>


		              <?php echo Form::select('pay_term_type', 
		              	['months' => __('lang_v1.months'), 
		              		'days' => __('lang_v1.days')], 
		              		$transaction->pay_term_type, 
		              	['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select')]);; ?>

		            </div>
		          </div>
		        </div>

				<?php if(!empty($commission_agent)): ?>
				<div class="col-sm-3">
					<div class="form-group">
					<?php echo Form::label('commission_agent', __('lang_v1.commission_agent') . ':'); ?>

					<?php echo Form::select('commission_agent', 
								$commission_agent, $transaction->commission_agent, ['class' => 'form-control select2']);; ?>

					</div>
				</div>
				<?php endif; ?>
				<div class="<?php if(!empty($commission_agent)): ?> col-sm-3 <?php else: ?> col-sm-4 <?php endif; ?>">
					<div class="form-group">
						<?php echo Form::label('transaction_date', __('sale.sale_date') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							<?php echo Form::text('transaction_date', $transaction->transaction_date, ['class' => 'form-control', 'readonly', 'required']);; ?>

						</div>
					</div>
				</div>
				<?php
					if($transaction->status == 'draft' && $transaction->is_quotation == 1){
						$status = 'quotation';
					} else {
						$status = $transaction->status;
					}
				?>
				<div class="<?php if(!empty($commission_agent)): ?> col-sm-3 <?php else: ?> col-sm-4 <?php endif; ?>">
					<div class="form-group">
						<?php echo Form::label('status', __('sale.status') . ':*'); ?>

						<?php echo Form::select('status', ['final' => __('sale.final'), 'draft' => __('sale.draft'), 'quotation' => __('lang_v1.quotation')], $status, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']);; ?>

					</div>
				</div>
				<?php if($transaction->status == 'draft'): ?>
				<div class="col-sm-3">
					<div class="form-group">
						<?php echo Form::label('invoice_scheme_id', __('invoice.invoice_scheme') . ':'); ?>

						<?php echo Form::select('invoice_scheme_id', $invoice_schemes, $default_invoice_schemes->id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]);; ?>

					</div>
				</div>
				<?php endif; ?>
				<div class="clearfix"></div>
				<!-- Call restaurant module if defined -->
		        <?php if(in_array('tables' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules)): ?>
		        	<span id="restaurant_module_span" 
		        		data-transaction_id="<?php echo e($transaction->id, false); ?>">
		          		<div class="col-md-3"></div>
		        	</span>
		        <?php endif; ?>
			<?php echo $__env->renderComponent(); ?>
			
			<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
				<div class="col-sm-10 col-sm-offset-1">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-btn">
								<button type="button" class="btn btn-default bg-white btn-flat" data-toggle="modal" data-target="#configure_search_modal" title="<?php echo e(__('lang_v1.configure_product_search'), false); ?>"><i class="fa fa-barcode"></i></button>
							</div>
							<?php echo Form::text('search_product', null, ['class' => 'form-control mousetrap', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'),
							'autofocus' => true,
							]);; ?>

							<span class="input-group-btn">
								<button type="button" class="btn btn-default bg-white btn-flat pos_add_quick_product" data-href="<?php echo e(action('ProductController@quickAdd'), false); ?>" data-container=".quick_add_product_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
							</span>
						</div>
					</div>
				</div>

				<div class="row col-sm-12 pos_product_div" style="min-height: 0">

					<input type="hidden" name="sell_price_tax" id="sell_price_tax" value="<?php echo e($business_details->sell_price_tax, false); ?>">

					<!-- Keeps count of product rows -->
					<input type="hidden" id="product_row_count" 
						value="<?php echo e(count($sell_details), false); ?>">
					<?php
						$hide_tax = '';
						if( session()->get('business.enable_inline_tax') == 0){
							$hide_tax = 'hide';
						}
					?>
					<div class="table-responsive">
					<table class="table table-condensed table-bordered table-striped table-responsive" id="pos_table">
						<thead>
							<tr>
								<th class="text-center">	
									<?php echo app('translator')->getFromJson('sale.product'); ?>
								</th>
								<th class="text-center">
									<?php echo app('translator')->getFromJson('sale.qty'); ?>
								</th>
								<?php if(!empty($pos_settings['inline_service_staff'])): ?>
									<th class="text-center">
										<?php echo app('translator')->getFromJson('restaurant.service_staff'); ?>
									</th>
								<?php endif; ?>
								<th class="text-center <?php echo e($hide_tax, false); ?>">
									<?php echo app('translator')->getFromJson('sale.price_inc_tax'); ?>
								</th>
								<th class="text-center">
									<?php echo app('translator')->getFromJson('sale.subtotal'); ?>
								</th>
								<th class="text-center"><i class="fa fa-close" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $sell_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo $__env->make('sale_pos.product_row', ['product' => $sell_line, 'row_count' => $loop->index, 'tax_dropdown' => $taxes, 'sub_units' => !empty($sell_line->unit_details) ? $sell_line->unit_details : [], 'action' => 'edit' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
					</div>
					<div class="table-responsive">
					<table class="table table-condensed table-bordered table-striped table-responsive">
						<tr>
							<td>
								<div class="pull-right">
									<b><?php echo app('translator')->getFromJson('sale.item'); ?>:</b> 
									<span class="total_quantity">0</span>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<b><?php echo app('translator')->getFromJson('sale.total'); ?>: </b>
									<span class="price_total">0</span>
								</div>
							</td>
						</tr>
					</table>
					</div>
					<div class="col-sm-3 ">
					<div class="checkbox">
					<label>
						<?php echo Form::checkbox('assign_delivery', 1, $transaction->assign_delivery, 
						[  'class' => 'input-icheck' ,'id' => 'assign_delivery' ]);; ?> <?php echo e(__( 'delivery.assign_delivery' ), false); ?> 
					</label>	
					</div>		
			</div>
				</div>
			<?php echo $__env->renderComponent(); ?>

			<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
				<div class="col-md-4">
			        <div class="form-group">
			            <?php echo Form::label('discount_type', __('sale.discount_type') . ':*' ); ?>

			            <div class="input-group">
			                <span class="input-group-addon">
			                    <i class="fa fa-info"></i>
			                </span>
			                <?php echo Form::select('discount_type', ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], $transaction->discount_type , ['class' => 'form-control','placeholder' => __('messages.please_select'), 'required', 'data-default' => 'percentage']);; ?>

			            </div>
			        </div>
			    </div>
			    <?php
			    	$max_discount = !is_null(auth()->user()->max_sales_discount_percent) ? auth()->user()->max_sales_discount_percent : '';
			    ?>
			    <div class="col-md-4">
			        <div class="form-group">
			            <?php echo Form::label('discount_amount', __('sale.discount_amount') . ':*' ); ?>

			            <div class="input-group">
			                <span class="input-group-addon">
			                    <i class="fa fa-info"></i>
			                </span>
			                <?php echo Form::text('discount_amount', number_format($transaction->discount_amount, config('constants.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'data-default' => $business_details->default_sales_discount, 'data-max-discount' => $max_discount, 'data-max-discount-error_msg' => __('lang_v1.max_discount_error_msg', ['discount' => $max_discount != '' ? number_format($max_discount, config('constants.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '']) ]);; ?>

			            </div>
			        </div>
			    </div>
			    <div class="col-md-4"><br>
			    	<b><?php echo app('translator')->getFromJson( 'sale.discount_amount' ); ?>:</b>(-) 
					<span class="display_currency" id="total_discount">0</span>
			    </div>
			    <div class="clearfix"></div>
			    <div class="col-md-12 well well-sm bg-light-gray <?php if(session('business.enable_rp') != 1): ?> hide <?php endif; ?>">
			    	<input type="hidden" name="rp_redeemed" id="rp_redeemed" value="<?php echo e($transaction->rp_redeemed, false); ?>">
			    	<input type="hidden" name="rp_redeemed_amount" id="rp_redeemed_amount" value="<?php echo e($transaction->rp_redeemed_amount, false); ?>">
			    	<div class="col-md-12"><h4><?php echo e(session('business.rp_name'), false); ?></h4></div>
			    	<div class="col-md-4">
				        <div class="form-group">
				            <?php echo Form::label('rp_redeemed_modal', __('lang_v1.redeemed') . ':' ); ?>

				            <div class="input-group">
				                <span class="input-group-addon">
				                    <i class="fa fa-gift"></i>
				                </span>
				                <?php echo Form::number('rp_redeemed_modal', $transaction->rp_redeemed, ['class' => 'form-control direct_sell_rp_input', 'data-amount_per_unit_point' => session('business.redeem_amount_per_unit_rp'), 'min' => 0, 'data-max_points' => !empty($redeem_details['points']) ? $redeem_details['points'] : 0, 'data-min_order_total' => session('business.min_order_total_for_redeem') ]);; ?>

				                <input type="hidden" id="rp_name" value="<?php echo e(session('business.rp_name'), false); ?>">
				            </div>
				        </div>
				    </div>
				    <div class="col-md-4">
				    	<p><strong><?php echo app('translator')->getFromJson('lang_v1.available'); ?>:</strong> <span id="available_rp"><?php echo e($redeem_details['points'] ?? 0, false); ?></span></p>
				    </div>
				    <div class="col-md-4">
				    	<p><strong><?php echo app('translator')->getFromJson('lang_v1.redeemed_amount'); ?>:</strong> (-)<span id="rp_redeemed_amount_text"><?php echo e(number_format($transaction->rp_redeemed_amount, config('constants.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></p>
				    </div>
			    </div>
			    <div class="clearfix"></div>
			    <div class="col-md-4">
			    	<div class="form-group">
			            <?php echo Form::label('tax_rate_id', __('sale.order_tax') . ':*' ); ?>

			            <div class="input-group">
			                <span class="input-group-addon">
			                    <i class="fa fa-info"></i>
			                </span>
			                <?php echo Form::select('tax_rate_id', $taxes['tax_rates'], $transaction->tax_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control', 'data-default'=> $business_details->default_sales_tax], $taxes['attributes']);; ?>


							<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" 
							value="<?php echo e(number_format(optional($transaction->tax)->amount, config('constants.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" data-default="<?php echo e($business_details->tax_calculation_amount, false); ?>">
			            </div>
			        </div>
			    </div>
			    <div class="col-md-4 col-md-offset-4">
			    	<b><?php echo app('translator')->getFromJson( 'sale.order_tax' ); ?>:</b>(+) 
					<span class="display_currency" id="order_tax"><?php echo e($transaction->tax_amount, false); ?></span>
			    </div>
			    <div class="clearfix"></div>
				<div class="row" >
				<div class="col-md-12" style="display:flex;justify-content: space-between;" >
				<div class="col-md-4">
					<div class="form-group">
			            <?php echo Form::label('shipping_details', __('sale.shipping_details')); ?>

			            <div class="input-group">
							<span class="input-group-addon">
			                    <i class="fa fa-info"></i>
			                </span>
			                <?php echo Form::textarea('shipping_details',$transaction->shipping_details, ['class' => 'form-control','placeholder' => __('sale.shipping_details') ,'rows' => '1', 'cols'=>'30']);; ?>

			            </div>
			        </div>
				</div>
			
				<div class="col-md-4">
					<div class="form-group">
						<?php echo Form::label('shipping_charges', __('sale.shipping_charges')); ?>

						<div class="input-group">
						<span class="input-group-addon">
						<i class="fa fa-info"></i>
						</span>
						<?php echo Form::text('shipping_charges',number_format($transaction->shipping_charges, config('constants.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']),['class'=>'form-control input_number','placeholder'=> __('sale.shipping_charges')]);; ?>

						</div>
					</div>
				</div>
				</div>
				</div>
				
			    <div class="col-md-4 col-md-offset-8">
			    	<?php if(!empty($pos_settings['amount_rounding_method']) && $pos_settings['amount_rounding_method'] > 0): ?>
			    	<small id="round_off"><br>(<?php echo app('translator')->getFromJson('lang_v1.round_off'); ?>: <span id="round_off_text">0</span>)</small>
					<br/>
					<input type="hidden" name="round_off_amount" 
						id="round_off_amount" value=0>
					<?php endif; ?>
			    	<div><b><?php echo app('translator')->getFromJson('sale.total_payable'); ?>: </b>
						<input type="hidden" name="final_total" id="final_total_input">
						<span id="total_payable">0</span>
					</div>
			    </div>
			    <div class="col-md-12">
			    	<div class="form-group">
						<?php echo Form::label('sell_note',__('sale.sell_note') . ':'); ?>

						<?php echo Form::textarea('sale_note', $transaction->additional_notes, ['class' => 'form-control', 'rows' => 3]);; ?>

					</div>
			    </div>
			    <input type="hidden" name="is_direct_sale" value="1">
			    <div class="col-md-12 text-right">
			    	<?php echo Form::hidden('is_save_and_print', 0, ['id' => 'is_save_and_print']);; ?>

			    	<button type="button" class="btn btn-primary" id="submit-sell"><?php echo app('translator')->getFromJson('messages.update'); ?></button>
			    	<button type="button" id="save-and-print" class="btn btn-primary btn-flat"><?php echo app('translator')->getFromJson('lang_v1.update_and_print'); ?></button>
			    </div>
			<?php echo $__env->renderComponent(); ?>

		</div>
	</div>
	<?php if(in_array('subscription', $enabled_modules)): ?>
		<?php echo $__env->make('sale_pos.partials.recurring_invoice_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>
	<?php echo Form::close(); ?>

</section>

<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	<?php echo $__env->make('contact.create', ['quick_add' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!-- /.content -->
<div class="modal fade register_details_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>
<!-- quick product modal -->
<div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>

<?php echo $__env->make('sale_pos.partials.configure_search_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/pos.js?v=' . $asset_v), false); ?>"></script>
	<script src="<?php echo e(asset('js/product.js?v=' . $asset_v), false); ?>"></script>
	<script src="<?php echo e(asset('js/opening_stock.js?v=' . $asset_v), false); ?>"></script>
	<!-- Call restaurant module if defined -->
    <?php if(in_array('tables' ,$enabled_modules) || in_array('modifiers' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules)): ?>
    	<script src="<?php echo e(asset('js/restaurant.js?v=' . $asset_v), false); ?>"></script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/sell/edit.blade.php ENDPATH**/ ?>