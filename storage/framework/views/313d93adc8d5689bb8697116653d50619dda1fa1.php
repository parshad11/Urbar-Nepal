<?php $__empty_1 = true; $__currentLoopData = $line_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	<div class="col-md-3 col-xs-6 line_order_div">
		<div class="small-box bg-gray">
            <div class="inner">
            	<h4 class="text-center">#<?php echo e($order->invoice_no, false); ?></h4>
            	<table class="table no-margin no-border table-slim">
            		<tr><th><?php echo app('translator')->getFromJson('restaurant.placed_at'); ?></th><td><?php echo e(\Carbon::createFromTimestamp(strtotime($order->created_at))->format(session('business.date_format')), false); ?> <?php echo e(\Carbon::createFromTimestamp(strtotime($order->created_at))->format('H:i'), false); ?></td></tr>
            		<tr><th><?php echo app('translator')->getFromJson('restaurant.order_status'); ?></th><td><span class="label <?php if($order->res_order_status == 'cooked' ): ?> bg-red <?php elseif($order->res_order_status == 'served'): ?> bg-green <?php else: ?> bg-light-blue <?php endif; ?>"><?php echo app('translator')->getFromJson('restaurant.order_statuses.' . $order->res_line_order_status); ?> </span></td></tr>
            		<tr><th><?php echo app('translator')->getFromJson('contact.customer'); ?></th><td><?php echo e($order->customer_name, false); ?></td></tr>
            		<tr><th><?php echo app('translator')->getFromJson('restaurant.table'); ?></th><td><?php echo e($order->table_name, false); ?></td></tr>
            		<tr><th><?php echo app('translator')->getFromJson('sale.location'); ?></th><td><?php echo e($order->business_location, false); ?></td></tr>
                        <tr><th><?php echo app('translator')->getFromJson('sale.product'); ?></th><td><?php echo e($order->product_name, false); ?> <?php if($order->product_type == 'variable'): ?> - <?php echo e($order->product_variation_name, false); ?> - <?php echo e($order->variation_name, false); ?>  <?php endif; ?></td></tr>
                        <tr><th><?php echo app('translator')->getFromJson('lang_v1.quantity'); ?></th><td><?php echo e($order->quantity, false); ?><?php echo e($order->unit, false); ?></td></tr>
            	</table>
            </div>
            <?php if($orders_for == 'kitchen'): ?>
            	<a href="#" class="btn btn-flat small-box-footer bg-yellow mark_as_cooked_btn" data-href="<?php echo e(action('Restaurant\KitchenController@markAsCooked', [$order->id]), false); ?>"><i class="fa fa-check-square-o"></i> <?php echo app('translator')->getFromJson('restaurant.mark_as_cooked'); ?></a>
            <?php elseif($orders_for == 'waiter' && $order->res_order_status != 'served'): ?>
            	<a href="<?php echo e(action('Restaurant\OrderController@markLineOrderAsServed', [$order->id]), false); ?>" class="btn btn-flat small-box-footer bg-yellow mark_line_order_as_served"><i class="fa fa-check-square-o"></i> <?php echo app('translator')->getFromJson('restaurant.mark_as_served'); ?></a>
            <?php else: ?>
            	<div class="small-box-footer bg-gray">&nbsp;</div>
            <?php endif; ?>
         </div>
	</div>
	<?php if($loop->iteration % 4 == 0): ?>
		<div class="hidden-xs">
			<div class="clearfix"></div>
		</div>
	<?php endif; ?>
	<?php if($loop->iteration % 2 == 0): ?>
		<div class="visible-xs">
			<div class="clearfix"></div>
		</div>
	<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<div class="col-md-12">
	<h4 class="text-center"><?php echo app('translator')->getFromJson('restaurant.no_orders_found'); ?></h4>
</div>
<?php endif; ?><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/restaurant/partials/line_orders.blade.php ENDPATH**/ ?>