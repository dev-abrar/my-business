<script>
    $(document).ready(function () {

        // get user
        getUser();

        function getUser() {
            $.ajax({
                url: "{{route('student.list')}}",
                type: "GET",
                success: function (res) {
                    let tableData = $('#tabledata');
                    let tableList = $('#tableList');
                    tableData.DataTable().destroy();
                    tableList.empty();

                    res.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                    $.each(res, function (index, user) {
                        let row = `
                         <tr>
                            <td>${index+1}</td>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>${user.number==null ? 'NULL':user.number}</td>
                            <td>${user.teacher_id==null ? 'NULL':user.teacher_name}</td>
                            <td><button type="button" data-id="${user.id}" data-sts="${user.sts}" class="status btn btn-${user.sts == 1 ? 'success':'secondary'}">${user.sts == 1 ? 'Active':'Deactive'}</button></td>
                            <td>
                                
                                <div class="dropdown">
                            <button type="button" class="dropdown-toggle" id="dropdownMenuIconButton5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton5" style="">
                              <button data-id="${user.id}"
                              data-bs-toggle="modal" data-bs-target="#create_user"
                              class="dropdown-item set_teacher">Get Teacher</button>
                              <button data-id="${user.id}" class="dropdown-item delete">Delete</button>
                            </div>
                          </div>
                            </td>
                          </tr>
                        `;
                        tableList.append(row);
                    });

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

        // user delete
        $(document).on('click', '.delete', function () {
            let user_id = $(this).data('id');

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
                        url: "{{route('student.delete')}}",
                        type: "POST",
                        data: {
                            user_id: user_id
                        },
                        success: function (res) {
                            if (res.status === 'success') {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Student Successfully deleted .",
                                    icon: "success"
                                });
                                getUser();
                            }
                        }
                    });

                }
            });
        })

        // card status
        $(document).on('click', '.status', function () {
            let user_id = $(this).data('id');
            let sts = $(this).data('sts');

            let formData = new FormData();
            formData.append('user_id', user_id);
            formData.append('sts', sts == 1 ? 0 : 1);

            $.ajax({
                url: "{{route('student.status')}}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    getUser();
                    toastify().success('Status successfully changed!');
                },
                error: function (xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        toastify().error(xhr.responseJSON.error);
                    } else {
                        toastify().error('Something went wrong!');
                    }
                }
            });
        });

        $(document).on('click', '.set_teacher', function () {
            let user_id = $(this).data('id');
            $('#user_id').val(user_id);
        });

        // create user
        $(document).on('click', '.add_user', function () {
            let user_id = $('#user_id').val();
            let teacher_id = $('#teacher_id').val();

            if (!teacher_id) {
                toastify().error('Please select teacher!');
                return;
            }

            $.ajax({
                url: "{{route('studentOfTeacher.create')}}",
                type: "POST",
                data: {
                    user_id: user_id,
                    teacher_id: teacher_id,
                },
                success: function (res) {
                    getUser();
                    toastify().success('Teacher Added Successfull');
                    $('#create_user').modal('hide');
                    $('#addUser')[0].reset();
                },
                error: function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, value) {
                        toastify().error(value);
                    });
                }
            });
        })

    })

</script>
