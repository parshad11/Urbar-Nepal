@extends('layouts.app')
@section('title',  __('add Task'))

@section('content')
    <style type="text/css">


    </style>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Add Supplier Upcomming Record</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('layouts.partials.error')
        {!! Form::open(['url' => action('TaskController@store'), 'method' => 'post', 'id' => 'add_printer_form','files'=>true ]) !!}
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @component('components.widget', ['class' => 'box-primary'])
                            <div class="col-md-12 form-group">
                                <div class="col-md-6">
                                    <label for="">Assign to: <span class="text-danger">*</span></label>
                                    {{--<select name="assign_to" id="assign_to" class="form-control"--}}
                                            {{--placeholder="please select" required>--}}
                                        {{--<option value="" selected disabled>--select any one--</option>--}}
                                        {{--@foreach($user as $user)--}}
                                        {{--<option value="{{$user->id}}">{{$user->surname.'.'}}{{$user->first_name}} {{$user->last_name}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                    {!! Form::select('assign_to',[], null, ['class' => 'form-control ', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'assign_to']); !!}

                                </div>
                                <div class="col-md-6">
                                    <label for="">Task Type: <span class="text-danger">*</span></label>
                                    <select name="task_type" id="" class="form-control" required>
                                        <option value="" selected disabled>--select any one--</option>
                                        <option value="delivery">Delivery</option>
                                        <option value="pick-up">pick-up</option>
                                    </select>
                                </div>
                            </div>
                        @endcomponent
                        @component('components.widget', ['class' => 'box-primary'])
                            <div class="col-md-12 form-group">
                                <div class="col-md-6">
                                    <label for="">title: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Description: </label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Special Instruction: </label>
                                    <textarea name="special_instruction" class="form-control"></textarea>
                                </div>
                            </div>
                        @endcomponent
                        @component('components.widget', ['class' => 'box-primary'])
                            <div class="col-md-12 form-group">
                                <div class="col-md-6">
                                    <label for="">Starting Location: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="start_loc" required
                                           placeholder="Latitude and Longitude only">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Ending Location: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="end_loc" required
                                           placeholder="Latitude and Longitude only">
                                </div>
                                <div class="col-md-6">
                                    <h4>Click<a href="https://www.mapcoordinates.net/en" target="_blank"> here </a>to
                                        find
                                        your latitude and longitude</h4>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Start Date: <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="start_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Ending Date: <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="end_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Status: <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control" required>
                                        <option value="" selected disabled>--select any one--</option>
                                        <option value="pending">Pending</option>
                                        <option value="on Process">On Process</option>
                                        <option value="completed">Completed</option>
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
        $(document).ready(function() {
            $('#assign_to').select2({
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
                        return data.surname+'.'+data.first_name+ ' ' + data.last_name;
                    }
                    var html = data.surname+'.'+data.first_name+ ' ' + data.last_name;
                    return html;
                },
                language: {
                    noResults: function() {
                        var name = $('#assign_to')
                            .data('select2')
                            .dropdown.$search.val();
                        return (
                            'Result Not Found'
                        );
                    },
                },
            }).on('select2:select', function (e) {
                var data = e.params.data;
                var multiplier = parseFloat(
                );
            });
        });


    </script>
@endsection

