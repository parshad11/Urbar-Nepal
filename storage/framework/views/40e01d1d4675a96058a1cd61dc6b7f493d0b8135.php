<?php $__env->startSection('title', __('lang_v1.add_stock_transfer')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->getFromJson('lang_v1.add_stock_transfer'); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
	<?php echo Form::open(['url' => action('StockTransferController@store'), 'method' => 'post', 'id' => 'stock_transfer_form' ]); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::label('transaction_date', __('messages.date') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							<?php echo Form::text('transaction_date', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'H:i'), ['class' => 'form-control', 'readonly', 'required']);; ?>

						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::label('ref_no', __('purchase.ref_no').':'); ?>

						<?php echo Form::text('ref_no', null, ['class' => 'form-control']);; ?>

					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::label('status', __('sale.status').':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.completed_status_help') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
						<?php echo Form::select('status', $statuses, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'status']);; ?>

					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::label('location_id', __('lang_v1.location_from').':*'); ?>

						<?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'location_id']);; ?>

					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::label('transfer_location_id', __('lang_v1.location_to').':*'); ?>

						<?php echo Form::select('transfer_location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'transfer_location_id']);; ?>

					</div>
				</div>

			</div>
		
			<?php echo $__env->renderComponent(); ?>

			<?php $__env->startComponent('components.widget', ['class' => 'box-primary','title'=>'Search Products']); ?>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>
							<?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product_for_srock_adjustment', 'placeholder' => __('stock_adjustment.search_product'), 'disabled']);; ?>

						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<input type="hidden" id="product_row_index" value="0">
					<input type="hidden" id="total_amount" name="final_total" value="0">
					<div class="table-responsive">
					<table class="table table-bordered table-striped table-condensed"
					id="stock_adjustment_product_table">
						<thead>
							<tr>
								<th class="col-sm-4 text-center">
									<?php echo app('translator')->getFromJson('sale.product'); ?>
								</th>
								<th class="col-sm-3 text-center">
									<?php echo app('translator')->getFromJson('sale.qty'); ?>
								</th>
								<th class="col-sm-3 text-center">
									<?php echo app('translator')->getFromJson('sale.subtotal'); ?>
								</th>
								<th class="col-sm-2 text-center"><i class="fa fa-trash" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<tr class="text-center"><td colspan="2"></td><td><div class="pull-right"><b><?php echo app('translator')->getFromJson('stock_adjustment.total_amount'); ?>:</b> <span id="total_adjustment">0.00</span></div></td></tr>
						</tfoot>
					</table>
					</div>
				</div>
				<div class="col-sm-3">
				<div class="checkbox">
					<label>
						<?php echo Form::checkbox('assign_delivery', 1, null,
                        [  'class' => 'input-icheck' ,'id' => 'assign_delivery' ]);; ?><?php echo e(__( 'delivery.assign_delivery' ), false); ?>

					</label>
				</div>
				</div>
			</div>
			<?php echo $__env->renderComponent(); ?>
	
			<?php $__env->startComponent('components.widget', ['class' => 'box-primary hide assign_delivery_div']); ?>
				<div class="row">
				<div class="col-md-12 " style="display:flex;justify-content: space-between;">
						<div class=" col-sm-4 ">
							<div class="form-group">
								<?php echo Form::label('delivery_person_id', __('delivery.delivery_person') . ':*'); ?>

								<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-user"></i>
						</span>
									<?php echo Form::select('delivery_person_id',[], null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'),'id' => 'delivery_person_id', 'style' => 'width: 100%;' ]);; ?>

								</div>
							</div>
						</div>
						<div class="col-sm-4">
						<div class="form-group">
							<?php echo Form::label('shipping_charges', __('lang_v1.shipping_charges') . ':'); ?>

							<?php echo Form::text('shipping_charges', 0, ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.shipping_charges')]);; ?>

						</div>
						</div>
					
						<div class=" col-sm-4 <?php if(!empty($default_delivery_status)): ?> hide <?php endif; ?>">
							<div class="form-group">
								<?php echo Form::label('delivery_status', __('delivery.delivery_status') . ':*'); ?>

								<?php echo Form::select('delivery_status', $stock_delivery_statuses , null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required','style' => 'width: 100%;']);; ?>

							</div>
						</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12" style="display:flex;justify-content: space-between;">
						<div class=" col-sm-4 ">
							<div class="form-group">
								<?php echo Form::label('special_instructions', __('delivery.special_delivery_instructions') . ':'); ?>

								<?php echo Form::textarea('special_delivery_instructions', null, ['class' => 'form-control','rows'=>3]);; ?>

							</div>
						</div>
						<div class="col-sm-4">
						<div class="form-group">
						<?php echo Form::label('shipping_details', __( 'purchase.shipping_details' ) . ':'); ?>

						<?php echo Form::text('shipping_details', null, ['class' => 'form-control']);; ?>

						</div>	
						</div>
						<div class="col-sm-4">
						<div class="form-group">
							<?php echo Form::label('additional_notes',__('purchase.additional_notes')); ?>

							<?php echo Form::textarea('additional_notes', null, ['class' => 'form-control', 'rows' => 3]);; ?>

						</div>
						</div>
					</div>
				</div>
			    </div>
			<?php echo $__env->renderComponent(); ?>
			<div class="row">
				<div class="col-sm-12">
					<button type="submit" id="save_stock_transfer" class="btn btn-primary pull-right"><?php echo app('translator')->getFromJson('messages.save'); ?></button>
				</div>
			</div>
	<?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/stock_transfer.js?v=' . $asset_v), false); ?>"></script>
	<script type="text/javascript">
		__page_leave_confirmation('#stock_transfer_form');
	</script>

	<script>
        $(document).ready(function (e) {

		$('#assign_delivery').on('ifChecked', function(event){
				$('div.assign_delivery_div').removeClass('hide');
   	    	});

		$('#assign_delivery').on('ifUnchecked', function(event){
				$('div.assign_delivery_div').addClass('hide');
        	});

            $('#location_id').select2({
                ajax: {
                    url: '/business/get_locations',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data,
                        };
                    },
                },
                minimumInputLength: 1,
                escapeMarkup: function(m) {
                    return m;
                },
                templateResult: function(data) {
                    if (!data.id) {
                        return data.text;
                    }
                    var html = data.text;
                    return html;
                },
               
            })

            $('#transfer_location_id').select2({
                ajax: {
                    url: '/business/get_locations',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data,
                        };
                    },
                },
                minimumInputLength: 1,
                escapeMarkup: function(m) {
                    return m;
                },
                templateResult: function(data) {
                    if (!data.id) {
                        return data.text;
                    }
                    var html = data.text;
                    return html;
                },
            })

			$('#delivery_person_id').select2({
            ajax: {
                url: '/user/get_delivery_people',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page,
                    };
                },
                processResults: function(data) {
                    console.log(data);
                    return {
                        results: data,
                    };
                },
            },
            minimumInputLength: 1,
            escapeMarkup: function(m) {
                return m;
            },
         
            templateResult: function(data) {
                if (!data.id) {
                    return data.text;
                }
                var html = data.text;
                return html;
            },
        })
	});
	</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/stock_transfer/create.blade.php ENDPATH**/ ?>