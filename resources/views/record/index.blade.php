@extends('layouts.app')
@section('title', __('contact.supplier_record'))
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang( 'contact.supplier_record' )
            <small>@lang( 'contact.manage_supplier_record' )</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @component('components.filters', ['title' => __('report.filters')])
                @include('record.partial.record_list_filters')
        @endcomponent
        @component('components.widget', ['class' => 'box-primary', 'title' => __( 'All Supplier Record' )])
            @can('record.create')
                @slot('tool')
                    <div class="box-tools">
                        <a class="btn btn-block btn-primary"
                           href="{{action('RecordController@create')}}">
                            <i class="fa fa-plus"></i> @lang( 'messages.add' )</a>
                    </div>
                @endslot
            @endcan
            @if (auth()->user()->can('record.view') || auth()->user()->can('record.view_own'))
                <table class="table table-bordered table-striped" id="record_table">
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th>@lang('purchase.business_location')</th>
                        <th>@lang('purchase.supplier')</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Expected Collection Date</th>
                        <th>Supplier Location</th>
                        <th>@lang('lang_v1.added_by')</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            @endif
        @endcomponent

    </section>
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
            $('#record_list_filter_date_range').daterangepicker(
              dateRangeSettings,
            function (start, end) {
                $('#record_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                record_table.ajax.reload();
            });
            $('#record_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#record_list_filter_date_range').val('');
                record_table.ajax.reload();
            });

            record_table = $('#record_table').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "/records",
                    "data": function (d) {
                        if($('#record_list_filter_date_range').val()) {
                        var start = $('#record_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        var end = $('#record_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        d.start_date = start;
                        d.end_date = end;
                    }
                        d.location_id = $('#location_id').val();
                        d.supplier_id = $('#supplier_id').val();
                        d.added_by = $('#user_id').val();
                

                       d = __datatable_ajax_callback(d);
                    }
                },
                columns: [
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    {data: 'location_name', name: 'BS.name'},
                    {data: 'name', name: 'contacts.name'},       
                    {data: 'item', name: 'item'},       
                    {data: 'quantity', name: 'quantity'},
                    {data: 'unit', name: 'units.actual_name',orderable: false},
                    {data: 'expected_collection_date', name: 'expected_collection_date'},
                    {data: 'location', name: 'location'},  
                    {data: 'added_by', name: 'u.first_name'},
                   
                ],
                "fnDrawCallback": function (oSettings) {
                    __currency_convert_recursively($('#record_table'));
                }
            });
            $(document).on('click', 'a.delete-record', function (e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    text: LANG.confirm_delete_record,
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
                                    record_table.ajax.reload();
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
               record_table.ajax.reload();

			});

            $('#user_id').select2({
			ajax: {
				url: '/user/getstaff',
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
               record_table.ajax.reload();

			});


            $('#supplier_id').select2({
        ajax: {
            url: '/purchases/get_suppliers',
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
            var html = data.text + ' - ' + data.business_name + ' (' + data.contact_id + ')';
            return html;
        },
     }).on('select2:select', function (e) {
        record_table.ajax.reload();
     });

    });
    </script>
@endsection
