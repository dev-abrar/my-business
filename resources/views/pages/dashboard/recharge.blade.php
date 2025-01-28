@extends('layouts.sideNav')

@section('content')
    @include('components.notification.recharge_list')
    @include('components.notification.recharge_update')
@endsection

@section('footer_script')
    @include('components.notification.notify_js')
@endsection