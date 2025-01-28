<!-- Button trigger modal -->



<div class="modal fade" id="create_category" tabindex="-1" aria-labelledby="create_category_head" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addCategory">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="create_category_head">Create Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="category_name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category Image</label>
                        <input type="file" class="form-control" id="category_img"
                            onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="mt-2">
                            <img src="" id="blah" width="100" height="100" alt="Upload Image">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary text-white add_category">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
