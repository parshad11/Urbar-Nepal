@if(empty($only) || in_array('record_list_filter_location_id', $only))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('record_list_filter_location_id',  __('purchase.business_location') . ':') !!}

        {!! Form::select('record_list_filter_location_id', $business_locations,null, ['class' => 'form-control select2', 'style' => 'width:100%','id' => 'location_id', 'placeholder' => __('lang_v1.all') ]); !!}
    </div>
</div>
@endif
@can('view_own_record')
@if(empty($only) || in_array('record_list_filter_supplier_id', $only))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('record_list_filter_supplier_id',  __('lang_v1.supplier_name') . ':') !!}
        {!! Form::select('record_list_filter_supplier_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%','id' => 'supplier_id', 'placeholder' => __('lang_v1.all')]); !!}
    </div>
</div>
@endif
@endcan
@if(empty($only) || in_array('record_list_filter_date_range', $only))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('record_list_filter_date_range', __('report.date_range') . ':') !!}
        {!! Form::text('record_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
    </div>
</div>
@endif
@can('user.view')
@if((empty($only) || in_array('added_by', $only)) && !empty($sales_representative))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('added_by',  __('delivery.added_by') . ':') !!}
        {!! Form::select('added_by', $sales_representative, null, ['class' => 'form-control select2','id'=>'user_id', 'style' => 'width:100%']); !!}
    </div>
</div>
@endif
@endcan