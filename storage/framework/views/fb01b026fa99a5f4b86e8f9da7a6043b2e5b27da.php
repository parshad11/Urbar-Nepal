<?php $__env->startSection('title', __('lang_v1.supplier_calendar')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->getFromJson( 'lang_v1.supplier_calendar' ); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-3">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="row">
                        <?php if(!empty($supplier)): ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php echo Form::label('supplier_id', __('Supplier') . ':'); ?>

                                    <?php echo Form::select('supplier_id', $supplier, null, ['class' => 'form-control select2', 'placeholder' => __('messages.see_all')]);; ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('location_id', __('sale.location') . ':'); ?>

                                <?php echo Form::select('location_id', $all_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.see_all')]);; ?>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <?php if(Module::has('Essentials')): ?>
                        <div class="col-md-12">
                            <button class="btn btn-block btn-success btn-modal" 
                                data-href="<?php echo e(action('\Modules\Essentials\Http\Controllers\ToDoController@create'), false); ?>?from_calendar=true" 
                                data-container="#task_modal">
                                <i class="fa fa-plus"></i> <?php echo app('translator')->getFromJson( 'essentials::lang.add_to_do' ); ?></a>
                            </button>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    
    <script type="text/javascript">
        $(document).ready(function(){
            var events = [];
            $.each($("input[name='events']:checked"), function(){
                events.push($(this).val());
            });
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next,today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                contentHeight: 'auto',
                eventLimit: 2,
                eventSources: [
                    {
                        url: '/calendar', 
                        type: 'get',
                        data: {
                            events: events
                        }
                         
                    }
                ] ,
                eventRender: function (event, element) {
                    if (event.title_html) {
                        element.find('.fc-title').html(event.title_html);
                    }
                    if (event.event_url) {
                        element.attr('href', event.event_url);
                    }
                }
            });
        });

        $(document).on('change', '#supplier_id, #location_id', function(){
            console.log('success');
            reload_calendar();
        });

        $(document).on('ifChanged', '.event_check', function(){
            reload_calendar();
        }) 

        function reload_calendar(){
            data = [];
            if($('select#location_id').length) {
                data.location_id = $('select#location_id').val();
            }
            if($('select#supplier_id').length) {
                data.supplier_id = $('select#supplier_id').val();
            }

            var events = [];
            $.each($("input[name='events']:checked"), function(){
                events.push($(this).val());
            });

            data.events = events;

            var events_source = {
                url: '/calendar',
                type: 'get',
                data: data
            }
            $('#calendar').fullCalendar( 'removeEventSource', events_source);
            $('#calendar').fullCalendar( 'addEventSource', events_source);
        }
    </script>
    <?php if(Module::has('Essentials')): ?>
        <div class="modal fade" id="task_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
        </div>
        <?php echo $__env->make('essentials::todo.todo_javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/home/calendar.blade.php ENDPATH**/ ?>