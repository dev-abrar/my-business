@extends('layouts.sideNav')

@section('content')
    @include('components.users.user_list')
    @include('components.users.user_create')
@endsection

@section('footer_script')
    @include('components.users.user_js')
@endsection
