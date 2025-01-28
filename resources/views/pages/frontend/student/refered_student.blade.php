@extends('layouts.master')

@section('title', 'My Refered Student')

@section('content')
@include('pages.frontend.partial.studentNav')


<!-- ====================== profile start=================  -->
<section id="refered" class="student_list">
    @if (Auth::guard('studentlogin')->user()->sts==1)
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6 m-auto">
                <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#student">
                    Add Student
                </button>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Total Students: {{$total_student}}</h4>
                        <h4>Active: {{$active}}</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $sl=>$student )
                                <tr>
                                    <td>{{$sl+1}}</td>
                                    <td>{{$student->name}}</td>
                                    <td>{{$student->email}}</td>
                                    <td>{{$student->number}}</td>
                                </tr>
                                @empty
                                <td colspan="4" class="text-center text-danger">You didn't sign up any student yet</td>
                                @endforelse
                            </tbody>
                        </table>
                        {{$students->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center">
        <h5 class="text-danger">You have varify your account to visit this page</h5>
    </div>
    @endif
</section>
<!-- ====================== profile end=================  -->

<!-- Modal -->
<div class="modal fade mt-5 pb-5" id="student" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body refered_stutednt">
                <form id="studentFrom">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" id="student_name" placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="text" class="form-control" id="student_email" placeholder="example@gmail.com">
                    </div>
                    <div class="mb-3">
                        <label>Number</label>
                        <input type="number" class="form-control" id="student_number" placeholder="Number">
                    </div>
                    <div class="mb-3">
                        <label>Refered ID</label>
                        <input type="text" readonly class="form-control" id="refer_by"
                            value="{{Auth::guard('studentlogin')->user()->refer_code}}">
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control" id="student_password" placeholder="Password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success add_student">Sign Up</button>
            </div>
        </div>
    </div>
</div>

@endsection
