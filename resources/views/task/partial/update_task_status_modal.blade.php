<div class="modal fade" id="update_task_status_modal" tabindex="-1" role="dialog"
     aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['url' => "#", 'method' => 'put', 'id' => 'update_task_status_form' ]) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">@lang( 'lang_v1.update_status' )</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('update_status', __('sale.status').':*') !!}
                    {!! Form::select('task_status', $taskStatuses, null, ['class' => 'form-control select2', 'required', 'id' => 'update_status', 'style' => 'width: 100%;']); !!}
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">@lang( 'messages.update' )</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
            </div>
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>