<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalTitle">task(<?php echo e($task->title, false); ?>) Record</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Title:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p><?php echo e($task->title, false); ?></p>
                        </div>
                    </div>
                    <div class="col-md-4 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Description:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p><?php echo e($task->description, false); ?></p>
                        </div>
                    </div>
                    <div class="col-md-4 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Specail Instruction:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p><?php echo e($task->special_instructions, false); ?></p>
                        </div>
                    </div>
                </div>
                <div class="clearfix mt-5">
                    <div class="col-md-12">
                        <div class="col-md-4 text-capitalize">
                            <div class="col-md-3" style="width:100%;">
                                <label class="text-bold">Assign To:</label>
                            </div>
                            <div class="col-md-3" style="width:100%;">
                                <p><?php echo e($assign_to, false); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4 text-capitalize">
                            <div class="col-md-3" style="width:100%;">
                                <label class="text-bold">Business Location:</label>
                            </div>
                            <div class="col-md-3" style="width:100%;">
                                <p><?php echo e($business_location, false); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4 text-capitalize">
                            <div class="col-md-3" style="width:100%;">
                                <label class="text-bold">Task Address:</label>
                            </div>
                            <div class="col-md-3" style="width:100%;">
                                <p><?php echo e($task->task_address, false); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix mt-5">
                        <div class="col-md-12">
                            <div class="col-md-4 text-capitalize">
                                <div class="col-md-3" style="width:100%;">
                                    <label class="text-bold">Task Latitude:</label>
                                </div>
                                <div class="col-md-3" style="width:100%;">
                                    <p><?php echo e($task->task_latitude, false); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 text-capitalize">
                                <div class="col-md-3" style="width:100%;">
                                    <label class="text-bold">Task longitude:</label>
                                </div>
                                <div class="col-md-3" style="width:100%;">
                                    <p><?php echo e($task->task_longitude, false); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 text-capitalize">
                                <div class="col-md-3" style="width:100%;">
                                    <label class="text-bold">Assigned Date:</label>
                                </div>
                                <div class="col-md-3" style="width:100%;">
                                    <p><?php echo e($task->created_at, false); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix mt-5">
                            <div class="col-md-12">
                                <div class="col-md-4 text-capitalize">
                                    <div class="col-md-3" style="width:100%;">
                                        <label class="text-bold">Task Type:</label>
                                    </div>
                                    <div class="col-md-3" style="width:100%;">
                                        <p><?php echo e($task->task_type, false); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4 text-capitalize">
                                    <div class="col-md-3" style="width:100%;">
                                        <label class="text-bold">Task status:</label>
                                    </div>
                                    <div class="col-md-3" style="width:100%;">
                                        <p><?php echo e($task->task_status, false); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4 text-capitalize">
                                    <div class="col-md-3" style="width:100%;">
                                        <label class="text-bold">Assigned By:</label>
                                    </div>
                                    <div class="col-md-3" style="width:100%;">
                                        <p><?php echo e($assign_by, false); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix mt-5"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary no-print"
                                aria-label="Print"
                                onclick="$(this).closest('div.modal').printThis();">
                            <i class="fa fa-print"></i> <?php echo app('translator')->getFromJson( 'messages.print' ); ?>
                        </button>
                        <button type="button" class="btn btn-default no-print"
                                data-dismiss="modal"><?php echo app('translator')->getFromJson( 'messages.close' ); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/task/partial/show.blade.php ENDPATH**/ ?>