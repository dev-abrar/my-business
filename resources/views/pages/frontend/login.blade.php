@extends('layouts.master')
@section('title', 'Login Page')
@section('content')
@include('pages.frontend.partial.header')
<!-- ====================== Login Form Start=================  -->

<section id="login-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 m-auto">
                <div class="wrapper">
                    <div class="text-center mt-4">
                        <h3>Sign In</h3>
                    </div>
                    <form class="p-3 mt-3" id="login-form" action="{{ route('frontend.login.post') }}" method="POST">
                        @csrf
                        <div class="form-field">
                            <select id="role" name="role" data-mdb-select-init>
                                <option value="">--Select Any--</option>
                                <option value="1">Teacher</option>
                                <option value="2">Student</option>
                            </select>
                        </div>
                        @error('role')
                        <script>
                            toastify().error("{{ $message }}");
                        </script>
                        @enderror
                        <div class="form-field d-flex align-items-center">
                            <i class="far fa-user"></i>
                            <input type="email" name="email" id="email" placeholder="Email Address">
                        </div>
                        @error('email')
                        <script>
                            toastify().error("{{ $message }}");
                        </script>
                        @enderror
                        <div class="form-field d-flex align-items-center">
                            <i class="fas fa-key"></i>
                            <input type="password" name="password" id="pwd" placeholder="Password">
                            <i class="fas fa-eye" id="toggle-password" style="cursor: pointer;"></i>

                        </div>
                        @error('password')
                        <script>
                            toastify().error("{{ $message }}");
                        </script>
                        @enderror
                        <button type="submit" class="btn mt-3">Login</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@if (session('error'))
<script>
    toastify().error("{{ session('error') }}");
</script>
@endif

<!-- ====================== Login Form end=================  -->
@include('pages.frontend.partial.footer');
@endsection
