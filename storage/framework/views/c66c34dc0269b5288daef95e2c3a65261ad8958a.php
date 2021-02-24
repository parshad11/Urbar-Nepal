<?php $__env->startSection('title',  __('printer.add_printer')); ?>

<?php $__env->startSection('content'); ?>
    <style type="text/css">


    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo app('translator')->getFromJson('contact.edit_supplier_record'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php echo Form::open(['url' => action('RecordController@update',$record->id), 'method' => 'PUT', 'id' => 'add_supplier_record_form' ]); ?>

        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-4">
                    <div class="form-group">
                        <?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

                        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('tooltip.supplier_record_location') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
                        <?php echo Form::select('location_id',$business_locations, $record->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'),  'disabled']);; ?>

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
                                <?php echo Form::select('contact_id',[$record->contact_id=> $record->contact->name], $record->contact_id, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'disabled']);; ?>

                                <span class="input-group-btn">
                                <button type="button" class="btn btn-default bg-white btn-flat add_new_supplier" data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                                </span>
                            </div>
                        </div>
                        </div>
                  
                    <div class="col-sm-4">
                        <div class="form-group">
                        <?php echo Form::label('item', __('contact.item_name').':*'); ?>

                        <?php echo Form::text('item', $record->item, ['class' => 'form-control']);; ?>

                        </div>
                    </div>

                    <div class="col-sm-4">             
                        <div class="form-group">
                        <?php echo Form::label('quantity', __('contact.quantity').':*'); ?>

                        <?php echo Form::text('quantity',$record->quantity, ['class' => 'form-control']);; ?>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-sm-4">
                    <div class="form-group">
                        <?php echo Form::label('unit_id', __('product.unit') . ':*'); ?>

                        <div class="input-group">
                        <?php echo Form::select('unit_id', $units,$record->unit_id, ['class' => 'form-control select2', 'required']);; ?>

                        <span class="input-group-btn">
                            <button type="button" <?php if(!auth()->user()->can('unit.create')): ?> disabled <?php endif; ?> class="btn btn-default bg-white btn-flat btn-modal" data-href="<?php echo e(action('UnitController@create', ['quick_add' => true]), false); ?>" title="<?php echo app('translator')->getFromJson('unit.add_unit'); ?>" data-container=".view_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
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
                                <?php echo Form::text('expected_collection_date',\Carbon::createFromTimestamp(strtotime($record->expected_collection_date))->format(session('business.date_format')), ['class' => 'form-control','id'=>'datetimepicker', 'required']);; ?>

                            </div>  
                        </div>
                    </div>    

                    <div class="col-sm-4">
                        <div class="form-group">
                        <?php echo Form::label('supplier_location', __('contact.supplier_location') . ':*'); ?>

						<?php echo Form::text('location', $record->location, ['class' => 'form-control','id'=>'supplier_location']);; ?>

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
    <script>
        $(document).ready(function (e) {

            $('#datetimepicker').datepicker({
                useCurrent: false,
                minDate: moment()
             });
            
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/record/edit.blade.php ENDPATH**/ ?>