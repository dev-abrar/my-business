
<!-- Modal -->
<div class="modal fade" id="create_category" tabindex="-1" aria-labelledby="userModal" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addCategory">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="userModal">Create Teacher</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea id="desp" class="form-control"></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Amount</label>
          <input type="number" class="form-control" id="amount">
        </div>
        <div class="mb-3">
          <label class="form-label">Link</label>
          <input type="text" class="form-control" id="link">
        </div>
        <div class="mb-3">
          <label class="form-label">Banner Image</label>
          <input type="file" class="form-control" id="image"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
          <div class="mt-2">
            <img src="" id="blah" width="100" height="100" alt="Upload Image">
          </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add_job">Save</button>
      </div>
    </div>
  </form>
  </div>
</div>
