@php
$webcontent = App\Models\WebContent::where('id', 1)->first();
@endphp
@extends('layouts.master')
@section('title', 'Checkout')

@section('content')
@include('pages.frontend.partial.studentNav')
<!-- ====================== checkout  start=================  -->
<section id="checkout">
    <div class="container">
        <div class="cmn_title text-center">
            <h2>Checkout Product</h2>
        </div>
        <div class="row">
            <div class="col-lg-6 m-auto">
                <form action="{{route('checkout.order')}}" method="POST">
                    @csrf
                    <div class="cart_single_caption">
                        <div class="cart_img">
                            <img src="{{asset('upload/product/preview')}}/{{$product_info->preview}}"
                                class="img-fluid w-100" alt="">
                        </div>
                        <div class="cart_details">
                            <h4 class="product_title">{{substr($product_info->product_name, 0,20)}}</h4>
                            <h4 class="price">৳ <span id="total_price">{{$product_info->after_discount}}</span></h4>
                            <div class="quantity">
                                <a href="#" class="quantity__minus"
                                    onclick="updateQty(event, -1, {{$product_info->after_discount}})"><span>-</span></a>
                                <input name="qty" type="text" class="quantity__input" id="qty_input" value="1" readonly>
                                <a href="#" class="quantity__plus"
                                    onclick="updateQty(event, 1, {{$product_info->after_discount}})"><span>+</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="card card_2" style="border: 1px solid #ddd;">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">নাম *</label>
                                <input type="text" name="name" class="form-control" style="border-radius: 0px;">
                                @error('name')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">মোবাইল নাম্বার *</label>
                                <input type="number" name="number" class="form-control" style="border-radius: 0px;">
                                @error('number')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">জেলা *</label>
                                <input type="text" name="district" class="form-control" style="border-radius: 0px;">
                                @error('district')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">উপজেলা *</label>
                                <input type="text" name="city" class="form-control" style="border-radius: 0px;">
                                @error('city')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">ঠিকানা *</label>
                                <textarea name="address" maxlength="250" class="form-control" id="" cols="20" rows="10"
                                    style="height: 150px;
                                "></textarea>
                                @error('address')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">অতিরিক্ত ঠিকানা *</label>
                                <textarea name="extra_address" maxlength="250" class="form-control" id="" cols="20"
                                    rows="10" style="height: 150px;
                                "></textarea>

                            </div>
                            <div class="mb-3">
                                <h5>ডেলিভারি চার্জঃ &#2547; <span>60</span></h5>
                                <input type="hidden" name="charge" value="{{$webcontent->charge}}">
                                <input type="hidden" name="product_id" value="{{$product_info->id}}">
                                <input type="hidden" name="price" value="{{$product_info->after_discount}}">
                            </div>
                            @if (Auth::guard('studentlogin')->id())
                            <div class="mb-3">
                                <label class="form-label text-primary">Commision:
                                    &#2547;{{$product_info->commision > 0?$product_info->commision:'0'}}</label>
                                <input type="hidden" name="student_id" value="{{Auth::guard('studentlogin')->id()}}">
                                <input type="hidden" name="commision" value="{{$product_info->commision}}">
                            </div>
                            @endif
                            <div class="mb-3">
                                <button type="submit" class="btn">Place Your Order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('footer_script')
<script>
    function updateQty(event, change, pricePerUnit) {
        event.preventDefault();

        // Get the quantity input field and current value
        let qtyInput = document.getElementById('qty_input');
        let currentQty = parseInt(qtyInput.value);

        // Calculate the new quantity
        let newQty = currentQty + change;

        // Ensure quantity is between 1 and 10
        if (newQty < 1) {
            newQty = 1;
        } else if (newQty > 10) {
            newQty = 10;
        }

        // Update the quantity input field
        qtyInput.value = newQty;

        // Calculate the new total price
        let newTotalPrice = newQty * pricePerUnit;

        // Update the total price display
        document.getElementById('total_price').innerText = newTotalPrice.toFixed(2);
    }

</script>
@endsection
