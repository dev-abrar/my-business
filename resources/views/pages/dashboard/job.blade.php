@extends('layouts.sideNav')

@section('content')
    @include('components.job.job_create')
    @include('components.job.job_list')
@endsection

@section('footer_script')
    @include('components.job.job_js')
@endsection
