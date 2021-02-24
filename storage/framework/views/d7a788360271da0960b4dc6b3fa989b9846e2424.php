<div class="table-responsive">
    <table class="table table-bordered table-striped ajax_view" id="sell_return_table">
        <thead>
            <tr>
                <th><?php echo app('translator')->getFromJson('messages.date'); ?></th>
                <th><?php echo app('translator')->getFromJson('sale.invoice_no'); ?></th>
                <th><?php echo app('translator')->getFromJson('lang_v1.parent_sale'); ?></th>
                <th><?php echo app('translator')->getFromJson('sale.customer_name'); ?></th>
                <th><?php echo app('translator')->getFromJson('sale.location'); ?></th>
                <th><?php echo app('translator')->getFromJson('purchase.payment_status'); ?></th>
                <th><?php echo app('translator')->getFromJson('sale.total_amount'); ?></th>
                <th><?php echo app('translator')->getFromJson('purchase.payment_due'); ?></th>
                <th><?php echo app('translator')->getFromJson('messages.action'); ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 text-center footer-total">
                <td colspan="5"><strong><?php echo app('translator')->getFromJson('sale.total'); ?>:</strong></td>
                <td id="footer_payment_status_count_sr"></td>
                <td><span class="display_currency" id="footer_sell_return_total" data-currency_symbol ="true"></span></td>
                <td><span class="display_currency" id="footer_total_due_sr" data-currency_symbol ="true"></span></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/sell_return/partials/sell_return_list.blade.php ENDPATH**/ ?>