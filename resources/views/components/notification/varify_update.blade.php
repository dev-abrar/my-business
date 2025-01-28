<div class="modal fade" id="update_varify" tabindex="-1" aria-labelledby="varifyModal" aria-hidden="true">
    <div class="modal-dialog">
      <form id="updateVarify">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="varifyModal">Udate Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Complete Varify</label>
            <input type="hidden" class="form-control" id="varify_id">
            <select class="form-control" id="varify_sts">
                <option value="">--Select Status--</option>
                <option value="1">Completed</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary update_varify">Save</button>
        </div>
      </div>
    </form>
    </div>
  </div>