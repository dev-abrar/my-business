@extends('layouts.sideNav')

@section('content')
    @include('components.notification.varify_list')
    @include('components.notification.varify_update')
@endsection

@section('footer_script')
    @include('components.notification.notify_js')
@endsection