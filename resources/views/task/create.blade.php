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
    {!! Form::open(['url' => action('TaskController@store'), 'method' => 'post', 'id' => 'add_printer_form','files'=>true ]) !!}
    <div class="box-body">
        <div class="row">
            @component('components.widget', ['class' => 'box-primary'])
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
                        {!! Form::label('description', __('delivery.description').':*') !!}
                        {!! Form::text('description', null, ['class' => 'form-control']); !!}
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-4 ">
                <div class="form-group">
                        {!! Form::label('special_instructions', __('delivery.special_instructions').':*') !!}
                        {!! Form::text('special_instructions', null, ['class' => 'form-control']); !!}
                </div>
            </div>
           
        </div>
            @endcomponent
       
            
        
            @component('components.widget', ['class' => 'box-primary'])
            <div class="col-md-12 form-group">
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label for="">Starting Location: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="start_lat" value="{{old('start_lat')}}" required placeholder="Latitude">
                            <input type="text" class="form-control " name="start_log" value="{{old('start_log')}}" required placeholder="Longitude">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label for="">Ending Location: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="end_lat" value="{{old('end_lat')}}" required placeholder="Latitude">
                            <input type="text" class="form-control " name="end_log" value="{{old('end_log')}}" required placeholder="Longitude">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <h4>Click<a href="https://www.mapcoordinates.net/en" target="_blank"> here </a>to
                        find
                        your latitude and longitude</h4>
                </div>
            </div>
            @endcomponent
            @component('components.widget', ['class' => 'box-primary'])
            <div class="col-md-12 form-group">
                <div class="col-md-6">
                    <label for="">Start Date: <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="start_date" value="{{old('start_date')}}" required>
                </div>
                <div class="col-md-6">
                    <label for="">Ending Date: <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="end_date" value="{{old('end_date')}}" required>
                </div>
                <div class="col-md-6">
                    <label for="">Status: <span class="text-danger">*</span></label>
                    <select name="status" class="form-control" required>
                        <option value="" selected disabled>--select any one--</option>
                        <option @if(old('status')=='received' ) selected @endif value="received">Received</option>
                        <option @if(old('status')=='on Process' ) selected @endif value="on Process">On Process</option>
                        <option @if(old('status')=='completed' ) selected @endif value="completed">Completed</option>
                        <option @if(old('status')=='cancelled' ) selected @endif value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>

            @endcomponent
        </div>
        <div class="col-sm-12">
            <button type="submit" class="btn btn-primary pull-right">@lang('messages.save')</button>
        </div>
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
                url: '/deliveryusers',
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
                    return data.surname + '.' + data.first_name + ' ' + data.last_name;
                }
                var html = data.surname + '.' + data.first_name + ' ' + data.last_name;
                return html;
            },
        })
    });
</script>
@endsection