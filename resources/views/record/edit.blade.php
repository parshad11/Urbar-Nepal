@extends('layouts.app')
@section('title',  __('printer.add_printer'))

@section('content')
    <style type="text/css">


    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('contact.edit_supplier_record')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open(['url' => action('RecordController@update',$record->id), 'method' => 'PUT', 'id' => 'add_supplier_record_form' ]) !!}
        @component('components.widget', ['class' => 'box-primary'])
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('location_id', __('purchase.business_location').':*') !!}
                        @show_tooltip(__('tooltip.supplier_record_location'))
                        {!! Form::select('location_id',$business_locations, $record->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'),  'disabled']); !!}
                    </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-4">
                        <div class="form-group">
                        {!! Form::label('supplier_id', __('purchase.supplier') . ':*') !!}
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                {!! Form::select('contact_id',[$record->contact_id=> $record->contact->name], $record->contact_id, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'disabled']); !!}
                                <span class="input-group-btn">
                                <button type="button" class="btn btn-default bg-white btn-flat add_new_supplier" data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                                </span>
                            </div>
                        </div>
                        </div>
                  
                    <div class="col-sm-4">
                        <div class="form-group">
                        {!! Form::label('item', __('contact.item_name').':*') !!}
                        {!! Form::text('item', $record->item, ['class' => 'form-control']); !!}
                        </div>
                    </div>

                    <div class="col-sm-4">             
                        <div class="form-group">
                        {!! Form::label('quantity', __('contact.quantity').':*') !!}
                        {!! Form::text('quantity',$record->quantity, ['class' => 'form-control']); !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('unit_id', __('product.unit') . ':*') !!}
                        <div class="input-group">
                        {!! Form::select('unit_id', $units,$record->unit_id, ['class' => 'form-control select2', 'required']); !!}
                        <span class="input-group-btn">
                            <button type="button" @if(!auth()->user()->can('unit.create')) disabled @endif class="btn btn-default bg-white btn-flat btn-modal" data-href="{{action('UnitController@create', ['quick_add' => true])}}" title="@lang('unit.add_unit')" data-container=".view_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                        </span>
                        </div>
                    </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                        {!! Form::label('date', __('contact.expected_date') . ':*') !!}
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                {!! Form::text('expected_collection_date',@format_date($record->expected_collection_date), ['class' => 'form-control','id'=>'datetimepicker', 'required']); !!}
                            </div>  
                        </div>
                    </div>    

                    <div class="col-sm-4">
                        <div class="form-group">
                        {!! Form::label('supplier_location', __('contact.supplier_location') . ':*') !!}
						{!! Form::text('location', $record->location, ['class' => 'form-control','id'=>'supplier_location']); !!}
                        </div>
                    </div>
                   
                      
                       
                   
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary pull-right">@lang('messages.save')</button>
                    </div>
                </div>
            </div>

        @endcomponent
        {!! Form::close() !!}
    </section>
    <!-- /.content -->
@endsection
@section('javascript')
    <script>
        $(document).ready(function (e) {

            $('#datetimepicker').datepicker({
                useCurrent: false,
                minDate: moment()
             });
            
        });
    </script>
@endsection