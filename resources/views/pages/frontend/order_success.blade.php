@extends('layouts.master')
@section('title', 'Order Success')

@section('content')
@include('pages.frontend.partial.studentNav')


<section id="simple-form" class="mt-5">
    <div class="container">
       <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="order_success_item text-center">
                <i style="font-size: 40px;" class="fa-solid fa-heart text-success"></i>
                <h3 style="font-size: 34px; font-weight: 600;">Your Order is Completed!</h3>
                <p style="font-size: 16px;">Your order has been completed. Your Order ID is #{{$order_id}}</p>
                <a class="btn btn-dark" href="{{route('resell.product')}}">Shop Again</a>
            </div>
        </div>
       </div>
    </div>
</section>
@endsection
