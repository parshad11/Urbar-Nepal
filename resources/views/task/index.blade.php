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
                        <th>Action</th>
                        <th>@lang('purchase.business_location')</th>
                        <th>Assigned To</th>
                        <th>Task Type</th>
                        <th>Title</th>
                        <th>Task Status</th>
                        <th>Task Address</th>
                        <th>Assigned_by</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            @endcan
        @endcomponent

    </section>
    @can('task.update')
        @include('task.partial.update_task_status_modal')
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
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    {data: 'location_name', name: 'BS.name'},
                    {data: 'assign_to', name: 'u.first_name'},
                    {data: 'task_type', name: 'task_type'},
                    {data: 'title', name: 'title'},
                    {data: 'task_status', name: 'task_status'},
                    {data: 'task_address', name: 'task_address'},
                    {data: 'assigned_by', name: 'u.first_name'},
                ],

                "fnDrawCallback": function (oSettings) {
                    __currency_convert_recursively($('#task_table'));
                }
            });
            $(document).on('click', 'a.delete-task', function (e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    text: LANG.confirm_delete_task,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var href = $(this).attr('href');
                        var data = $(this).serialize();

                        $.ajax({
                            method: "DELETE",
                            url: href,
                            dataType: "json",
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

            $(document).on('click', 'a.update_status', function (e) {
                e.preventDefault();
                var href = $(this).data('href');
                var status = $(this).data('status');
                $('#update_status_modal').modal('show');
                $('#update_status_form').attr('action', href);
                $('#update_status_form #update_status').val(status);
                $('#update_status_form #update_status').trigger('change');
            });


            $(document).on('submit', '#update_status_form', function (e) {
                e.preventDefault();
                $(this)
                    .find('button[type="submit"]')
                    .attr('disabled', true);
                var data = $(this).serialize();

                $.ajax({
                    method: 'put',
                    url: $(this).attr('action'),
                    dataType: 'json',
                    data:data,
                    success: function (result) {
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
            text-transform: capitalize
        }

        th {
            text-transform: capitalize
        }
    </style>

@endsection