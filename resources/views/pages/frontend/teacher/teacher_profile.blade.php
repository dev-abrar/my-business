@extends('layouts.master')
@section('title', 'Teacher Profile')
@section('content')
@include('pages.frontend.partial.teacherNav')

<!-- ====================== Dashboard start=================  -->
<section id="profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="profile_main" id="ProfileMain">
                    <div class="profile_img">
                        @if (Auth::guard('teacherlogin')->user()->photo != null)
                        <img style="object-fit: cover;" class="w-100 img-fluid"
                            src="{{asset('upload/teacher')}}/{{Auth::guard('teacherlogin')->user()->photo}}" alt="profile">
                        @else
                        <img class="w-100 img-fluid"
                            src="{{ Avatar::create(Auth::guard('teacherlogin')->user()->name)->toBase64() }}" />
                        @endif
                    </div>
                    <h5>{{Auth::guard('teacherlogin')->user()->name}}</h5>
                    <form id="ProfileFrom">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" id="teacher_name" class="form-control"
                                value="{{Auth::guard('teacherlogin')->user()->name}}">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="text" id="teacher_email" class="form-control"
                                value="{{Auth::guard('teacherlogin')->user()->email}}">
                        </div>
                        <div class="mb-3">
                            <label>Whatsapp</label>
                            <input type="number" id="teacher_number" class="form-control"
                                value="{{Auth::guard('teacherlogin')->user()->number}}">
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" id="teacher_password" class="form-control" placeholder="Password">
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" id="teacher_photo" class="form-control">
                        </div>
                        <div class="mb-3 text-center">
                            <button type="button" class="update_teacher">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ====================== Dashboard end=================  -->
@endsection
