<?php $__env->startSection('title',  __('delivery.edit_task')); ?>

<?php $__env->startSection('content'); ?>
    <style type="text/css">


    </style>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo app('translator')->getFromJson('delivery.edit_task'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php echo $__env->make('layouts.partials.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo Form::open(['url' => action('TaskController@update',$task->id), 'method' => 'put', 'id' => 'add_task_form' ]); ?>

        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

                            <?php echo Form::select('location_id',$business_locations, $task->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]);; ?>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-4 ">
                        <div class="form-group">
                            <?php echo Form::label('delivery_person_id', __('delivery.assign_task_to') . ':*'); ?>

                            <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                                <?php echo Form::select('delivery_person_id',[$task->delivery_person_id=>$task->delivery_person->user->user_name],$task->delivery_person_id, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'delivery_person_id']);; ?>

                                <span class="input-group-btn">

                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 ">
                        <div class="form-group">
                            <?php echo Form::label('task_type', __('delivery.task_type') . ':*'); ?>

                            <?php echo Form::select('task_type', $taskTypes, $task->task_type, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']);; ?>

                        </div>
                    </div>
                    <div class="col-sm-4 ">
                        <div class="form-group">
                            <?php echo Form::label('task_status', __('delivery.task_status') . ':*'); ?>

                            <?php echo Form::select('task_status', $taskStatuses, $task->task_status, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']);; ?>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-4 ">
                        <div class="form-group">
                            <?php echo Form::label('title', __('delivery.task_title').':*'); ?>

                            <?php echo Form::text('title', $task->title, ['class' => 'form-control']);; ?>

                        </div>
                    </div>
                    <div class="col-sm-4 ">
                        <div class="form-group">
                            <?php echo Form::label('description', __('delivery.description').':'); ?>

                            <?php echo Form::text('description', $task->description, ['class' => 'form-control']);; ?>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-4 ">
                        <div class="form-group">
                            <?php echo Form::label('special_instructions', __('delivery.special_instructions') . ':'); ?>

                            <?php echo Form::textarea('special_instructions', $task->special_instructions, ['class' => 'form-control','rows'=>3]);; ?>

                        </div>
                    </div>

                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 " style="display: flex;justify-content: space-between;">
                        <div class="col-sm-4 ">
                            <div class="form-group">
                                <?php echo Form::label('task_address', __('delivery.task_address').':*'); ?>

                                <?php echo Form::text('task_address', $task->task_address, ['class' => 'form-control','id'=>'task_address']);; ?>

                            </div>

                            <div class="form-group">
                                <p>Please open this link to choose pickup location's latitude and longitude: <a
                                            href="https://www.mapcoordinates.net/en" target="_blank">https://www.mapcoordinates.net/en </a>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-4 ">
                            <div class="form-group">
                                <?php echo Form::label('task_latitude', __('delivery.latitude').':*'); ?>

                                <?php echo Form::text('task_latitude', $task->task_latitude, ['class' => 'form-control']);; ?>

                            </div>
                            <div class="form-group">
                                <?php echo Form::label('task_longitude', __('delivery.longitude').':*'); ?>

                                <?php echo Form::text('task_longitude', $task->task_longitude, ['class' => 'form-control']);; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary pull-right"><?php echo app('translator')->getFromJson('messages.save'); ?></button>
                    </div>
                </div>
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
            $('#delivery_person_id').select2({
                ajax: {
                    url: '/delivery_users',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                        };
                    },
                    processResults: function (data) {
                        console.log(data);
                        return {
                            results: data,
                        };
                    },
                },
                minimumInputLength: 1,
                escapeMarkup: function (m) {
                    return m;
                },

                templateResult: function (data) {
                    if (!data.id) {
                        return data.text;
                    }
                    var html = data.text;
                    return html;
                },
            })
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/task/edit.blade.php ENDPATH**/ ?>