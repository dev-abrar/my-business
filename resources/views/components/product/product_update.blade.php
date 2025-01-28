<!-- Button trigger modal -->



<div class="modal fade" id="update_product" tabindex="-1" aria-labelledby="up_product_head" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1000px;">
        <form id="updateProduct">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="up_product_head">Update Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="hidden" class="form-control" id="product_id">
                                <input type="text" class="form-control" id="up_product_name">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Product Price</label>
                                <input type="number" class="form-control" id="up_price">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Product Discount</label>
                                <input type="number" class="form-control" id="up_discount">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Commision</label>
                                <input type="number" class="form-control" id="up_commision">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="up_qty">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Select Category</label>
                                <select id="up_category_id" class="form-control">
                                    <option value="">--Select any--</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Long Description</label>
                                <textarea id="up_long_desp" class="text-white"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Product Preview</label>
                                <input type="file" class="form-control" id="up_preview">
                                <div class="my-3">
                                    <img id="perview_img" width="100" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Product Gallery</label>
                                <input type="file" multiple class="form-control" id="up_gallery">
                                <div class="mb-3 mt-2" id="gallery_images">
                        
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary text-white up_product">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
