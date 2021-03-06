@extends('layouts.app')
@section('title', __('lang_v1.edit_stock_transfer'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('lang_v1.edit_stock_transfer')</h1>
</section>

<!-- Main content -->
<section class="content no-print">
	{!! Form::open(['url' => action('StockTransferController@update', [$sell_transfer->id]), 'method' => 'put', 'id' => 'stock_transfer_form' ]) !!}
	@component('components.widget', ['class' => 'box-primary'])
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('transaction_date', __('messages.date') . ':*') !!}
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							{!! Form::text('transaction_date', @format_datetime($sell_transfer->transaction_date), ['class' => 'form-control', 'readonly', 'required']); !!}
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('ref_no', __('purchase.ref_no').':') !!}
						{!! Form::text('ref_no', $sell_transfer->ref_no, ['class' => 'form-control', 'readonly']); !!}
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('status', __('sale.status').':*') !!} @show_tooltip(__('lang_v1.completed_status_help'))
						{!! Form::select('status', $statuses, $sell_transfer->status, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'status']); !!}
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('location_id', __('lang_v1.location_from').':*') !!}
						{!! Form::select('location_id', $business_locations, $sell_transfer->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'id' => 'location_id', 'disabled']); !!}
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('transfer_location_id', __('lang_v1.location_to').':*') !!}
						{!! Form::select('transfer_location_id', $business_locations, $purchase_transfer->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'id' => 'transfer_location_id', 'disabled']); !!}
					</div>
				</div>

			</div>
			@endcomponent

			@component('components.widget', ['class' => 'box-primary','title'=>'Search Products'])
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>
							{!! Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product_for_srock_adjustment', 'placeholder' => __('stock_adjustment.search_product')]); !!}
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="table-responsive">
					<table class="table table-bordered table-striped table-condensed"
					id="stock_adjustment_product_table">
						<thead>
							<tr>
								<th class="col-sm-4 text-center">
									@lang('sale.product')
								</th>
								<th class="col-sm-3 text-center">
									@lang('sale.qty')
								</th>
								<th class="col-sm-3 text-center">
									@lang('sale.subtotal')
								</th>
								<th class="col-sm-2 text-center"><i class="fa fa-trash" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody>
							@php
								$product_row_index = 0;
								$subtotal = 0;
							@endphp
							@foreach($products as $product)
								@include('stock_transfer.partials.product_table_row', ['product' => $product, 'row_index' => $loop->index])
								@php
									$product_row_index = $loop->index + 1;
									$subtotal += ($product->quantity_ordered*$product->last_purchased_price);
								@endphp
							@endforeach
						</tbody>
						<tfoot>
							<tr class="text-center"><td colspan="2"></td><td><div class="pull-right"><b>@lang('stock_adjustment.total_amount'):</b> <span id="total_adjustment">{{@num_format($subtotal)}}</span></div></td></tr>
						</tfoot>
					</table>
					<input type="hidden" id="product_row_index" value="{{$product_row_index}}">
					<input type="hidden" id="total_amount" name="final_total" value="{{$subtotal}}">
					</div>
				</div>

				<div class="col-sm-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('assign_delivery', 1, $sell_transfer->assign_delivery,
                        [  'class' => 'input-icheck' ,'id' => 'assign_delivery' ]); !!}{{ __( 'delivery.assign_delivery' ) }}
					</label>
				</div>
				</div>
			</div>
			@endcomponent

			@component('components.widget', ['class' => 'box-primary hide assign_delivery_div'])
			<div class="row">
				<div class="col-md-12 " style="display:flex;justify-content: space-between;">
						<div class=" col-sm-4 ">
							<div class="form-group">
								{!! Form::label('delivery_person_id', __('delivery.delivery_person') . ':*') !!}
								<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-user"></i>
						</span>
									{!! Form::select('delivery_person_id', (isset($main_delivery) ? [ $main_delivery->delivery_person_id => $main_delivery->delivery_person->user->user_name] : [] ), (isset($main_delivery) ? $main_delivery->delivery_person_id : '' ), ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'),'id' => 'delivery_person_id', 'style' => 'width: 100%;' ]); !!}
								</div>
							</div>
						</div>
						<div class="col-sm-4">
						<div class="form-group">
							{!! Form::label('shipping_charges', __('lang_v1.shipping_charges') . ':') !!}
							{!! Form::text('shipping_charges', $sell_transfer->shipping_charges, ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.shipping_charges')]); !!}
						</div>
						</div>
					
						<div class=" col-sm-4 @if(!empty($default_delivery_status)) hide @endif">
							<div class="form-group">
								{!! Form::label('delivery_status', __('delivery.delivery_status') . ':*') !!}
								{!! Form::select('delivery_status', $stock_delivery_statuses , (isset($main_delivery) ? $main_delivery->delivery_status : '' ), ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required','style' => 'width: 100%;']); !!}
							</div>
						</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12" style="display:flex;justify-content: space-between;">
						<div class=" col-sm-4 ">
							<div class="form-group">
								{!! Form::label('special_instructions', __('delivery.special_delivery_instructions') . ':') !!}
								{!! Form::textarea('special_delivery_instructions',(isset($main_delivery) ? $main_delivery->special_delivery_instructions  : '' ), ['class' => 'form-control','rows'=>3]); !!}
							</div>
						</div>
						<div class="col-sm-4">
						<div class="form-group">
						{!! Form::label('shipping_details', __( 'purchase.shipping_details' ) . ':') !!}
						{!! Form::text('shipping_details', $sell_transfer->shipping_details, ['class' => 'form-control']); !!}
						</div>	
						</div>
						<div class="col-sm-4">
						<div class="form-group">
							{!! Form::label('additional_notes',__('purchase.additional_notes')) !!}
							{!! Form::textarea('additional_notes', $sell_transfer->additional_notes, ['class' => 'form-control', 'rows' => 3]); !!}
						</div>
						</div>
					</div>
				</div>
			    </div>
			@endcomponent
			<div class="row">
					<div class="col-sm-12">
						<button type="submit" id="save_stock_transfer" class="btn btn-primary pull-right">@lang('messages.save')</button>
					</div>
				</div>
	{!! Form::close() !!}
</section>
@stop
@section('javascript')
	<script src="{{ asset('js/stock_transfer.js?v=' . $asset_v) }}"></script>
	<script type="text/javascript">
		__page_leave_confirmation('#stock_transfer_form');
	</script>
	<script>
        $(document).ready(function (e) {

		if($('#assign_delivery').is(':checked')) {
				$('div.assign_delivery_div').removeClass('hide');
        }

        $('#assign_delivery').on('ifChecked', function(event){
				$('div.assign_delivery_div').removeClass('hide');
   	    	});

		$('#assign_delivery').on('ifUnchecked', function(event){
				$('div.assign_delivery_div').addClass('hide');
        	});

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
@endsection
