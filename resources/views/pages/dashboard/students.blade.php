@extends('layouts.sideNav')

@section('content')
@include('components.student.student_list')
@include('components.student.student_create')
@endsection

@section('footer_script')
    @include('components.student.student_js')
@endsection
