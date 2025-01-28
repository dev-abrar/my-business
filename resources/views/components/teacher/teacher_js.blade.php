<script>
    $(document).ready(function () {

        // get user
        getUser();

        function getUser() {
            $.ajax({
                url: "{{route('teacher.list')}}",
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
                            <td><img src="${user.photo}"></td>
                            <td>
                                <form action="{{route('studentUnderTeacher')}}" method="GET" class="d-inline">
                                    <button type="submit" name="user_id" value="${user.id}" class="btn btn-primary">Students</button>
                                </form>
                                
                                <button data-id="${user.id}" class="btn btn-danger delete">Delete</button>
                            </td>
                          </tr>
                        `;
                        tableList.append(row);
                    });

                    tableData.DataTable({
                        lengthMenu: [20, 50, 100],
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

        // create user
        $(document).on('click', '.add_user', function () {
            let name = $('#name').val();
            let email = $('#email').val();
            let number = $('#number').val();
            let password = $('#password').val();

            $.ajax({
                url: "{{route('teacher.create')}}",
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    number: number,
                    password: password
                },
                success: function (res) {
                    if (res.status === 'success') {
                        getUser();
                        toastify().success(res.message);
                        $('#create_user').modal('hide');
                        $('#addUser')[0].reset();
                    }
                },
                error: function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, value) {
                        toastify().error(value);
                    });
                }
            });
        })

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
                        url: "{{route('teacher.delete')}}",
                        type: "POST",
                        data: {
                            user_id: user_id
                        },
                        success: function (res) {
                            if (res.status === 'success') {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Teacher Successfully deleted .",
                                    icon: "success"
                                });
                                getUser();
                            }
                        }
                    });

                }
            });
        })

        // user delete
        $(document).on('click', '.student_delete', function () {
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
                        url: "{{route('student.teacher.delete')}}",
                        type: "POST",
                        data: {
                            user_id: user_id
                        },
                        success: function (res) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Student Successfully deleted .",
                                icon: "success"
                            });
                            $('#tabledataStudent').load(location.href+' #tabledataStudent');
                        }
                    });

                }
            });
        })

    })

</script>
