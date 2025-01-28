<script>
    $(document).ready(function () {


        // create category
        $('.add_category').click(function () {
            let category_name = $("#category_name").val();
            let category_img = $('#category_img')[0].files[0];

            if (category_name.trim().length === 0) {
                toastify().error('Category name is required!');
            } else if (!category_img) {
                toastify().error('Category Image is required!');
            } else {
                let formData = new FormData();
                formData.append('category_name', category_name);
                formData.append('category_img', category_img);

                $.ajax({
                    url: "{{ route('category.create') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        getCategory();
                        toastify().success('Category Created Successfully!');
                        $('#create_category').modal('hide');
                        $("#addCategory")[0].reset();
                    },
                    error: function (err) {
                        let error = err.responseJSON;
                        if (error.errors) {
                            $.each(error.errors, function (index, value) {
                                toastify().error(value);
                            });
                        } else {
                            toastify().error('Something went wrong!');
                        }
                    }
                });
            }
        });

        // Category list
        getCategory();

        function getCategory() {
            $.ajax({
                url: "{{route('category.list')}}",
                type: "GET",
                success: function (res) {

                    let tableData = $('#tabledata');
                    let tableList = $('#tableList')
                    tableData.DataTable().destroy();
                    tableList.empty();

                    res.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                    $.each(res, function (index, category) {
                        let srcImage = `/upload/category/${category.category_img}`;
                        let row = `
                            <tr>
                                <td>${index+1}</td>
                                <td>${category.category_name}</td>
                                <td><img src="${srcImage}" alt="Category Image"></td>
                                <td>
                                    <button 
                                    data-bs-toggle="modal" data-bs-target="#update_category"
                                    data-id="${category.id}"
                                    data-name="${category.category_name}"
                                    data-img="${category.category_img}"
                                    class="btn btn-info text-white edit">Edit</button>
                                    <button data-id="${category.id}" class="btn btn-danger delete">Delete</button>
                                </td>
                            </tr> 
                        `;
                        tableList.append(row);
                    });
                    tableData.DataTable();
                }
            });
        }

        // category delete
        $(document).on('click', '.delete', function () {
            let category_id = $(this).data('id');

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
                        url: "{{route('category.delete')}}",
                        type: "POST",
                        data: {
                            category_id: category_id
                        },
                        success: function (res) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Category Successfully deleted .",
                                icon: "success"
                            });
                            getCategory();
                        }
                    });

                }
            });
        })

        // category edit
        $(document).on('click', '.edit', function () {
            let category_id = $(this).data('id');
            let category_name = $(this).data('name');
            let category_img = $(this).data('img');

            $('#category_id').val(category_id);
            $('#up_category_name').val(category_name);

            let categoryImg = `upload/category/${category_img}`;
            $('#categoryImg').attr('src', categoryImg);
        })

        // category update
        $('.update_category').click(function () {
            let category_id = $('#category_id').val();
            let category_name = $('#up_category_name').val();
            let category_img = $('#up_category_img')[0].files[0];

            let formData = new FormData();
            formData.append('category_id', category_id);
            formData.append('category_name', category_name);

            if (category_img) {
                formData.append('category_img', category_img);
            }

            $.ajax({
                url: "{{route('category.update')}}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    toastify().success('Category updated successfull!');
                    getCategory();
                    $("#update_category").modal('hide');
                    $('#updateCategory')[0].reset();
                },
                error: function (err) {
                    let error = err.responseJSON;
                    if (error.errors) {
                        $.each(error.errors, function (index, value) {
                            toastify().error(value);
                        })
                    } else {
                        toastify().error("Somethinf went wrong!");
                    }
                }
            });
        });
    });

</script>
