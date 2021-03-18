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
    @component('components.filters', ['title' => __('report.filters')])
            @include('task.partial.task_list_filters')
        @endcomponent
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
                <table class="table table-bordered table-striped ajax_view" id="task_table">
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th>@lang('purchase.business_location')</th>
                        <th>Assigned To</th>
                        <th>Task Type</th>
                        <th>Title</th>
                        <th>Task Status</th>
                        <th>Task Address</th>
                        <th>Task Started At</th>
                        <th>Task Ended At</th>
                        <th>Assigned_by</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            @endif
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

            $('#task_list_filter_date_range').daterangepicker(
              dateRangeSettings,
            function (start, end) {
                $('#task_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                task_table.ajax.reload();
            });
            $('#task_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#task_list_filter_date_range').val('');
                task_table.ajax.reload();
            });

            task_table = $('#task_table').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "/task",
                    "data": function (d) {
                        if($('#task_list_filter_date_range').val()) {
                        var start = $('#task_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        var end = $('#task_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        d.start_date = start;
                        d.end_date = end;
                    }
                        d.location_id = $('#location_id').val();
                        d.task_status = $('#task_list_filter_task_status').val();
                        d.task_type = $('#task_list_filter_task_type').val();
                        d.delivery_person_id = $('#delivery_person_id').val();
                        d.assigned_by = $('#assigned_by').val();
                    }
                },
                columns: [
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    {data: 'location_name', name: 'BS.name'},
                    {data: 'assigned_to', name: 'u.first_name'},
                    {data: 'task_type', name: 'task_type'},
                    {data: 'title', name: 'title'},
                    {data: 'task_status', name: 'task_status'},
                    {data: 'task_address', name: 'task_address'},
                    {data: 'started_at', name: 'started_at'},
                    {data: 'ended_at', name: 'ended_at'},
                    {data: 'assigned_by', name: 'u.first_name'},
                ],

                "fnDrawCallback": function (oSettings) {
                    __currency_convert_recursively($('#task_table'));
                },
                createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(6)').attr('class', 'clickable_td');
        }
            });

            $(document).on('change','#assigned_by,#task_list_filter_task_status,#task_list_filter_task_type',  function() {
             task_table.ajax.reload();
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

            $(document).on('click', 'a.update_task_status', function (e) {
                e.preventDefault();
                if($(this).data('status')=='completed'){
                    return;
                }
                var href = $(this).data('href');
                var status = $(this).data('status');
                $('#update_task_status_modal').modal('show');
                $('#update_task_status_form').attr('action', href);
                $('#update_task_status_form #update_status').val(status);
                $('#update_task_status_form #update_status').trigger('change');
            });

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
				var html = data.text;
				return html;
			},
			}).on('select2:select', function (e) {
                task_table.ajax.reload();

			});

    
            $('#delivery_person_id').select2({
            ajax: {
                url: '/user/get_delivery_people',
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
        }).on('select2:select', function (e) {
                task_table.ajax.reload();
			});



            $(document).on('submit', '#update_task_status_form', function (e) {
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
                            $('div#update_task_status_modal').modal('hide');
                            toastr.success(result.msg);
                            task_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                        $('#update_task_status_form')
                            .find('button[type="submit"]')
                            .attr('disabled', false);
                    },
                });
            });
        })
    </script>
    <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
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
