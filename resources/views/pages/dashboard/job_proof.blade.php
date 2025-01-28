@extends('layouts.sideNav')

@section('content')
    @include('components.job_proof.proof_list')
    @include('components.job_proof.proof_update')
@endsection

@section('footer_script')
    @include('components.job_proof.proof_js')
@endsection
