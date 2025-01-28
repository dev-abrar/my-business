<script>
    $(document).ready(function () {

        $('.add_job').click(function () {
            let desp = $("#desp").val();
            let amount = $("#amount").val();
            let link = $("#link").val();
            let image = $('#image')[0].files[0];

            if (!desp) {
                toastify().error('Description is required!');
            } else if (!amount) {
                toastify().error('Amount is required!');
            }
            else if (!link) {
                toastify().error('Link is required!');
            }
             else if (!image) {
                toastify().error('Image is required!');
            } 
            else {
                let formData = new FormData();
                formData.append('desp', desp);
                formData.append('amount', amount);
                formData.append('link', link);

                if (image) {
                    formData.append('image', image);
                }

                $.ajax({
                    url: "{{ route('job.create') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        toastify().success('Job Created Successfully!');
                        $('#create_category').modal('hide');
                        $("#addCategory")[0].reset();
                        getJob();
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

        // job
        getJob();

        function getJob() {
            $.ajax({
                url: "{{route('job.list')}}",
                type: "GET",
                success: function (res) {

                    let tableData = $('#tabledata');
                    let tableList = $('#tableList')
                    tableData.DataTable().destroy();
                    tableList.empty();

                    $.each(res, function (index, job) {
                        let srcImage = `/upload/job/${job.image}`;
                        let row = `
                            <tr>
                                <td>${index+1}</td>
                                <td>${job.desp.substring(0, 50)}</td>
                                <td>&#2547; ${job.amount} </td>
                                <td>
                                    <img src="${srcImage}" alt="Banner">

                                </td>
                                <td>
                                    <button data-id="${job.id}" class="btn btn-danger delete">Delete</button>
                                </td>
                            </tr> 
                        `;
                        tableList.append(row);
                    });
                    tableData.DataTable();
                }
            });
        }

        // job delete
        $(document).on('click', '.delete', function () {
            let job_id = $(this).data('id');

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
                        url: "{{route('job.delete')}}",
                        type: "POST",
                        data: {
                            job_id: job_id
                        },
                        success: function (res) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Job Successfully deleted .",
                                icon: "success"
                            });
                            getJob();
                        }
                    });

                }
            });
        })

    });

</script>
