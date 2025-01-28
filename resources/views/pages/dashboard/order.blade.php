@extends('layouts.sideNav')

@section('content')
    @include('components.order.order_list')
    @include('components.order.order_update')
@endsection

@section('footer_script')
    @include('components.order.order_js')
@endsection