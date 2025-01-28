@extends('layouts.sideNav')

@section('content')
    @include('components.teacher.teacher_list')
    @include('components.teacher.teacher_create')
@endsection

@section('footer_script')
    @include('components.teacher.teacher_js')
@endsection
