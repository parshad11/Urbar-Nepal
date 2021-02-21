<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalTitle">Record of {{$contact->first_name}} {{$contact->last_name}}
                for {{$record->expected_collection_date}}</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Supplier:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{@$contact->prefix.'.'}}{{$contact->first_name}} {{$contact->last_name}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Business Location:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$business_location->name}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Item Name:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$record->item}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Quantity:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$record->quantity}}{{$unit->short_name}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Expected Collection Date:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$record->expected_collection_date}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Supplier Location:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$record->location}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-capitalize">
                        <div class="col-md-3" style="width:100%;">
                            <label class="text-bold">Added By:</label>
                        </div>
                        <div class="col-md-3" style="width:100%;">
                            <p>{{$created_by->first_name}} {{$created_by->last_name}}</p>
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
