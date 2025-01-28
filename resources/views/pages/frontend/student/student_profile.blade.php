@extends('layouts.master')

@section('title', 'My Profile')

@section('content')
    @include('pages.frontend.partial.studentNav')

    <!-- ====================== profile start=================  -->
    <section id="profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="profile_main" id="StudentProfileMain">
                        <div class="profile_img">
                            @if (Auth::guard('studentlogin')->user()->photo != null)
                            <img style="object-fit: cover;" class="w-100 img-fluid"
                                src="{{asset('upload/student')}}/{{Auth::guard('studentlogin')->user()->photo}}" alt="profile">
                            @else
                            <img class="w-100 img-fluid"
                                src="{{ Avatar::create(Auth::guard('studentlogin')->user()->name)->toBase64() }}" />
                            @endif
                        </div>
                        <h5>{{Auth::guard('studentlogin')->user()->name}}</h5>
                        <h6>Refer Code: <span id="refer_code">{{Auth::guard('studentlogin')->user()->refer_code}}</span></h6>
                        <form id="StudentProfileFrom">
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" id="update_student_name" class="form-control"
                                    value="{{Auth::guard('studentlogin')->user()->name}}">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="text" id="update_student_email" class="form-control"
                                    value="{{Auth::guard('studentlogin')->user()->email}}">
                            </div>
                            <div class="mb-3">
                                <label>Whatsapp</label>
                                <input type="number" id="update_student_number" class="form-control"
                                    value="{{Auth::guard('studentlogin')->user()->number}}">
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" id="update_student_password" class="form-control" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <label>Image</label>
                                <input type="file" id="update_student_photo" class="form-control">
                            </div>
                            <div class="mb-3 text-center">
                                <button type="button" class="update_student">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====================== profile end=================  -->
@endsection
