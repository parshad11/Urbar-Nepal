<div class="pos-tab-content">
     <div class="row">
     <div class="col-sm-6">
        <div class="form-group">
            <div class="checkbox">
                <label>
                <?php echo Form::checkbox('enable_delivery_status', 1, $business->enable_delivery_status , [ 'class' => 'input-icheck', 'id' => 'enable_delivery_status']);; ?> <?php echo e(__( 'lang_v1.enable_delivery_status' ), false); ?>

                </label>
              <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.tooltip_enable_delivery_status') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
            </div>
        </div>
    </div>
    </div>
</div><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/business/partials/settings_delivery.blade.php ENDPATH**/ ?>