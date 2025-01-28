@php
    $webcontent = App\Models\WebContent::where('id', 1)->first();
@endphp

@extends('layouts.master')
@section('title', 'My Business Website')
@section('content')
@include('pages.frontend.partial.header')
<!-- ====================== banner start  =================  -->
<section id="banner">
    <div id="particles-js"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner_left">
                    <div class="sign_up">
                        <a href="{{ route('frontend.login') }}"> Login <i class="fa-solid fa-arrow-right-long"></i></a>
                        <a href="{{ route('login') }}">Admin Login <i class="fa-solid fa-arrow-right-long"></i></a>
                    </div>
                    <h1><span class="typed"></span></h1>
                    <p>{{$webcontent->desp}}</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner_right">
                    <img src="{{ asset('frontend') }}/images/banner.png" class="w-100 img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ====================== banner end  =================  -->

<!-- ====================== Project part start  =================  -->
<section id="project">
    <div class="container">
        <div class="heading">
            <h3>Our Product</h3>
        </div>

        <div class="row mt-5">
            @foreach ($products as $product)
            <div class="col-lg-3">
                <div class="product-item">
                    <a href="{{route('single.product', $product->slug)}}">
                        <div class="product-img">
                            <img src="{{asset('upload/product/preview')}}/{{$product->preview}}" class="img-fluid w-100"
                                alt="">
                        </div>
                        <div class="product-name">
                            <h3>{{substr($product->product_name,0,25)}}</h3>
                            @if ($product->discount > 0)
                            <strong>&#2547; {{$product->after_discount}}
                                <span>&#2547;{{$product->price}}</span></strong>
                            @else
                            <strong>&#2547; {{$product->after_discount}}</strong>
                            @endif


                        </div>
                    </a>
                </div>
            </div>
            @endforeach

        </div>

    </div>
</section>
<!-- ====================== Project part end  =================  -->
@include('pages.frontend.partial.footer')
@endsection
