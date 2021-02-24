<?php $__env->startSection('title',  __('contact.add_new_supplier_record')); ?>

<?php $__env->startSection('content'); ?>
    <style type="text/css">


    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo app('translator')->getFromJson('contact.add_new_supplier_record'); ?></h1>
        <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php echo $__env->make('layouts.partials.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo Form::open(['url' => action('RecordController@store'), 'method' => 'post', 'id' => 'add_supplier_record_form' ]); ?>

        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="box-body">
                <div class="row">
                    <?php if(count($business_locations) == 1): ?>
                        <?php
                            $default_location = current(array_keys($business_locations->toArray()));
                        ?>
                    <?php else: ?>
                        <?php
                            $default_location = null;
                        ?>
                    <?php endif; ?>
                    <div class="col-sm-4">
                    <div class="form-group">
                        <?php echo Form::label('business_location_id', __('purchase.business_location').':*'); ?>

                        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('tooltip.supplier_record_location') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
                        <?php echo Form::select('business_location_id',[], $default_location, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required'], $bl_attributes);; ?>

                    </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('supplier_id', __('purchase.supplier') . ':*'); ?>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <?php echo Form::select('contact_id',[], null, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'supplier_id']);; ?>

                                <span class="input-group-btn">
                                <button type="button" class="btn btn-default bg-white btn-flat add_new_supplier"
                                        data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('item', __('contact.item_name').':*'); ?>

                            <?php echo Form::text('item', null, ['class' => 'form-control']);; ?>

                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('quantity', __('contact.quantity').':*'); ?>

                            <?php echo Form::text('quantity', null, ['class' => 'form-control']);; ?>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('unit_id', __('product.unit') . ':*'); ?>

                            <div class="input-group">
                                <?php echo Form::select('unit_id', $units,session('business.default_unit'), ['class' => 'form-control select2', 'required']);; ?>

                                <span class="input-group-btn">
                            <button type="button" <?php if(!auth()->user()->can('unit.create')): ?> disabled
                                    <?php endif; ?> class="btn btn-default bg-white btn-flat btn-modal"
                                    data-href="<?php echo e(action('UnitController@create', ['quick_add' => true]), false); ?>"
                                    title="<?php echo app('translator')->getFromJson('unit.add_unit'); ?>" data-container=".view_modal"><i
                                        class="fa fa-plus-circle text-primary fa-lg"></i></button>
                        </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('date', __('contact.expected_date') . ':*'); ?>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <?php echo Form::text('expected_collection_date', null, ['class' => 'form-control','id'=>'datetimepicker', 'required']);; ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('supplier_location', __('contact.supplier_location') . ':*'); ?>

                            <?php echo Form::text('location', null, ['class' => 'form-control','id'=>'supplier_location']);; ?>

                        </div>
                    </div>


                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary pull-right"><?php echo app('translator')->getFromJson('messages.save'); ?></button>
                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
        <?php echo Form::close(); ?>


    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/purchase.js?v=' . $asset_v), false); ?>"></script>
    <script src="<?php echo e(asset('js/product.js?v=' . $asset_v), false); ?>"></script>
    <script>
        $(document).ready(function (e) {
            $('#datetimepicker').datepicker({
                useCurrent: false,
                minDate: moment()
             });

             $('#business_location_id').select2({
			ajax: {
				url: '/business/get_locations',
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return {
						q: params.term, // search term
						page: params.page,
					};
				},
				processResults: function(data) {
					return {
						results: data,
					};
				},
			},
			minimumInputLength: 1,
			escapeMarkup: function(m) {
				return m;
			},
			templateResult: function(data) {
				if (!data.id) {
					return data.text;
				}
				var html = data.text;
				return html;
			},
			}).on('select2:select', function (e) {
				var data = e.params.data;
			});

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/record/create.blade.php ENDPATH**/ ?>