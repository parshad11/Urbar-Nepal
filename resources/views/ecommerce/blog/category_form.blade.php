<div class="modal-dialog modal-md" role="document" id="categoryModal">
    <div class="modal-content">
        <form action="{{route('ecom_blogcat')}}">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add Category</h4>
            </div>
            <div class="modal-body">
           
            <input type="text" name="title" class="form-control" value="">
            
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->