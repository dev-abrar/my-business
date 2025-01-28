@php
$webcontent = App\Models\WebContent::where('id', 1)->first();
@endphp
@extends('layouts.master')
@section('title', 'Student Dashboard')

@section('content')
@include('pages.frontend.partial.studentNav')
<!-- ====================== Dashboard start=================  -->
<section id="dashboard">
    <div class="container">
        <div class="account_status mb-5">
            @if (Auth::guard('studentlogin')->user()->sts==1)
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="status_main text-center">
                        <span class="bg-success"
                            style="display: inline-block; width: 60px; height: 60px; line-height: 77px; border-radius: 50%;"><i
                                class="text-white fa-solid fa-check"></i></span>
                        <h4>Your Account is varified.</h4>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="status_main text-center">
                        <i class="text-danger fa-solid fa-triangle-exclamation"></i>
                        <h4>Varify your account.</h4>
                        <button data-bs-toggle="modal" class="btn btn-success" data-bs-target="#varify">Varify</button>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="dsahboard_main">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="dash_item">
                        <a href="{{route('mobile.recharge')}}">
                            <div class="dashb_img">
                                <img src="{{asset('frontend')}}/images/mobile.png" class="w-100 img-fluid" alt="">
                            </div>
                            <h4>Mobile Recharge</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="dash_item">
                        <a href="{{route('resell.product')}}">
                            <div class="dashb_img">
                                <img src="{{asset('frontend')}}/images/shop.png" class="w-100 img-fluid" alt="">
                            </div>
                            <h4>Reselling</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="dash_item">
                        <a href="{{route('microjob')}}">
                            <div class="dashb_img">
                                <img src="{{asset('frontend')}}/images/jobs.png" class="w-100 img-fluid" alt="">
                            </div>
                            <h4>Microjobs</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="dash_item">
                        <a href="{{route('view.ads')}}">
                            <div class="dashb_img">
                                <img src="{{asset('frontend')}}/images/ads.png" class="w-100 img-fluid" alt="">
                            </div>
                            <h4>View Ads</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="dash_item">
                        <a href="{{route('month.salary')}}">
                            <div class="dashb_img">
                                <img src="{{asset('frontend')}}/images/salary.png" class="w-100 img-fluid" alt="">
                            </div>
                            <h4>Salary</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="dash_item">
                        <a href="{{route('our.course')}}">
                            <div class="dashb_img">
                                <img src="{{asset('frontend')}}/images/course.png" class="w-100 img-fluid" alt="">
                            </div>
                            <h4>Our Course</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="dash_item">
                        <a href="{{route('our.quize')}}">
                            <div class="dashb_img">
                                <img src="{{asset('frontend')}}/images/quize.png" class="w-100 img-fluid" alt="">
                            </div>
                            <h4>Quize</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="dash_item">
                        <a href="{{route('omrah')}}">
                            <div class="dashb_img">
                                <img src="{{asset('frontend')}}/images/haj.png" class="w-100 img-fluid" alt="">
                            </div>
                            <h4>Free Omrah</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="dash_item">
                        <a href="{{route('quran')}}">
                            <div class="dashb_img">
                                <img src="{{asset('frontend')}}/images/quran.png" class="w-100 img-fluid" alt="">
                            </div>
                            <h4>Free Quran</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="dash_item">
                        <a href="{{route('bandle.offer')}}">
                            <div class="dashb_img">
                                <img src="{{asset('frontend')}}/images/offer.png" class="w-100 img-fluid" alt="">
                            </div>
                            <h4>Drive Offer</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ====================== Dashboard end=================  -->


<!-- Modal -->
<div class="modal fade mt-5 pb-5" id="varify" tabindex="-1" aria-labelledby="varifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="VarifyForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varifyModalLabel">To Varify your Account you have to pay 100 tk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body refered_stutednt">

                    <div class="mb-3">
                        <label>--Select Payment Method--</label>
                        <select class="form-control" id="paymentMethod" >
                            <option value="">--Select--</option>
                            <option value="bkash">Bkash</option>
                            <option value="nagad">Nagad</option>
                            <option value="rocket">Rocket</option>
                        </select>
                    </div>
                    <div class="mb-3 payment-info d-none" id="bkashInfo">
                        <label>Bkash Account Number</label>
                        <input type="hidden" class="student_id" value="{{Auth::guard('studentlogin')->id()}}">
                        <input readonly type="text" class="form-control bg-secondary text-white" value="{{$webcontent->bkash}}">
                    </div>
                    <div class="mb-3 payment-info d-none" id="nagadInfo">
                        <label>Nagad Account Number</label>
                        <input readonly type="text" class="form-control bg-secondary text-white" value="{{$webcontent->nagad}}">
                    </div>
                    <div class="mb-3 payment-info d-none" id="rocketInfo">
                        <label>Rocket Account Number</label>
                        <input readonly type="text" class="form-control bg-secondary text-white" value="{{$webcontent->rocket}}">
                    </div>
                    <div class="mb-3">
                        <label>Amount</label>
                        <input readonly type="text" class="amount form-control bg-secondary text-white" value="100">
                    </div>
                    <div class="mb-3">
                        <label>Transaction</label>
                        <input type="text" class="form-control transaction">
                    </div>
                    <div class="mb-3">
                        <label>Account Number</label>
                        <input type="number" class="form-control account_number">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success varify">Pay</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
