@extends('layouts.master')
@section('title', 'Single Product')

@section('content')
@include('pages.frontend.partial.studentNav')


<!-- ====================== Category  start=================  -->
<section id="allimg">
    <div class="container">
        <div class="img_head">
            <h4><a href="index.html">Home</a><a href="fashion.html"><i class="fa-solid fa-angle-right"></i>Fashion</a>
                <i class="fa-solid fa-angle-right"></i>Ladies Bag</h4>
        </div>
        <div class="img_row">
            <div class="row">
                <div class="col-lg-9 m-auto">
                    <div class="img_l_top1">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 m-auto">
                                <div class="swiper mySwiper2">
                                    <div class="swiper-wrapper">
                                        @if ($galleries->count()> 0)
                                        @foreach ($galleries as $gallery)
                                        <div class="swiper-slide">
                                            <a href="{{asset('upload/product/gallery')}}/{{$gallery->gallery}}"
                                                class="my-image-links" data-gall="gallery01"
                                                style="width: 100%; height: 100%;">
                                                <img class="w-100 img-fluid"
                                                    src="{{asset('upload/product/gallery')}}/{{$gallery->gallery}}" />
                                            </a>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="swiper-slide">
                                            <a href="{{asset('upload/product/preview')}}/{{$product_info->preview}}"
                                                class="my-image-links" data-gall="gallery01"
                                                style="width: 100%; height: 100%;">
                                                <img class="w-100 img-fluid"
                                                    src="{{asset('upload/product/preview')}}/{{$product_info->preview}}" />
                                            </a>
                                        </div>
                                        @endif

                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                                <div thumbsSlider="" class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        @if ($galleries->count()> 0)
                                        @foreach ($galleries as $gal)
                                        <div class="swiper-slide">
                                            <img src="{{asset('upload/product/gallery')}}/{{$gal->gallery}}" alt="">
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="swiper-slide">
                                            <img src="{{asset('upload/product/preview')}}/{{$product_info->preview}}"
                                                alt="">
                                        </div>
                                        @endif
                                    </div>
                                </div>



                                <div class="img_top_left text-center mt-5">
                                    <span class="badge bg-{{$product_info->qty > 0 ? 'success': 'danger'}}">{{$product_info->qty > 0 ? 'IN Stock': 'Stok Out'}}</span>
                                    <h3>{{$product_info->product_name}}</h3>
                                    <span class="sku_num">SKU: {{$product_info->sku}}</span>
                                    <div class="product_price">
                                        @if ($product_info->discount > 0)
                                        <strong>&#2547; {{$product_info->after_discount}} <span>&#2547; {{$product_info->price}}</span></strong>
                                        @else
                                        <strong>&#2547; {{$product_info->after_discount}}</strong>
                                        @endif
                                    </div>
                                    <a href="{{route('checkout', $product_info->slug)}}" class=""><i class="fa-solid fa-cart-shopping"></i> Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ========================== Product Description ============================== -->
<section id="product_desp" class="py-5">
    <div class="container">
        <div class="row">
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Description</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                    {!!$product_info->long_desp!!}
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
