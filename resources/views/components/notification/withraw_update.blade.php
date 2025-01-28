<div class="modal fade" id="update_withraw" tabindex="-1" aria-labelledby="withrawModal" aria-hidden="true">
    <div class="modal-dialog">
      <form id="updateWithraw">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="withrawModal">Udate Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Number</label>
                <input type="text" readonly class="form-control" id="number">
                <input type="hidden" readonly class="form-control" id="user_id">
            </div>
          <div class="mb-3">
            <label class="form-label">Complete Withraw</label>
            <input type="hidden" class="form-control" id="withraw_id">
            <select class="form-control" id="sts">
                <option value="">--Select Status--</option>
                <option value="1">Completed</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary update_withraw">Save</button>
        </div>
      </div>
    </form>
    </div>
  </div>