<div class="modal fade" id="update_recharge" tabindex="-1" aria-labelledby="rechargeModal" aria-hidden="true">
    <div class="modal-dialog">
      <form id="updateRecharge">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="rechargeModal">Udate Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Number</label>
                <input type="text" readonly class="form-control" id="re_number">
            </div>
          <div class="mb-3">
            <label class="form-label">Complete Recharge</label>
            <input type="hidden" class="form-control" id="recharge_id">
            <select class="form-control" id="re_sts">
                <option value="">--Select Status--</option>
                <option value="1">Completed</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary update_recharge">Save</button>
        </div>
      </div>
    </form>
    </div>
  </div>