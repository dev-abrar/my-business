@extends('layouts.master')
@section('title', 'Our Course')

@section('content')
@include('pages.frontend.partial.studentNav')

  <!-- ====================== jobs part start =================  -->
  <section id="job">
    @if (Auth::guard('studentlogin')->user()->sts==1)
    <div class="container">
        <div class="cmn_title text-center">
            <h3>Our Course</h3>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="product-item">
                    <a >
                        <div class="product-img">
                            <img src="{{asset('frontend/images/cr-1.jpeg')}}" class="img-fluid w-100" alt="">
                        </div>
                        <div class="product-name">
                            <h3>Digital Marketing</h3>
                            <a style="padding: 10px 20px; border-radius: 5px;" class="bg-primary text-white">Comming soon</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="product-item">
                    <a >
                        <div class="product-img">
                            <img src="{{asset('frontend/images/cr-2.jpeg')}}" class="img-fluid w-100" alt="">
                        </div>
                        <div class="product-name">
                            <h3>Web Development</h3>
                            <a style="padding: 10px 20px; border-radius: 5px;" class="bg-primary text-white">Comming soon</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="product-item">
                    <a >
                        <div class="product-img">
                            <img src="{{asset('frontend/images/cr-3.jpeg')}}" class="img-fluid w-100" alt="">
                        </div>
                        <div class="product-name">
                            <h3>CPA Marketing</h3>
                            <a style="padding: 10px 20px; border-radius: 5px;" class="bg-primary text-white">Start Date: 01.03.2025</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="product-item">
                    <a >
                        <div class="product-img">
                            <img src="{{asset('frontend/images/cr-4.jpeg')}}" class="img-fluid w-100" alt="">
                        </div>
                        <div class="product-name">
                            <h3>Data Entry</h3>
                            <a style="padding: 10px 20px; border-radius: 5px;" class="bg-primary text-white">Comming soon</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="product-item">
                    <a >
                        <div class="product-img">
                            <img src="{{asset('frontend/images/cr-5.jpeg')}}" class="img-fluid w-100" alt="">
                        </div>
                        <div class="product-name">
                            <h3>Arabic Learning</h3>
                            <a style="padding: 10px 20px; border-radius: 5px;" class="bg-primary text-white">Start Date: Romadaan</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="product-item">
                    <a >
                        <div class="product-img">
                            <img src="{{asset('frontend/images/cr-6.jpeg')}}" class="img-fluid w-100" alt="">
                        </div>
                        <div class="product-name">
                            <h3>Video Editing</h3>
                            <a style="padding: 10px 20px; border-radius: 5px;" class="bg-primary text-white">Runnig</a>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
    </div>
    @else
    <div class="text-center">
        <h5 class="text-danger">You have varify your account to visit this page</h5>
    </div>
    @endif
   </section>
    <!-- ====================== jobs part end =================  -->

        <!-- ============== modal ============== -->
    <!-- Modal -->
    <div class="modal fade mt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">JOIN COURSE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body single_course">
                    <h4>To Join this course contact : <span>01862756814</span></h4>
                </div>
            </div>
        </div>
    </div>


    <!-- ============== modal ============== -->
@endsection