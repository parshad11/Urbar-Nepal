@extends('layouts.app')
@section('title',  __('printer.add_printer'))

@section('content')
    <style type="text/css">


    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Edit Supplier Upcomming Record</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open(['url' => action('RecordController@update',$record->id), 'method' => 'post', 'id' => 'add_printer_form' ]) !!}
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Supplier: <span class="text-danger">*</span></label>
                            <select name="supplier_id" id="supplier_id" class="form-control" required>
                                <option value="" selected disabled>--select any one--</option>
                                @foreach($contact as $contact)
                                    <option @if($record->supplier_id==$contact->id) selected @endif value="{{$contact->id}}">{{$contact->name}} ({{$contact->supplier_business_name}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">item: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="item" required value="{{$record->item}}">
                        </div>
                        <div class="form-group">
                            <label for="">quantity: </label>
                            <input type="text" class="form-control" name="quantity" value="{{$record->quantity}}">
                        </div>
                        <div class="form-group">
                            <label for="">Date: <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="date" required value="{{$record->date}}">
                        </div>
                        <div class="form-group">
                            <label for="">Location: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="location" required value="{{$record->location}}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary pull-right">@lang('messages.save')</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
    <!-- /.content -->
@endsection
@section('javascript')
    <script>
        $(document).ready(function (e) {
            $('#supplier_id').select2({
                ajax: {
                    url: '/supplier/detail',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data,
                        };
                    },
                },
                minimumInputLength: 1,
                escapeMarkup: function (m) {
                    return m;
                },
                templateResult: function (data) {
                    if (!data.id) {
                        return data.name+' ('+data.supplier_business_name+')';
                    }
                    var html = data.name+' ('+data.supplier_business_name+')';
                    return html;
                },
            })
        });
    </script>
@endsection