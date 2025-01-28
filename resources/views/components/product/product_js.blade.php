<script>
    $(document).ready(function () {

        // summernote


        // let despContent = decodeURIComponent($(this).data('up_long_desp'));
        $('#long_desp').summernote();
        $('#up_long_desp').summernote();

        // Add Product
        $('.add_product').on('click', function (e) {
            e.preventDefault();

            // Validate fields
            let product_name = $('#product_name').val();
            let price = $('#price').val();
            let discount = $('#discount').val();
            let category_id = $('#category_id').val();
            let commision = $('#commision').val();
            let qty = $('#qty').val();
            let long_desp = $('#long_desp').val().trim();
            let preview = $('#preview')[0].files[0];
            let gallery = $('#gallery')[0].files;
            if (!product_name) {
                toastify().error('Product name is required!');
                return;
            } else if (!price) {
                toastify().error('Product Price is required!');
                return;
            } else if (!qty) {
                toastify().error('Quantity is required!');
                return;
            } 
            else if (!category_id) {
                toastify().error('Category is required!');
                return;
            }
            else if (!long_desp) {
                toastify().error('Long Description is required!');
                return;
            } else if (!preview) {
                toastify().error('Preview Image is required!');
                return;
            } else {
                // Create form data
                let formData = new FormData();
                formData.append('product_name', product_name);
                formData.append('price', price);
                formData.append('discount', discount);
                formData.append('commision', commision);
                formData.append('qty', qty);
                formData.append('category_id', category_id);
                formData.append('long_desp', long_desp);
                formData.append('preview', preview);

                // Add gallery images if selected
                if (gallery.length > 0) { // Fix the condition
                    for (let i = 0; i < gallery.length; i++) {
                        formData.append('gallery[]', gallery[i]);
                    }
                }

                // Send data via AJAX
                $.ajax({
                    url: "{{route('product.create')}}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        loadProduct();
                        toastify().success('Product created successfully');
                        $('#create_product').modal('hide');
                        $('#addProduct')[0].reset();
                        $('#long_desp').summernote('reset');
                    },
                    error: function (err) {
                        let error = err.responseJSON;
                        $.each(error.errors, function (index, value) {
                            toastify().error(value);
                        });
                    }
                });
            }

        });

        // Get product
        function loadProduct() {
            $.ajax({
                url: "{{route('product.list')}}",
                type: "GET",
                success: function (res) {
                    let tableData = $('#dataTable');
                    let tableList = $('#tableList');
                    tableData.DataTable().destroy();
                    tableList.empty();

                    res.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                    $.each(res, function (index, product) {
                        let preview = '/upload/product/preview/' + product.preview;
                        let row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${product.product_name.substring(0,30)}</td>
                            <td>&#2547;${product.price}</td>
                            <td>${product.discount != null ? product.discount: '0'}%</td>
                            <td>&#2547;${product.after_discount}</td>
                            <td>
                                ${product.qty}
                                ${product.qty>0? '<span class="text-success d-block">In Stock</span>':'<span class="text-danger d-block">Stock Out</span>'}
                                
                            </td>
                            <td>${product.category_name}</td>
                            <td><img src="${preview}" style="width:100px; height: 100px; border-radius:0;"></td>
                            <td>
                                <button class="btn btn-primary btn-sm edit-product text-white"
                                data-bs-toggle="modal" data-bs-target="#update_product"
                                data-id="${product.id}"
                                data-name="${encodeURIComponent(product.product_name)}"
                                data-price="${product.price}"
                                data-discount="${product.discount}"
                                data-category_id="${product.category_id}"
                                data-commision="${product.commision}"
                                data-qty="${product.qty}"
                                data-long_desp="${encodeURIComponent(product.long_desp)}"
                                data-preview="${product.preview}"
                                >Edit</button>
                                <button class="btn btn-danger  btn-sm delete-product" data-id="${product.id}">Delete</button>
                            </td>
                        </tr>
                       `;
                        tableList.append(row);
                    })
                    tableData.DataTable();

                }
            });
        }
        loadProduct();


        //  delete product
        $(document).on('click', '.delete-product', function () {
            let product_id = $(this).data('id');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{route('product.delete')}}",
                        type: "POST",
                        data: {
                            product_id: product_id
                        },
                        success: function (res) {
                            if (res.status === 'success') {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Product Successfully deleted.",
                                    icon: "success"
                                });
                                loadProduct();
                            }
                        }
                    });

                }
            });
        });


        // edit product & load category
        function loadCategory(selectedCategoryId) {
            $.ajax({
                url: "{{route('category.list')}}",
                type: "GET",
                success: function (res) {
                    let categorySelect = $('#up_category_id');
                    categorySelect.empty();

                    categorySelect.append('<option value="">--Select any--</option>');

                    let isCategoryMatched = false;

                    // Loop through categories and add them to the dropdown
                    $.each(res, function (index, category) {
                        let selected = (category['id'] == selectedCategoryId) ? 'selected' :
                            '';
                        if (selected) {
                            isCategoryMatched = true;
                        }
                        let option =
                            `<option value="${category['id']}" ${selected}>${category['category_name']}</option>`;
                        categorySelect.append(option);
                    });

                    // If no matching category was found, select the provided `selectedCategoryId`
                    if (!isCategoryMatched && selectedCategoryId) {
                        categorySelect.append(
                            `<option value="${selectedCategoryId}" selected>Unknown Category</option>`
                        );
                    }
                }
            });
        }


        // Edit product 
        $(document).on('click', '.edit-product', function () {
            let product_id = $(this).data('id');
            let product_name = decodeURIComponent($(this).data('name'));
            let price = $(this).data('price');
            let discount = $(this).data('discount');
            let category_id = $(this).data('category_id');
            let commision = $(this).data('commision');
            let qty = $(this).data('qty');
            let long_desp = decodeURIComponent($(this).data('long_desp'));
            let preview = $(this).data('preview');

            // Set values in the modal form
            $('#product_id').val(product_id);
            $('#up_product_name').val(product_name);
            $('#up_price').val(price);
            $('#up_discount').val(discount);
            $('#up_commision').val(commision);
            $('#up_qty').val(qty);
            $('#up_long_desp').summernote('code', long_desp);

            // Set the preview image in the modal
            if (preview) {
                let previewImageUrl = `upload/product/preview/${preview}`;
                $('#perview_img').attr('src', previewImageUrl);
            }

            // Clear and load gallery images
            $('#gallery_images').empty();
            $.ajax({
                url: `products/gallery/${product_id}`,
                type: "GET",
                success: function (response) {
                    if (response.status === 'success') {
                        response.data.forEach(image => {
                            if (image.gallery) {
                                let galleryImageUrl =
                                    `upload/product/gallery/${image.gallery}`;
                                $('#gallery_images').append(
                                    `<img src="${galleryImageUrl}" width="100" style="margin-right: 5px;" alt="Gallery Image">`
                                );
                            }
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Failed to load gallery images:", error);
                }
            });

            // Load categories and subcategories
            loadCategory(category_id);
        });


        // update category
        $('.up_product').on('click', function (e) {
            e.preventDefault();

            // Retrieve values from the modal inputs
            let product_id = $('#product_id').val();
            let product_name = $('#up_product_name').val();
            let price = $('#up_price').val();
            let discount = $('#up_discount').val();
            let category_id = $('#up_category_id').val();
            let commision = $('#up_commision').val();
            let qty = $('#up_qty').val();
            let long_desp = $('#up_long_desp').val();
            let preview = $('#up_preview')[0].files[0];
            let gallery = $('#up_gallery')[0].files;

            // Create form data
            let formData = new FormData();
            formData.append('product_id', product_id);
            formData.append('product_name', product_name);
            formData.append('price', price);
            formData.append('discount', discount);
            formData.append('category_id', category_id);
            formData.append('commision', commision);
            formData.append('qty', qty);
            formData.append('long_desp', long_desp);

            // Add preview image only if it's not empty
            if (preview && preview !== '') {
                formData.append('preview', preview);
            }

            // Add gallery images only if selected
            if (gallery && gallery.length > 0) {
                for (let i = 0; i < gallery.length; i++) {
                    formData.append('gallery[]', gallery[i]);
                }
            }

            // Send data via AJAX
            $.ajax({
                url: "{{route('product.update')}}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    toastify().success('Product updated successfully');
                    loadProduct();
                    $('#update_product').modal('hide');
                    $('#updateProduct')[0].reset();
                },
                error: function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, value) {
                        toastify().error(value);
                    });
                }
            });
        });


    });

</script>

<script>
    $(document).ready(function () {

        // get category
        getCategory();

        function getCategory() {
            $.ajax({
                url: "{{route('category.list')}}",
                type: "GET",
                success: function (res) {
                    $.each(res, function (index, category) {
                        let option =
                            `<option value="${category['id']}">${category['category_name']}</option>`;
                        $('#category_id').append(option);
                    })

                }
            });
        }


    });

</script>
