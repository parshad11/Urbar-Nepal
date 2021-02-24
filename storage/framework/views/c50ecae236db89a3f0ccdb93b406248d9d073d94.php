<div class="table-responsive">
    <table class="table table-bordered table-striped ajax_view" id="purchase_table">
        <thead>
            <tr>
                <th><?php echo app('translator')->getFromJson('messages.action'); ?></th>
                <th><?php echo app('translator')->getFromJson('messages.date'); ?></th>
                <th><?php echo app('translator')->getFromJson('purchase.ref_no'); ?></th>
                <th><?php echo app('translator')->getFromJson('purchase.location'); ?></th>
                <th><?php echo app('translator')->getFromJson('purchase.supplier'); ?></th>
                <th><?php echo app('translator')->getFromJson('purchase.purchase_status'); ?></th>
                <th><?php echo app('translator')->getFromJson('purchase.payment_status'); ?></th>
                <th><?php echo app('translator')->getFromJson('purchase.grand_total'); ?></th>
                <th><?php echo app('translator')->getFromJson('purchase.payment_due'); ?> &nbsp;&nbsp;<i class="fa fa-info-circle text-info no-print" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="<?php echo e(__('messages.purchase_due_tooltip'), false); ?>" aria-hidden="true"></i></th>
                <th><?php echo app('translator')->getFromJson('lang_v1.added_by'); ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 text-center footer-total">
                <td colspan="5"><strong><?php echo app('translator')->getFromJson('sale.total'); ?>:</strong></td>
                <td id="footer_status_count"></td>
                <td id="footer_payment_status_count"></td>
                <td><span class="display_currency" id="footer_purchase_total" data-currency_symbol ="true"></span></td>
                <td class="text-left"><small><?php echo app('translator')->getFromJson('report.purchase_due'); ?> - <span class="display_currency" id="footer_total_due" data-currency_symbol ="true"></span><br>
                <?php echo app('translator')->getFromJson('lang_v1.purchase_return'); ?> - <span class="display_currency" id="footer_total_purchase_return_due" data-currency_symbol ="true"></span>
                </small></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/purchase/partials/purchase_table.blade.php ENDPATH**/ ?>