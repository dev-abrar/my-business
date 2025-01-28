<!-- Button trigger modal -->

<div class="modal fade" id="update_category" tabindex="-1" aria-labelledby="update_category_head" aria-hidden="true">
    <div class="modal-dialog">
        <form id="updateCategory">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="update_category_head">Update Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="hidden" class="form-control" id="category_id">
                        <input type="text" class="form-control" id="up_category_name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category Image</label>
                        <input type="file" class="form-control" id="up_category_img"
                            onchange="document.getElementById('categoryImg').src = window.URL.createObjectURL(this.files[0])">
                        <div class="mt-2">
                            <img id="categoryImg" width="100" height="100" src="" alt="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary text-white update_category">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
