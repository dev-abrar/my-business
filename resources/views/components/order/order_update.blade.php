<div class="modal fade" id="update_order" tabindex="-1" aria-labelledby="orderModal" aria-hidden="true">
    <div class="modal-dialog">
        <form id="updateOrder">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="orderModal">Udate Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="order_table table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <td id="name"></td>
                            </tr>
                            <tr>
                                <th>Number</th>
                                <td id="number"></td>
                            </tr>
                            <tr>
                                <th>District</th>
                                <td id="district"></td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td id="city"></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td id="address"></td>
                            </tr>
                            <tr>
                                <th>Extra Address</th>
                                <td id="extra_address"></td>
                            </tr>
                            <tr>
                                <th>Product Name</th>
                                <td id="product_name"></td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td id="price"></td>
                            </tr>
                            <tr>
                                <th>Quantity</th>
                                <td id="qty"></td>
                            </tr>
                            <tr>
                                <th>Charge</th>
                                <td id="charge"></td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td id="total"></td>
                            </tr>
                        </table>
                    </div>

                    <div class="mb-3 t-5">
                        <label class="form-label">Complete Recharge</label>
                        <input type="hidden" class="form-control" id="order_id">
                        <select class="form-control" id="order_sts">
                            <option value="">--Select Status--</option>
                            <option value="0">Pending</option>
                            <option value="1">Received</option>
                            <option value="2">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_order">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
