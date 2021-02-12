<div class="pos-tab-content">
     <div class="row">
     <div class="col-sm-6">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('enable_delivery_status', 1, $business->enable_delivery_status , [ 'class' => 'input-icheck', 'id' => 'enable_delivery_status']); !!} {{ __( 'lang_v1.enable_delivery_status' ) }}
                </label>
              @show_tooltip(__('lang_v1.tooltip_enable_delivery_status'))
            </div>
        </div>
    </div>
    </div>
</div>