@extends('layouts.app')
@section('title','Delivery')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Delivery
            <small>Manage Delivery</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @component('components.filters', ['title' => __('report.filters')])
            @include('delivery.partials.delivery_list_filters')
        @endcomponent
        @component('components.widget', ['class' => 'box-primary', 'title' => 'All Delivery'])
            @if (auth()->user()->can('delivery.view') || auth()->user()->can('view_own_delivery'))
                <table class="table table-bordered table-striped" id="delivery_table">
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th>Transaction Type</th>
                        <th>Delivery Person</th>
                        <th>Delivery Status</th>
                        <th>Shipping  Address</th>
                        <th>Pickup Address</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Delivered to</th>
                        <th>Assigned By</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            @endcan
        @endcomponent

    </section>

    @can('delivery.update')
        @include('delivery.partials.update_delivery_status_modal')
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
            $('#delivery_list_filter_date_range').daterangepicker(
              dateRangeSettings,
            function (start, end) {
                $('#delivery_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                delivery_table.ajax.reload();
            });
            $('#delivery_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#delivery_list_filter_date_range').val('');
                delivery_table.ajax.reload();
            });


            delivery_table = $('#delivery_table').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "/delivery",
                    "data": function (d) {
                        if($('#delivery_list_filter_date_range').val()) {
                        var start = $('#delivery_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        var end = $('#delivery_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        d.start_date = start;
                        d.end_date = end;
                    }
                        d.location_id = $('#location_id').val();
                        d.delivery_status = $('#delivery_list_filter_delivery_status').val();
                        d.delivery_person_id = $('#delivery_person_id').val();
                        d.assigned_by = $('#assigned_by').val();
                
               

                       d = __datatable_ajax_callback(d);
                    }
                },
                columns: [
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    {data: 'type', name: 'transactions.type'},
                    {data: 'delivery_person', name: 'r.first_name'},
                    {data: 'delivery_status', name: 'delivery_status'},
                    {data: 'shipping_address', name: 'shipping_address'},
                    {data: 'pickup_address', name: 'pickup_address'},
                    {data: 'delivery_started_at', name: 'delivery_started_at'},
                    {data: 'delivery_ended_at', name: 'delivered_ended_at'},
                    {data: 'delivered_to', name: 'delivered_to'},
                    {data: 'assigned_by', name:  'u.first_name'},
                ],

                "fnDrawCallback": function (oSettings) {
                    __currency_convert_recursively($('#delivery_table'));
                },
                createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(6)').attr('class', 'clickable_td');
        }
            });
          
            $(document).on('change','#assigned_by,#delivery_list_filter_delivery_status',  function() {
             delivery_table.ajax.reload();
            });

            $(document).on('click', 'a.delete-delivery', function (e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    text: LANG.confirm_delete_delivery,
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
                                    delivery_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
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
                delivery_table.ajax.reload();

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
                delivery_table.ajax.reload();
			});

            $(document).on('click', 'a.update_status', function (e) {
                e.preventDefault();
                if($(this).data('status')=='delivered'){
                    return;
                }
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
                            delivery_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                        $('#update_status_form')
                            .find('button[type="submit"]')
                            .attr('disabled', false);
                    },
                });
            });

    });
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
