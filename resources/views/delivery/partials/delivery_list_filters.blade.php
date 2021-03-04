@can('business_settings.access')
@if(empty($only) || in_array('delivery_list_filter_location_id', $only))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('delivery_list_filter_location_id',  __('purchase.business_location') . ':') !!}

        {!! Form::select('delivery_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%','id' => 'location_id', 'placeholder' => __('lang_v1.all') ]); !!}
    </div>
</div>
@endif
@endcan
@if(empty($only) || in_array('delivery_list_filter_delivery_status', $only))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('delivery_list_filter_delivery_status',  __('delivery.delivery_status') . ':') !!}
        {!! Form::select('delivery_list_filter_delivery_status',$deliveryStatuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
    </div>
</div>
@endif
@can('view_own_delivery')
@if(empty($only) || in_array('delivery_list_filter_delivery_person_id', $only))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('delivery_list_filter_delivery_person_id',  __('delivery.delivery_person') . ':') !!}
        {!! Form::select('delivery_list_filter_delivery_person_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%','id' => 'delivery_person_id', 'placeholder' => __('lang_v1.all')]); !!}
    </div>
</div>
@endif
@endcan

@if(empty($only) || in_array('delivery_list_filter_date_range', $only))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('delivery_list_filter_date_range', __('report.date_range') . ':') !!}
        {!! Form::text('delivery_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
    </div>
</div>
@endif

@can('user.view')
@if((empty($only) || in_array('assigned_by', $only)) && !empty($sales_representative))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('assigned_by',  __('delivery.assigned_by') . ':') !!}
        {!! Form::select('assigned_by', $sales_representative, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
    </div>
</div>
@endif
@endcan

