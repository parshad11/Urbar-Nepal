<?php if(empty($only) || in_array('transaction_list_filter_location_id', $only)): ?>
<div class="col-md-3">
    <div class="form-group">
        <?php echo Form::label('transaction_list_filter_location_id',  __('purchase.business_location') . ':'); ?>


        <?php echo Form::select('transaction_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]);; ?>

    </div>
</div>
<?php endif; ?>
<?php if(empty($only) || in_array('transaction_list_filter_customer_id', $only)): ?>
<div class="col-md-3">
    <div class="form-group">
        <?php echo Form::label('transaction_list_filter_customer_id',  __('contact.customer') . ':'); ?>

        <?php echo Form::select('transaction_list_filter_customer_id', $customers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]);; ?>

    </div>
</div>
<?php endif; ?>
<?php if(empty($only) || in_array('transaction_list_filter_assign_status', $only)): ?>
<div class="col-md-3">
    <div class="form-group">
        <?php echo Form::label('transaction_list_filter_assign_status',  __('delivery.assign_status') . ':'); ?>

        <?php echo Form::select('transaction_list_filter_assign_status', $assignStatuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]);; ?>

    </div>
</div>
<?php endif; ?>
<?php if(empty($only) || in_array('transaction_list_filter_date_range', $only)): ?>
<div class="col-md-3">
    <div class="form-group">
        <?php echo Form::label('transaction_list_filter_date_range', __('report.date_range') . ':'); ?>

        <?php echo Form::text('transaction_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']);; ?>

    </div>
</div>
<?php endif; ?>
<?php if((empty($only) || in_array('created_by', $only)) && !empty($sales_representative)): ?>
<div class="col-md-3">
    <div class="form-group">
        <?php echo Form::label('created_by',  __('report.user') . ':'); ?>

        <?php echo Form::select('created_by', $sales_representative, null, ['class' => 'form-control select2', 'style' => 'width:100%']);; ?>

    </div>
</div>
<?php endif; ?>
<?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/delivery/partials/transaction_list_filters.blade.php ENDPATH**/ ?>