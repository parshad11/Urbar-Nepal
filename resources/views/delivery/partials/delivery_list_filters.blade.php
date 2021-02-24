@if(empty($only) || in_array('delivery_list_filter_location_id', $only))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('delivery_list_filter_location_id',  __('purchase.business_location') . ':') !!}

        {!! Form::select('delivery_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]); !!}
    </div>
</div>
@endif
@if(empty($only) || in_array('delivery_list_filter_assign_status', $only))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('delivery_list_filter_assign_status',  __('delivery.assign_status') . ':') !!}
        {!! Form::select('delivery_list_filter_assign_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
    </div>
</div>
@endif
@if(empty($only) || in_array('delivery_list_filter_delivery_person_id', $only))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('delivery_list_filter_delivery_person_id',  __('delivery.delivery_person') . ':') !!}
        {!! Form::select('delivery_list_filter_delivery_person_id', $delivery_people, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
    </div>
</div>
@endif
@if(empty($only) || in_array('delivery_list_filter_date_range', $only))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('delivery_list_filter_date_range', __('report.date_range') . ':') !!}
        {!! Form::text('delivery_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
    </div>
</div>
@endif
@if((empty($only) || in_array('assigned_by', $only)) && !empty($sales_representative))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('assigned_by',  __('report.user') . ':') !!}
        {!! Form::select('assigned_by', $sales_representative, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
    </div>
</div>
@endif
@if(!empty($delivery_statuses))
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('delivery_status', __('lang_v1.delivery_status') . ':') !!}
            {!! Form::select('delivery_status', $delivery_statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
        </div>
    </div>
@endif
