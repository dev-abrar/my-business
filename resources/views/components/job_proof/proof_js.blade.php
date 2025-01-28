<script>
    $(document).ready(function () {

        // get user
        getProof();

        function getProof() {
            $.ajax({
                url: "{{ route('proof.list') }}",
                type: "GET",
                success: function (res) {
                    let tableData = $('#tabledata');
                    let tableList = $('#tableList');

                    // Destroy any existing DataTable instance before re-initializing
                    tableData.DataTable().destroy();
                    tableList.empty();

                    // Sort withdrawals by creation date (newest first)
                    res.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                    // Iterate over the response data
                    $.each(res, function (index, proof) {


                        // Create the table row for each withdrawal request
                        let row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${proof.student.name}</td>
                                <td>${proof.job.desp.substring(0, 50)}</td>
                                <td>${proof.desp.substring(0, 50)}</td>
                                <td>${proof.job.amount} &#2547;</td>
                                 <td>
                                    ${proof.sts == 0 ? 
                                    `<button data-bs-toggle="modal" data-bs-target="#update_proof" data-id="${proof.id}" class="btn btn-warning edit">Pending</button>` : 
                                    `<button class="btn btn-success">Completed</button>`
                                    }
                                    <button data-id="${proof.id}" class="btn btn-danger delete">Delete</button>
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

        $(document).on('click', '.edit', function () {
            let proofId = $(this).data('id'); // Get the proof ID from the button

            // Clear any existing images in the modal
            $('.images').empty();

            // Get proof details from the loaded proof list
            $.ajax({
                url: "{{ route('proof.list') }}", // Fetch all proof data
                type: 'GET',
                success: function (res) {
                    // Find the specific proof data by its ID
                    let proof = res.find(item => item.id == proofId);

                    if (proof) {
                        // Populate modal fields
                        $('#proof_id').val(proof.id);
                        $('#sts').val(proof.sts);

                        // Display images associated with the proof
                        proof.images.forEach(function (image) {
                            $('.images').append(`
                        <img src="/upload/proof/${image.image}" alt="Proof Image" class="img-thumbnail" style="width: 100px; height: 100px; margin: 5px;">
                    `);
                        });
                    } else {
                        alert('Proof data not found.');
                    }
                },
                error: function () {
                    alert('Failed to fetch proof data.');
                }
            });
        });


        $(document).on('click', '.update_proof', function () {
            let proof_id = $('#proof_id').val();
            let sts = $('#proof_sts').val();

            $.ajax({
                url: "{{route('proof.sts')}}",
                type: "POST",
                data: {
                    proof_id: proof_id,
                    sts: sts,
                },
                success: function (res) {
                    getProof();
                    toastify().success('Status changed Successfull!');
                    $('#update_proof').modal('hide');
                    $('#updateProof')[0].reset();
                },
                error: function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, value) {
                        toastify().error(value);
                    });
                }
            });
        });

        $(document).on('click', '.delete', function () {
            let proof_id = $(this).data('id');

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
                        url: "{{route('proof.delete')}}",
                        type: "POST",
                        data: {
                            proof_id: proof_id
                        },
                        success: function (res) {
                            if (res.status === 'success') {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Proof Successfully deleted .",
                                    icon: "success"
                                });
                                getProof();
                            }
                        }
                    });

                }
            });
        })

    })

</script>
