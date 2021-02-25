<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalTitle">Delivery Detail </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">delivery Person:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$delivery_person}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">deliver To:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$delivery->delivered_to}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">delivery Status:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$delivery->delivery_status}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Special Instruction:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$delivery->special_delivery_instruction}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Shipping Address:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$delivery->shipping_address}}</p>
                            <p>{{$delivery->shipping_latitude}},{{$delivery->shipping_longitude}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">pickup Address:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$delivery->pickup_address}}</p>
                            <p>{{$delivery->pickup_latitude}},{{$delivery->pickup_longitude}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Delivery Started At:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$delivery->delivery_started_at}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Delivery Ended At:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$delivery->delivered_ended_at}}</p>
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
