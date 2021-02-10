@extends('layouts.app')
@section('title',  __('add record'))

@section('content')
    <style type="text/css">


    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Add Supplier Upcomming Record</h1>
        <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open(['url' => action('RecordController@store'), 'method' => 'post', 'id' => 'add_printer_form' ]) !!}
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Supplier: <span class="text-danger">*</span></label>
                            <select name="supplier_id" id="" class="form-control" required>
                                <option value="" selected disabled>--select any one--</option>
                                @foreach($contact as $contact)
                                    <option value="{{$contact->id}}">{{$contact->supplier_business_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">item: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="item" required>
                        </div>
                        <div class="form-group">
                            <label for="">quantity: </label>
                            <input type="text" class="form-control" name="quantity" >
                        </div>
                        <div class="form-group">
                            <label for="">Date: <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="">Location: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="location" required>
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