<script>
    $(document).ready(function () {

        // order list 
        getOrder();

        function getOrder() {
            $.ajax({
                url: "{{ route('order.list') }}",
                type: "GET",
                success: function (res) {
                    let tableData = $('#tabledata');
                    let tableList = $('#tableList');

                    // Destroy any existing DataTable instance before re-initializing
                    tableData.DataTable().destroy();
                    tableList.empty();

                    // Sort recharges by creation date (newest first)
                    res.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                    // Iterate over the response data
                    $.each(res, function (index, order) {
                        // Map operator and type values to labels
                        let statusBadge = '';
                        if (order.sts == 0) {
                            statusBadge = '<span class="badge bg-warning">Pending</span>';
                        } else if (order.sts == 1) {
                            statusBadge = '<span class="badge bg-info">Received</span>';
                        } else if (order.sts == 2) {
                            statusBadge = '<span class="badge bg-success">Completed</span>';
                        }


                        // Create the table row for each recharge request
                        let row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${order.order_id}</td>
                                <td>${order.total}&#2547;</td>
                                <td>${order.student_name}</td>
                                <td>${order.commission ?? 0}&#2547;</td>
                                <td>
                                    ${statusBadge}
                                </td>
                                <td>
                                    <button
                                    data-bs-toggle="modal"
                                    data-bs-target="#update_order"
                                    data-id="${order.order_id}"
                                    data-name="${order.name}"
                                    data-number="${order.number}"
                                    data-district="${order.district}"
                                    data-city="${order.city}"
                                    data-address="${order.address}"
                                    data-extra_address="${order.extra_address}"
                                    data-product_name="${order.product_name}"
                                    data-price="${order.product_price}"
                                    data-qty="${order.qty}"
                                    data-charge="${order.charge}"
                                    data-total="${order.total}"
                                    class="btn btn-primary edit_order">View</button>
                                </td>
                            </tr>
                        `;
                        tableList.append(row);
                    });

                    // Re-initialize DataTable with settings
                    tableData.DataTable({
                        lengthMenu: [50, 100, 200],
                        language: {
                            paginate: {
                                previous: 'Previous',
                                next: 'Next'
                            }
                        }
                    });
                }
            });
        }

        $(document).on('click', '.edit_order', function () {
            let order_id = $(this).data('id');
            let name = $(this).data('name');
            let number = $(this).data('number');
            let district = $(this).data('district');
            let city = $(this).data('city');
            let address = $(this).data('address');
            let extra_address = $(this).data('extra_address');
            let product_name = $(this).data('product_name');
            let price = $(this).data('price');
            let qty = $(this).data('qty');
            let charge = $(this).data('charge');
            let total = $(this).data('total');

            // Populate table cells
            $('#order_id').val(order_id);
            $('#name').text(name);
            $('#number').text(number);
            $('#district').text(district);
            $('#city').text(city);
            $('#address').text(address);
            $('#extra_address').text(extra_address);
            $('#product_name').text(product_name);
            $('#price').text(price);
            $('#qty').text(qty);
            $('#charge').text(charge);
            $('#total').text(total);
        });


        $(document).on('click', '.update_order', function () {
            let order_id = $('#order_id').val();
            let sts = $('#order_sts').val();

            $.ajax({
                url: "{{route('order.sts')}}",
                type: "POST",
                data: {
                    order_id: order_id,
                    sts: sts,
                },
                success: function (res) {
                    getOrder();
                    toastify().success('Status changed Successfull!');
                    $('#update_order').modal('hide');
                    $('#updateOrder')[0].reset();
                },
                error: function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, value) {
                        toastify().error(value);
                    });
                }
            });
        });





    })

</script>
