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
                        @component('components.widget', ['class' => 'box-primary'])
                            <div class="col-md-12 form-group">
                                <div class="col-md-6">
                                    <label for="">Assign to: <span class="text-danger">*</span></label>
                                    <select name="assign_to" id="assign_to" class="form-control" required>
                                        <option value="" selected disabled>--select any one--</option>
                                        @foreach($user as $user)
                                            <option @if($task->assign_to==$user->id) selected
                                                    @endif value="{{$user->id}}">{{$user->surname.'.'}}{{$user->first_name}} {{$user->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Task Type: <span class="text-danger">*</span></label>
                                    <select name="task_type" id="" class="form-control" required>
                                        <option value="" selected disabled>--select any one--</option>
                                        <option @if($task->task_type=='delivery') selected @endif value="delivery">
                                            Delivery
                                        </option>
                                        <option @if($task->task_type=='pick-up') selected @endif value="pick-up">
                                            pick-up
                                        </option>
                                    </select>
                                </div>
                            </div>
                        @endcomponent
                        @component('components.widget', ['class' => 'box-primary'])
                            <div class="col-md-12 form-group">
                                <div class="col-md-6">
                                    <label for="">title: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" value="{{$task->title}}"
                                           required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Description: </label>
                                    <textarea name="description" class="form-control">{{$task->description}}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Special Instruction: </label>
                                    <textarea name="special_instruction"
                                              class="form-control">{{$task->special_instruction}}</textarea>
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
                                            <input type="text" class="form-control col-md-3" name="start_lat" value="{{$task->start_lat}}" required
                                                   placeholder="Latitude">
                                            <input type="text" class="form-control col-md-3" name="start_log" value="{{$task->start_log}}" required
                                                   placeholder="Longitude">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label for="">Ending Location: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control col-md-3" name="end_lat" value="{{$task->end_lat}}" required
                                                   placeholder="Latitude">
                                            <input type="text" class="form-control col-md-3" name="end_log" value="{{$task->end_log}}" required
                                                   placeholder="Longitude">
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
                                    <input type="date" class="form-control" name="start_date"
                                           value="{{$task->start_date}}"
                                           required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Ending Date: <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="end_date" value="{{$task->end_date}}"
                                           required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Status: <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="" selected disabled>--select any one--</option>
                                        <option @if($task->status=='received') selected @endif value="received">Received
                                        </option>
                                        <option @if($task->status=='on process') selected @endif value="on Process">On
                                            Process
                                        </option>
                                        <option @if($task->status=='completed') selected @endif value="completed">
                                            Completed
                                        </option>
                                        <option @if($task->status=='cancelled') selected @endif value="cancelled">
                                            Cancelled
                                        </option>
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
        </div>
        {!! Form::close() !!}
    </section>
    <!-- /.content -->
@endsection
@section('javascript')
    <script>
        $(document).ready(function (e) {
            $('#assign_to').select2({
                ajax: {
                    url: '/deliveryusers',
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
                        return data.surname + '.' + data.first_name + ' ' + data.last_name;
                    }
                    var html = data.surname + '.' + data.first_name + ' ' + data.last_name;
                    return html;
                },
            })
        });
    </script>
@endsection
