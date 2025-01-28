@extends('layouts.master')

@section('title', 'My Order')

@section('content')
    @include('pages.frontend.partial.studentNav')

     <!-- ====================== order part start=================  -->
     <section id="myorder" class="py-5">
        @if (Auth::guard('studentlogin')->user()->sts==1)
        <div class="container">
            <div class="row">
                @forelse ($myorders as $order)
                    
                <div class="col-lg-6">
                    <div class="order_main">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="order_id">
                                    <h6 class="mb-3">Order ID</h6>
                                    <h5>{{$order->order_id}}</h5>
                                </div>
                                <div class="order_sts">
                                    <h6>Status</h6>
                                    @if ($order->sts==0)
                                    <span class="text-warning">Pending</span>
                                    @elseif ($order->sts==1)
                                    <span class="text-primary">Received</span>
                                    @else
                                    <span class="text-success">Completed</span>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="order_item">
                                    <div class="order_products d-flex">
                                        <div class="order_img">
                                            <img src="{{asset('upload/product/preview')}}/{{$order->rel_to_product->preview}}" class="w-100 img-fluid" alt="">
                                        </div>
                                        <div class="order_text">
                                            <h5>{{$order->rel_to_product->rel_to_category->category_name}}</h5>
                                            <h4>{{$order->rel_to_product->product_name}}</h4>
                                            <h4>&#2547; {{$order->rel_to_product->price}} X {{$order->qty}}</h4>
                                        </div>
                                    </div>
                                    <div class="order_total d-flex justify-content-between align-items-center">
                                        <p>Order Date: {{ $order->created_at->format('d-m-Y') }}</p>
                                        <p>Total: &#2547; {{$order->total}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-danger text-center">
                    <h3>You didn't complete any order yet</h3>
                </div>
                @endforelse

            </div>
            {{$myorders->links()}}
        </div>
        @else
        <div class="text-center">
            <h5 class="text-danger">You have varify your account to visit this page</h5>
        </div>
        @endif
     </section>
    <!-- ====================== order part end=================  -->
@endsection