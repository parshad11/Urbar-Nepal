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
        @component('components.widget', ['class' => 'box-primary', 'title' => 'All Delivery'])
            {{--@can('delivery.create')--}}
                {{--@slot('tool')--}}
                    {{--<div class="box-tools">--}}
                        {{--<a class="btn btn-block btn-primary"--}}
                           {{--href="{{action('TaskController@create')}}">--}}
                            {{--<i class="fa fa-plus"></i> @lang( 'messages.add' )</a>--}}
                    {{--</div>--}}
                {{--@endslot--}}
            {{--@endcan--}}
            @if (auth()->user()->can('task.view') || auth()->user()->can('view_own_task'))
                <table class="table table-bordered table-striped" id="delivery_table">
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th>delivery Person</th>
                        <th>delivery status</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>deliver to</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            @endcan
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
            delivery_table = $('#delivery_table').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "/delivery",
                    "data": function (d) {

                    }
                },
                columns: [
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    {data: 'delivery_person', name: 'delivery_person'},
                    {data: 'delivery_status', name: 'delivery_status'},
                    {data: 'delivery_started_at', name: 'delivery_started_at'},
                    {data: 'delivered_ended_at', name: 'delivered_ended_at'},
                    {data: 'delivered_to', name: 'delivered_to'},
                ],

                "fnDrawCallback": function (oSettings) {
                    __currency_convert_recursively($('#delivery_table'));
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
                                    delivery_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
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
