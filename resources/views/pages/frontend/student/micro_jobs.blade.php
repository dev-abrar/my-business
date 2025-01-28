@extends('layouts.master')
@section('title', 'Microjobs')

@section('content')
@include('pages.frontend.partial.studentNav')

 <!-- ====================== jobs part start =================  -->
 <section id="job">
    @if (Auth::guard('studentlogin')->user()->sts==1)
    <div class="container">
        <div class="cmn_title text-center">
            <h3>Our Jobs</h3>
        </div>

        <div class="row">
            @forelse ($jobs as $job)
            <div class="col-lg-3">
                <div class="product-item">
                    <a href="{{route('single.job', $job->id)}}">
                        <div class="product-img">
                            <img src="{{asset('upload/job')}}/{{$job->image}}" class="img-fluid w-100" alt="">
                        </div>
                        <div class="product-name">
                            <h3>{{substr($job->desp, 0,30)}}</h3>
                            <span class="product-price">&#2547; {{$job->amount}}</span>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="text-center text-danger">
                <h4>Ther is no job availabe!</h4>
            </div>
            @endforelse
        </div>
        {{$jobs->links()}}
    </div>
    @else
    <div class="text-center">
        <h5 class="text-danger">You have varify your account to visit this page</h5>
    </div>
    @endif
</section>
    <!-- ====================== jobs part end =================  -->
@endsection