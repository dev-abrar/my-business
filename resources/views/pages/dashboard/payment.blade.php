@extends('layouts.sideNav')
@section('header')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        height: 40px;
        display: flex;
        align-items: center;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
    }

</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header bg-info">
                <h4>Pay Students</h4>
            </div>
            <div class="card-body">
                <form id="studentForm">
                    <div class="mb-3">
                        <label class="form-label">Work</label>
                        <input type="text" class="form-control" id="student_name" placeholder="Work Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" class="form-control" id="student_amount" placeholder="Amount">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Student Name</label>
                        <select class="form-select" id="student_id" style="width: 100%;">
                            <option value="">-- Select Student --</option>
                            @foreach ($students as $student)
                            <option value="{{$student->id}}">{{$student->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary student_pay">Pay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-info">
                <h4>Pay Teacher</h4>
            </div>
            <div class="card-body">
                <form id="teacherForm">
                    <div class="mb-3">
                        <label class="form-label">Work</label>
                        <input type="text" class="form-control" id="teacher_name" placeholder="Work Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" class="form-control" id="teacher_amount" placeholder="Amount">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teacher Name</label>
                        <select class="form-select" id="teacher_id" style="width: 100%;">
                            <option value="">-- Select Teacher --</option>
                            @foreach ($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary teacher_pay">Pay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footer_script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).ready(function () {
            // Initialize Select2 on the #student_id element
            $('#student_id').select2();
            $('#teacher_id').select2();
        });
    });

</script>

<script>
    $(document).ready(function(){
        
        $(document).on('click', '.student_pay', function(){
            let name = $('#student_name').val();
            let amount = $('#student_amount').val();
            let student_id = $('#student_id').val();

            if (!name) {
                toastify().error('Work Name is required!');
            } else if (!amount) {
                toastify().error('Amount is required!');
            } else if (!student_id) {
                toastify().error('Student Name is required!');
            } else {
                let formData = new FormData();
                formData.append('name', name);
                formData.append('amount', amount);
                formData.append('student_id', student_id);
                

                $.ajax({
                    url: "{{ route('payment.student') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        toastify().success('Student Payment Successfull!');
                        $("#studentForm")[0].reset();
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

               
        $(document).on('click', '.teacher_pay', function(){
            let name = $('#teacher_name').val();
            let amount = $('#teacher_amount').val();
            let teacher_id = $('#teacher_id').val();

            if (!name) {
                toastify().error('Work Name is required!');
            } else if (!amount) {
                toastify().error('Amount is required!');
            } else if (!teacher_id) {
                toastify().error('Teacher Name is required!');
            } else {
                let formData = new FormData();
                formData.append('name', name);
                formData.append('amount', amount);
                formData.append('teacher_id', teacher_id);
                

                $.ajax({
                    url: "{{ route('payment.teacher') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        toastify().success('Teacher Payment Successfull!');
                        $("#teacherForm")[0].reset();
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
    });
</script>
@endsection
