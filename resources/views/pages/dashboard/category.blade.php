@extends('layouts.sideNav')

@section('content')

    @include('components.category.category_list')
    @include('components.category.category_create')
    @include('components.category.category_update')
@endsection

@section('footer_script')
    @include('components.category.category_js')
@endsection