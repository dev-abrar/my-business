<script>
    $(document).ready(function () {

        // get user
        getWithraw();

        function getWithraw() {
            $.ajax({
                url: "{{ route('withraw.list') }}",
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
                    $.each(res, function (index, withraw) {
                        // Determine the method name
                        let methodName;
                        if (withraw.method == 1) {
                            methodName = "Bkash";
                        } else if (withraw.method == 2) {
                            methodName = "Nagad";
                        } else if (withraw.method == 3) {
                            methodName = "Rocket";
                        } else if (withraw.method == 4) {
                            methodName = "Bank";
                        } else {
                            methodName = "Unknown";
                        }

                        // Create the table row for each withdrawal request
                        let row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${withraw.user_type}</td>
                                <td>${withraw.user_name}</td>
                                <td>${withraw.number}</td>
                                <td>${methodName}</td>
                                <td>${withraw.amount} &#2547;</td>
                                 <td>
                                    ${withraw.sts == 0 ? 
                                    `<button data-bs-toggle="modal" data-bs-target="#update_withraw" data-id="${withraw.id}" data-number="${withraw.number}" data-user-id="${withraw.user_id}" class="btn btn-warning edit">Pending</button>` : 
                                    `<button class="btn btn-success">Completed</button>`
                                }
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
            let withraw_id = $(this).data('id');
            let number = $(this).data('number');
            let user_id = $(this).data('user-id');

            $('#withraw_id').val(withraw_id);
            $('#number').val(number);
            $('#user_id').val(user_id);

        });

        $(document).on('click', '.update_withraw', function () {
            let withraw_id = $('#withraw_id').val();
            let sts = $('#sts').val();
            let user_id = $('#user_id').val();

            $.ajax({
                url: "{{route('withraw.sts')}}",
                type: "POST",
                data: {
                    withraw_id: withraw_id,
                    sts: sts,
                    user_id: user_id,
                },
                success: function (res) {
                    getWithraw();
                    toastify().success('Status changed Successfull!');
                    $('#update_withraw').modal('hide');
                    $('#updateWithraw')[0].reset();
                },
                error: function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, value) {
                        toastify().error(value);
                    });
                }
            });
        });


        // recharge 
        getRecharge();

        function getRecharge() {
            $.ajax({
                url: "{{ route('recharge.list') }}",
                type: "GET",
                success: function (res) {
                    let tableData = $('#tabledataRecharge');
                    let tableList = $('#tableListRecharge');

                    // Destroy any existing DataTable instance before re-initializing
                    tableData.DataTable().destroy();
                    tableList.empty();

                    // Sort recharges by creation date (newest first)
                    res.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                    // Iterate over the response data
                    $.each(res, function (index, recharge) {
                        // Map operator and type values to labels
                        let operatorLabel;
                        switch (recharge.operator) {
                            case 1:
                                operatorLabel = 'Grameenphone';
                                break;
                            case 2:
                                operatorLabel = 'Banglalink';
                                break;
                            case 3:
                                operatorLabel = 'Teletalk';
                                break;
                            case 4:
                                operatorLabel = 'Robi';
                                break;
                            default:
                                operatorLabel = 'Unknown';
                        }

                        let typeLabel;
                        switch (recharge.type) {
                            case 1:
                                typeLabel = 'Prepaid';
                                break;
                            case 2:
                                typeLabel = 'Postpaid';
                                break;
                            case 3:
                                typeLabel = 'Skitto';
                                break;
                            default:
                                typeLabel = 'Unknown';
                        }

                        // Create the table row for each recharge request
                        let row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${recharge.name}</td>
                                <td>${recharge.number}</td>
                                <td>${recharge.amount}&#2547;</td>
                                <td>${operatorLabel}</td>
                                <td>${typeLabel}</td>
                                <td>
                                    ${recharge.sts == 0 ? 
                                    `<button data-bs-toggle="modal" data-bs-target="#update_recharge" data-recharge-id="${recharge.id}" data-mobile-number="${recharge.number}" class="btn btn-warning edit_recharge">Pending</button>` : 
                                    `<button class="btn btn-success">Completed</button>`}
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

        $(document).on('click', '.edit_recharge', function () {
            let recharge_id = $(this).data('recharge-id');
            let number = $(this).data('mobile-number');

            $('#recharge_id').val(recharge_id);
            $('#re_number').val(number);

        });

        $(document).on('click', '.update_recharge', function () {
            let recharge_id = $('#recharge_id').val();
            let sts = $('#re_sts').val();

            $.ajax({
                url: "{{route('recharge.sts')}}",
                type: "POST",
                data: {
                    recharge_id: recharge_id,
                    sts: sts,
                },
                success: function (res) {
                    getRecharge();
                    toastify().success('Status changed Successfull!');
                    $('#update_recharge').modal('hide');
                    $('#updateRecharge')[0].reset();
                },
                error: function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, value) {
                        toastify().error(value);
                    });
                }
            });
        });


        // student varifications
        getVarify();

        function getVarify() {
            $.ajax({
                url: "{{ route('varify.list') }}",
                type: "GET",
                success: function (res) {
                    let tableData = $('#tabledataVarify');
                    let tableList = $('#tableListVarify');

                    // Destroy any existing DataTable instance before re-initializing
                    tableData.DataTable().destroy();
                    tableList.empty();

                    // Sort recharges by creation date (newest first)
                    res.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                    // Iterate over the response data
                    $.each(res, function (index, varify) {
                        let studentName = varify.rel_to_student ? varify.rel_to_student.name : 'N/A';
                        // Create the table row for each recharge request
                        let row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${studentName}</td>
                            <td>${varify.number}</td>
                            <td>${varify.amount}&#2547;</td>
                            <td>${varify.payment_method}</td>
                            <td>${varify.transaction}</td>
                            <td>${varify.account_number}</td>
                            <td>
                                ${varify.sts == 0 ? 
                                `<button data-bs-toggle="modal" data-bs-target="#update_varify" data-varify-id="${varify.id}" class="btn btn-warning edit_varify">Pending</button>` : 
                                `<button class="btn btn-success">Completed</button>`}
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

        $(document).on('click', '.edit_varify', function () {
            let varify_id = $(this).data('varify-id');

            $('#varify_id').val(varify_id);

        });

        $(document).on('click', '.update_varify', function () {
            let varify_id = $('#varify_id').val();
            let sts = $('#varify_sts').val();

            $.ajax({
                url: "{{route('varify.sts')}}",
                type: "POST",
                data: {
                    varify_id: varify_id,
                    sts: sts,
                },
                success: function (res) {
                    getVarify();
                    toastify().success('Status changed Successfull!');
                    $('#update_varify').modal('hide');
                    $('#updateVarify')[0].reset();
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
