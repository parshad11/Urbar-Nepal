<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalTitle">task({{$task->title}}) Record</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Title:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$task->title}}</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Description:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$task->description}}</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Specail Instruction:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$task->special_instructions}}</p>
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
                                <p>{{$assign_to}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-capitalize">
                            <div class="col-md-3" style="width:100%;">
                                <label class="text-bold">Business Location:</label>
                            </div>
                            <div class="col-md-3" style="width:100%;">
                                <p>{{$business_location}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-capitalize">
                            <div class="col-md-3" style="width:100%;">
                                <label class="text-bold">Task Address:</label>
                            </div>
                            <div class="col-md-3" style="width:100%;">
                                <p>{{$task->task_address}}</p>
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
                                    <p>{{$task->task_latitude}}</p>
                                </div>
                            </div>
                            <div class="col-md-4 text-capitalize">
                                <div class="col-md-3" style="width:100%;">
                                    <label class="text-bold">Task longitude:</label>
                                </div>
                                <div class="col-md-3" style="width:100%;">
                                    <p>{{$task->task_longitude}}</p>
                                </div>
                            </div>
                            <div class="col-md-4 text-capitalize">
                                <div class="col-md-3" style="width:100%;">
                                    <label class="text-bold">Assigned Date:</label>
                                </div>
                                <div class="col-md-3" style="width:100%;">
                                    <p>{{$task->created_at}}</p>
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
                                        <p>{{$task->task_type}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4 text-capitalize">
                                    <div class="col-md-3" style="width:100%;">
                                        <label class="text-bold">Task status:</label>
                                    </div>
                                    <div class="col-md-3" style="width:100%;">
                                        <p>{{$task->task_status}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4 text-capitalize">
                                    <div class="col-md-3" style="width:100%;">
                                        <label class="text-bold">Assigned By:</label>
                                    </div>
                                    <div class="col-md-3" style="width:100%;">
                                        <p>{{$assign_by}}</p>
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
                            <i class="fa fa-print"></i> @lang( 'messages.print' )
                        </button>
                        <button type="button" class="btn btn-default no-print"
                                data-dismiss="modal">@lang( 'messages.close' )</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
