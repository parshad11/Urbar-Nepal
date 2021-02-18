@extends('layouts.app')
@section('title', __('contact.supplier_record'))
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang( 'contact.supplier_record' )
            <small>@lang( 'contact.manage_supplier_record' )</small>
        </h1>
        {!! Form::open(['url' => action('RecordController@index'), 'method' => 'get', 'id' => 'cg_report_filter_form' ]) !!}
        <div class="row no-print">
            <div class="col-md-3 col-md-offset-9 col-xs-6 ">
                <div class="input-group">
                    <span class="input-group-addon bg-light-blue"><i class="fa fa-map-marker"></i></span>
                    {!! Form::text('location', '', ['placeholder' => __('Enter Location'), 'class' => 'form-control location','id' => 'location']); !!}
                    {{--<input type="text" name="location" placeholder="Enter Location" class="form-control" id="location">--}}
                </div>

            </div>
        </div>
        <br>
        <div class="row no-print">
            <div class="col-xs-12">
                <div class="form-group pull-right">
                    <div class="">
                        <div class="form-group">
                            {!! Form::label('cg_date_range', __('Date Range') . ':') !!}
                            {!! Form::text('date_range', '', ['placeholder' => __('select a date range'), 'class' => 'form-control', 'id' => 'cg_date_range', 'readonly']); !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>

    <!-- Main content -->
    <section class="content">
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
            if ($('#cg_date_range').length == 1) {
                $('#cg_date_range').daterangepicker(
                    dateRangeSettings,
                    function (start, end) {
                        $('#cg_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                        record_table.ajax.reload();
                    }
                );

                $('#cg_date_range').on('cancel.daterangepicker', function (ev, picker) {
                    $(this).val('');
                    record_table.ajax.reload();
                });
            }
            $(document).ready(function () {
                $("#location").keyup(function () {
                    record_table.ajax.reload();
                });
            });
            record_table = $('#record_table').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "/records",
                    "data": function (d) {
                        d.start_date = $('#cg_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        d.end_date = $('#cg_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        d.location = $('#location').val();
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
            $('select#cg_location_id, select#cg_customer_group_id, #cg_date_range').change(function () {
                record_table.ajax.reload();
            });
        })
    </script>
@endsection
