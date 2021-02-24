<?php $__env->startSection('title', __('contact.supplier_record')); ?>
<?php $__env->startSection('content'); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo app('translator')->getFromJson( 'contact.supplier_record' ); ?>
            <small><?php echo app('translator')->getFromJson( 'contact.manage_supplier_record' ); ?></small>
        </h1>
        <?php echo Form::open(['url' => action('RecordController@index'), 'method' => 'get', 'id' => 'record_form' ]); ?>

        <div class="row no-print">
            <div class="col-md-3 col-md-offset-9 col-xs-6 ">
                <div class="input-group">
                    <span class="input-group-addon bg-light-blue"><i class="fa fa-map-marker"></i></span>
                    <?php echo Form::text('location', '', ['placeholder' => __('Enter Location'), 'class' => 'form-control location','id' => 'location']);; ?>

                    
                </div>

            </div>
        </div>
        <br>
        <div class="row no-print">
            <div class="col-xs-12">
                <div class="form-group pull-right">
                    <div class="">
                        <div class="form-group">
                            <?php echo Form::label('cg_date_range', __('Date Range') . ':'); ?>

                            <?php echo Form::text('date_range', '', ['placeholder' => __('select a date range'), 'class' => 'form-control', 'id' => 'cg_date_range', 'readonly']);; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </section>

    <!-- Main content -->
    <section class="content">
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'All Supplier Record' )]); ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('record.create')): ?>
                <?php $__env->slot('tool'); ?>
                    <div class="box-tools">
                        <a class="btn btn-block btn-primary"
                           href="<?php echo e(action('RecordController@create'), false); ?>">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->getFromJson( 'messages.add' ); ?></a>
                    </div>
                <?php $__env->endSlot(); ?>
            <?php endif; ?>
            <?php if(auth()->user()->can('record.view') || auth()->user()->can('record.view_own')): ?>
                <table class="table table-bordered table-striped" id="record_table">
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th><?php echo app('translator')->getFromJson('purchase.business_location'); ?></th>
                        <th><?php echo app('translator')->getFromJson('purchase.supplier'); ?></th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Expected Collection Date</th>
                        <th>Supplier Location</th>
                        <th><?php echo app('translator')->getFromJson('lang_v1.added_by'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php echo $__env->renderComponent(); ?>

    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        <?php if(Session::has('success')): ?>
        toastr.success("<?php echo e(Session::get('success'), false); ?>")

        <?php endif; ?>

        <?php if(Session::has('delete')): ?>
        toastr.info("<?php echo e(Session::get('delete'), false); ?>")
        <?php endif; ?>

        <?php if(Session::has('Error')): ?>
        toastr.error("<?php echo e(Session::get('Error'), false); ?>")
        <?php endif; ?>
    </script>
    <script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/record/index.blade.php ENDPATH**/ ?>