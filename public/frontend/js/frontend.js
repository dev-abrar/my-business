$(document).ready(function () {
    // teacher profile 
    $(document).on('click', '.update_teacher', function () {
        let name = $('#teacher_name').val();
        let email = $('#teacher_email').val();
        let number = $('#teacher_number').val();
        let password = $('#teacher_password').val();
        let photo = $('#teacher_photo')[0].files[0];

        if (!name) {
            toastify().error('Name is required');
        } else if (!email) {
            toastify().error('Email is required');
        } else {
            let formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('number', number);
            formData.append('password', password);
            if (photo) {
                formData.append('photo', photo);
            }


            $.ajax({
                url: "/teacher-profile-update",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    $('#ProfileMain').load(location.href + ' #ProfileMain');
                    $('#ProfileFrom')[0].reset();
                    toastify().success('Profile info updated successfully!');
                },
            });
        }
    })

    // student profile 
    $(document).on('click', '.update_student', function () {
        let name = $('#update_student_name').val();
        let email = $('#update_student_email').val();
        let number = $('#update_student_number').val();
        let password = $('#update_student_password').val();
        let photo = $('#update_student_photo')[0].files[0];

        if (!name) {
            toastify().error('Name is required');
        } else if (!email) {
            toastify().error('Email is required');
        } else {
            let formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('number', number);
            formData.append('password', password);
            if (photo) {
                formData.append('photo', photo);
            }


            $.ajax({
                url: "/student-profile-update",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    $('#StudentProfileMain').load(location.href + ' #StudentProfileMain');
                    $('#StudentProfileFrom')[0].reset();
                    toastify().success('Profile info updated successfully!');
                },
            });
        }
    })

    // add student
    $(document).on('click', '.add_student', function () {
        let name = $('#student_name').val();
        let email = $('#student_email').val();
        let number = $('#student_number').val();
        let refer_by = $('#refer_by').val();
        let password = $('#student_password').val();

        if (!name) {
            toastify().error('Name is required');
        } else if (!email) {
            toastify().error('Email is required');
        } else if (!number) {
            toastify().error('Whatsapp is required');
        } else if (!password) {
            toastify().error('Password is required');
        } else {
            let formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('number', number);
            formData.append('refer_by', refer_by);
            formData.append('password', password);


            $.ajax({
                url: "/student-create",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    $('.student_list').load(location.href + ' .student_list');
                    $('#student').modal('hide');
                    toastify().success('Student Added successfully!');
                    $('#studentFrom')[0].reset();
                },
            });
        }
    })

    // varify 
    $(document).on('click', '.varify', function () {
        let student_id = $('.student_id').val();
        let payment_method = $('#paymentMethod').val();
        let amount = $('.amount').val();
        let transaction = $('.transaction').val();
        let account_number = $('.account_number').val();

        if (!payment_method) {
            toastify().error('Payment Method is required!');
        } else if (!transaction) {
            toastify().error('Transaction is required!');
        } else if (!account_number) {
            toastify().error('Account Number is required!');
        } else {
            let formData = new FormData();
            formData.append('student_id', student_id);
            formData.append('payment_method', payment_method);
            formData.append('amount', amount);
            formData.append('transaction', transaction);
            formData.append('account_number', account_number);


            $.ajax({
                url: "/student-varify",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    $('#dashboard').load(location.href + ' #dashboard');
                    $('#varify').modal('hide');
                    toastify().success('Your account will be active within 1 hour!');
                    $('#VarifyForm')[0].reset();
                },
            });
        }
    });

    // students withraw
    $(document).on('click', '.s_withraw_btn', function () {
        let amount = $('.s_withraw_amount').val();
        let method = $('.s_withraw_method').val();
        let number = $('.s_withraw_number').val();
        let password = $('.s_withraw_password').val();

        // Validate form inputs
        if (!amount) {
            toastify().error('Amount is required!');
        } else if (!method) {
            toastify().error('Payment Method is required!');
        } else if (!number) {
            toastify().error('Number is required!');
        } else if (!password) {
            toastify().error('Password is required!');
        } else {
            let formData = new FormData();
            formData.append('amount', amount);
            formData.append('method', method);
            formData.append('number', number);
            formData.append('password', password);

            // Send AJAX POST request
            $.ajax({
                url: "/student-withraw",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    // Reload balance section to show updated data
                    $('#balance').load(location.href + ' #balance');
                    $('#withraw').modal('hide'); // Hide the modal
                    toastify().success(res.success || 'Your withdrawal is processed!');
                    $('#WithrawForm')[0].reset(); // Reset the form
                },
                error: function (err) {
                    let error = err.responseJSON;
                    if (error.errors) {
                        // Display validation errors
                        $.each(error.errors, function (index, value) {
                            toastify().error(value);
                        });
                    } else {
                        // Display any general errors
                        toastify().error(error.error || 'Something went wrong, please try again.');
                    }
                }
            });
        }
    });

    // teacher withraw
    $(document).on('click', '.t_withraw_btn', function () {
        let amount = $('.t_withraw_amount').val();
        let method = $('.t_withraw_method').val();
        let number = $('.t_withraw_number').val();
        let password = $('.t_withraw_password').val();

        // Validate form inputs
        if (!amount) {
            toastify().error('Amount is required!');
        } else if (!method) {
            toastify().error('Payment Method is required!');
        } else if (!number) {
            toastify().error('Number is required!');
        } else if (!password) {
            toastify().error('Password is required!');
        } else {
            let formData = new FormData();
            formData.append('amount', amount);
            formData.append('method', method);
            formData.append('number', number);
            formData.append('password', password);

            // Send AJAX POST request
            $.ajax({
                url: "/teacher-withraw",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    // Reload balance section to show updated data
                    $('#balance').load(location.href + ' #balance');
                    $('#withraw').modal('hide'); // Hide the modal
                    toastify().success(res.success || 'Your withdrawal is processed!');
                    $('#WithrawForm')[0].reset(); // Reset the form
                },
                error: function (err) {
                    let error = err.responseJSON;
                    if (error.errors) {
                        // Display validation errors
                        $.each(error.errors, function (index, value) {
                            toastify().error(value);
                        });
                    } else {
                        // Display any general errors
                        toastify().error(error.error || 'Something went wrong, please try again.');
                    }
                }
            });
        }
    });

    // mobile recharge
    $(document).on('click', '.m_button', function () {
        let name = $('#m_name').val();
        let number = $('#m_number').val();
        let amount = $('#m_amount').val();
        let operator = $('#m_operator').val();
        let type = $('#m_type').val();
        let password = $('#pwd').val();

        // Validate form inputs
        if (!name) {
            toastify().error('Name is required!');
        } else if (!number) {
            toastify().error('Number is required!');
        } else if (!amount) {
            toastify().error('Amount is required!');
        } else if (!operator) {
            toastify().error('Oparator is required!');
        } else if (!type) {
            toastify().error('Type is required!');
        } else if (!password) {
            toastify().error('Password is required!');
        } else {
            let formData = new FormData();
            formData.append('name', name);
            formData.append('number', number);
            formData.append('amount', amount);
            formData.append('operator', operator);
            formData.append('type', type);
            formData.append('password', password);

            // Send AJAX POST request
            $.ajax({
                url: "/mobile-recharge",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    toastify().success(res.success);
                    $('#MobileForm')[0].reset();
                },
                error: function (err) {
                    let error = err.responseJSON;
                    if (error.errors) {
                        $.each(error.errors, function (index, value) {
                            toastify().error(value);
                        });
                    } else {
                        toastify().error(error.error || 'Something went wrong, please try again.');
                    }
                }
            });
            
        }
    });

    // send proof 
    $(document).on('click', '#sendProof', function () {
        let formData = new FormData($('#proofForm')[0]);
    
        $.ajax({
            url: "/job-proofs/store", // Update to the correct route
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.success) {
                    toastify().success(res.message);
                    $('#proofForm')[0].reset();
                    $('#exampleModal').modal('hide');
                }
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
    });


});
