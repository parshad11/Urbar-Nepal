@extends('layouts.app')
@section('title', __( 'delivery.deliveries'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header no-print">
        <h1>@lang( 'delivery.deliveries' )
            <small>@lang( 'delivery.manage_deliveries')</small>
        </h1>
</section>

<!-- Main content -->
<section class="content no-print">
    @component('components.filters', ['title' => __('report.filters')])
        @include('delivery.partials.transaction_list_filters')
    @endcomponent
    @component('components.widget', ['class' => 'box-primary', 'title' => __( 'lang_v1.all_transactions')])
        @if(auth()->user()->can('purchase.view') ||  auth()->user()->can('view_own_purchase') ||auth()->user()->can('direct_sell.access')||auth()->user()->can('sell.view')||auth()->user()->can('view_own_sell_only'))
            <table class="table table-bordered table-striped ajax_view" id="delivery_assign_table">
                <thead>
                    <tr>
                        <th>@lang('messages.action')</th>
                        <th>@lang('lang_v1.type')</th>
                        <th>@lang('messages.date')</th>
                        <th>@lang('sale.invoice_no')</th>
                        <th>@lang('sale.location')</th>   
                        <th>@lang('lang_v1.added_by')</th>
                        <th>@lang('lang_v1.assign_status')</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                
            </table>
        @endif
    @endcomponent
</section>

<!-- This will be printed -->
<!-- <section class="invoice print_section" id="receipt_section">
</section> -->

@stop

@section('javascript')
<script type="text/javascript">
$(document).ready( function(){
    //Date range as a button
    $('#transaction_list_filter_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#transaction_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            delivery_assign_table.ajax.reload();
        }
    );
    $('#transaction_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#transaction_list_filter_date_range').val('');
        delivery_assign_table.ajax.reload();
    });

    delivery_assign_table = $('#delivery_assign_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[1, 'desc']],
        "ajax": {
            "url": "/delivery/create",
            "data": function ( d ) {
                if($('#transaction_list_filter_date_range').val()) {
                    var start = $('#transaction_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    var end = $('#transaction_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    d.start_date = start;
                    d.end_date = end;
                }
               

                d.location_id = $('#transaction_list_filter_location_id').val();
                d.assign_status = $('#transaction_list_filter_assign_status').val();
                d.created_by = $('#created_by').val();
                
               

                d = __datatable_ajax_callback(d);
            }
        },
        columns: [
            { data: 'action', name: 'action', orderable: false, "searchable": false},
            { data: 'type', name: 'type'  },
            { data: 'transaction_date', name: 'transaction_date'  },
            { data: 'business_location', name: 'bl.name'},
            { data: 'invoice_no', name: 'invoice_no'},
            { data: 'added_by', name: 'u.first_name'},
            { data: 'assign_status', name: 'u.first_name'},
           
        ],
        "fnDrawCallback": function (oSettings) {
            __currency_convert_recursively($('#delivery_assign_table'));
        },
        createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(6)').attr('class', 'clickable_td');
        }
    });

    $(document).on('change', '#transaction_list_filter_location_id, #created_by,#transaction_list_filter_assign_status',  function() {
        delivery_assign_table.ajax.reload();
    });

});
</script>
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@endsection
