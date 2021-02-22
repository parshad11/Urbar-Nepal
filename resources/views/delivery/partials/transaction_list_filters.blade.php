@if(empty($only) || in_array('transaction_list_filter_location_id', $only))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('transaction_list_filter_location_id',  __('purchase.business_location') . ':') !!}

        {!! Form::select('transaction_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]); !!}
    </div>
</div>
@endif
@if(empty($only) || in_array('transaction_list_filter_customer_id', $only))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('transaction_list_filter_customer_id',  __('contact.customer') . ':') !!}
        {!! Form::select('transaction_list_filter_customer_id', $customers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
    </div>
</div>
@endif
@if(empty($only) || in_array('transaction_list_filter_assign_status', $only))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('transaction_list_filter_assign_status',  __('delivery.assign_status') . ':') !!}
        {!! Form::select('transaction_list_filter_assign_status', $assignStatuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
    </div>
</div>
@endif
@if(empty($only) || in_array('transaction_list_filter_date_range', $only))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('transaction_list_filter_date_range', __('report.date_range') . ':') !!}
        {!! Form::text('transaction_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
    </div>
</div>
@endif
@if((empty($only) || in_array('created_by', $only)) && !empty($sales_representative))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('created_by',  __('report.user') . ':') !!}
        {!! Form::select('created_by', $sales_representative, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
    </div>
</div>
@endif
