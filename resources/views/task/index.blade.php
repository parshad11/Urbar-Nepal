@extends('layouts.app')
@section('title', __('Task'))
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang( 'Task' )
            <small>@lang( 'Manage Task' )</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary', 'title' => __( 'All Task' )])
            @can('task.create')
                @slot('tool')
                    <div class="box-tools">
                        <a class="btn btn-block btn-primary"
                           href="{{action('TaskController@create')}}">
                            <i class="fa fa-plus"></i> @lang( 'messages.add' )</a>
                    </div>
                @endslot
            @endcan
            @if (auth()->user()->can('task.view') || auth()->user()->can('view_own_task'))
                <table class="table table-bordered table-striped" id="task_table">
                    <thead>
                    <tr>
                        <th>Assign To</th>
                        <th>Task Type</th>
                        <th>title</th>
                        <th>Description</th>
                        <th>Special Instruction</th>
                        <th>Location(start-end)</th>
                        <th>date(start-end)</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            @endcan
        @endcomponent

    </section>
    @can('task.update')
    @include('task.partial.update_status_modal')
    @endcan
    <!-- /.content -->
@stop
@section('javascript')
    <script type="text/javascript">
        @if(Session::has('success'))
        toastr.success("{{Session::get('success')}}")

        @endif

        @if(Session::has('delete'))
        toastr.info("{{Session::get('delete')}}")
        @endif

        @if(Session::has('Error'))
        toastr.error("{{Session::get('Error')}}")
        @endif
    </script>
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            task_table = $('#task_table').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "/task",
                    "data": function (d) {
                    }
                },
                columns: [
                    {data: 'assign to', name: 'assign to'},
                    {data: 'task_type', name: 'task_type'},
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'},
                    {data: 'special_instruction', name: 'special_instruction'},
                    {data: 'location', name: 'location'},
                    {data: 'date', name: 'date'},
                    {data: 'status', name: 'status',},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "fnDrawCallback": function (oSettings) {
                    __currency_convert_recursively($('#task_table'));
                }
            });
            $(document).on('click', 'button.delete_role_button', function () {
                swal({
                    title: LANG.sure,
                    text: LANG.confirm_delete_role,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var href = $(this).data('href');
                        var data = $(this).serialize();

                        $.ajax({
                            method: "DELETE",
                            url: href,
                            dataType: "json",
                            data: data,
                            success: function (result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    task_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });
            $('select#cg_location_id, select#cg_customer_group_id, #cg_date_range').change(function () {
                task_table.ajax.reload();
            });

            $(document).on('click', 'a.update_status', function(e) {
                e.preventDefault();
                var href = $(this).data('href');
                var status = $(this).data('status');
                $('#update_status_modal').modal('show');
                $('#update_status_form').attr('action', href);
                $('#update_status_form #update_status').val(status);
                $('#update_status_form #update_status').trigger('change');
            });

            $(document).on('submit', '#update_status_form', function(e) {
                e.preventDefault();
                $(this)
                    .find('button[type="submit"]')
                    .attr('disabled', true);
                var data = $(this).serialize();

                $.ajax({
                    method: 'post',
                    url: $(this).attr('action'),
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            $('div#update_status_modal').modal('hide');
                            toastr.success(result.msg);
                            task_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                        $('#update_status_form')
                            .find('button[type="submit"]')
                            .attr('disabled', false);
                    },
                });
            });
        })
    </script>
@endsection
@section('css')
    <style>
        td {
            text-transform:capitalize
        }
        th {
            text-transform:capitalize
        }
    </style>

@endsection
