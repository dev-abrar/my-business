
<!-- Modal -->
<div class="modal fade" id="create_user" tabindex="-1" aria-labelledby="userModal" aria-hidden="true">
    <div class="modal-dialog">
      <form id="addUser">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="userModal">Create Teacher</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Select Teacher</label>
            <input type="hidden" id="user_id" value="">
            <select class="form-control" id="teacher_id">
                <option value="">--select any--</option>
                @foreach ($teachers as $teacher)
                <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                @endforeach
            </select>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary add_user">Save</button>
        </div>
      </div>
    </form>
    </div>
  </div>
  