@extends('layouts.app')
@section('title',  __('Edit Task'))

@section('content')
    <style type="text/css">


    </style>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Edit Supplier Upcomming Record</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('layouts.partials.error')
        {!! Form::open(['url' => action('TaskController@update',$task->id), 'method' => 'put', 'id' => 'add_printer_form' ]) !!}
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Assign to: <span class="text-danger">*</span></label>
                            <select name="assign_to" id="" class="form-control" required>
                                <option value="" selected disabled>--select any one--</option>
                                @foreach($user as $user)
                                    <option @if($task->assign_to==$user->id) selected @endif value="{{$user->id}}">{{$user->surname.'.'}}{{$user->first_name}} {{$user->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Task Type: <span class="text-danger">*</span></label>
                            <select name="task_type" id="" class="form-control" required>
                                <option value="" selected disabled>--select any one--</option>
                                <option @if($task->task_type=='delivery') selected @endif value="delivery" >Delivery</option>
                                <option @if($task->task_type=='pick-up') selected @endif value="pick-up" >pick-up</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">title: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" value="{{$task->title}}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Description: </label>
                            <textarea name="description"  class="form-control">{{$task->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Special Instruction: </label>
                            <textarea name="special_instruction"  class="form-control">{{$task->special_instruction}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Starting Location: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="start_loc" value="{{$task->start_loc}}" placeholder="Latitude and Longitude only" required>
                        </div>
                        <div class="form-group">
                            <label for="">Ending Location: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="end_loc" value="{{$task->end_loc}}" placeholder="Latitude and Longitude only"  required>
                        </div>
                        <div class="form-group">
                            <label for="">Start Date: <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="start_date" value="{{$task->start_date}}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Ending Date: <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="end_date" value="{{$task->end_date}}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Status: <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="" selected disabled>--select any one--</option>
                                <option @if($task->status=='pending') selected @endif value="pending">Pending</option>
                                <option @if($task->status=='on process') selected @endif value="on Process">On Process</option>
                                <option @if($task->status=='completed') selected @endif value="completed">Completed</option>
                            </select>
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
