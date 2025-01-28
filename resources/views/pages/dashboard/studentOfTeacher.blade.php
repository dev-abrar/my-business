@extends('layouts.sideNav')

@section('content')
    @include('components.teacher.teacher_student_list')
@endsection

@section('footer_script')
    @include('components.teacher.teacher_js')
@endsection
