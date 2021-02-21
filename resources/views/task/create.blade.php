@extends('layouts.app')
@section('title', __('lang_v1.assign_new_task'))

@section('content')
<style type="text/css">


</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('lang_v1.assign_new_task')</h1>
</section>

<!-- Main content -->
<section class="content">
    @include('layouts.partials.error')
    {!! Form::open(['url' => action('TaskController@store'), 'method' => 'post', 'id' => 'add_task_form','files'=>true ]) !!}
            @component('components.widget', ['class' => 'box-primary'])
            <div class="box-body">
            <div class="row">
            @if(count($business_locations) == 1)
            @php
            $default_location = current(array_keys($business_locations->toArray()));
            @endphp
            @else
            @php
            $default_location = null;
            @endphp
            @endif
            <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('location_id', __('purchase.business_location').':*') !!}
                        {!! Form::select('location_id',[], $default_location, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required'], $bl_attributes); !!}
                    </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-4 ">
            <div class="form-group">
					{!! Form::label('delivery_person_id', __('delivery.assign_task_to') . ':*') !!}
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-user"></i>
						</span>
						{!! Form::select('delivery_person_id',[], null, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'delivery_person_id']); !!}
						<span class="input-group-btn">
					
					</div>
				</div>
            </div>
            
            <div class="col-sm-4 ">
                <div class="form-group">
                   {!! Form::label('task_type', __('delivery.task_type') . ':*') !!} 
					{!! Form::select('task_type', $taskTypes, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
                </div>
            </div>
            <div class="col-sm-4 ">
                <div class="form-group">
                  {!! Form::label('task_status', __('delivery.task_status') . ':*') !!} 
					{!! Form::select('task_status', $taskStatuses, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-4 ">
                <div class="form-group">
                        {!! Form::label('title', __('delivery.task_title').':*') !!}
                        {!! Form::text('title', null, ['class' => 'form-control']); !!}
                </div>
            </div>
            <div class="col-sm-4 ">
                <div class="form-group">
                        {!! Form::label('description', __('delivery.description').':') !!}
                        {!! Form::text('description', null, ['class' => 'form-control']); !!}
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-4 ">
                <div class="form-group">
                        {!! Form::label('special_instructions', __('delivery.special_instructions') . ':') !!}
						{!! Form::textarea('special_instructions', null, ['class' => 'form-control','rows'=>3]); !!}
                </div>
            </div>
            </div>
        </div>
            @endcomponent
       
            
            @component('components.widget', ['class' => 'box-primary'])
            <div class="box-body">
                <div class="row">
                <div class="col-sm-12 " style="display: flex;justify-content: space-between;">
                     <div class="col-sm-4 ">
                        <div class="form-group">
                            {!! Form::label('task_address', __('delivery.task_address').':*') !!}
                            {!! Form::text('task_address', null, ['class' => 'form-control','id'=>'task_address']); !!}
                        </div>
                        <div class="form-group">
					<p>Please open this link to choose pickup location's latitude and longitude: <a href="https://www.mapcoordinates.net/en" target="_blank">https://www.mapcoordinates.net/en </a></p>
					</div>
                    </div>
                    <div class="col-sm-4 ">
                        <div class="form-group">
                            {!! Form::label('task_latitude', __('delivery.latitude').':*') !!}
                            {!! Form::text('task_latitude', null, ['class' => 'form-control']); !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('task_longitude', __('delivery.longitude').':*') !!}
                            {!! Form::text('task_longitude', null, ['class' => 'form-control']); !!}
                        </div>
                    </div>
                    
                </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary pull-right">@lang('messages.save')</button>
                </div>
            </div>
            </div>
            @endcomponent
        
    </div>

    </div>
    {!! Form::close() !!}
</section>
<!-- /.content -->
@endsection

@section('javascript')
<script>
    $(document).ready(function(e) {
        $('#delivery_person_id').select2({
            ajax: {
                url: '/delivery_users',
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
				var html = data.text + ' (' + data.location_id + ')';
				return html;
			},
			}).on('select2:select', function (e) {
				var data = e.params.data;
				 $('#shipping_address').val(data.business_location_address);
		
			});
    });
</script>
@endsection