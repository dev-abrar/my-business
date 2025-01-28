
<!-- Modal -->
<div class="modal fade" id="create_user" tabindex="-1" aria-labelledby="userModal" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addUser">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="userModal">Create Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">User Name</label>
          <input type="text" class="form-control" id="name">
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" id="email">
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" id="password">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add_user">Save</button>
      </div>
    </div>
  </form>
  </div>
</div>
