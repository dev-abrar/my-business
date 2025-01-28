@extends('layouts.sideNav')

@section('content')
    @include('components.notification.withraw_list')
    @include('components.notification.withraw_update')
@endsection

@section('footer_script')
    @include('components.notification.notify_js')
@endsection