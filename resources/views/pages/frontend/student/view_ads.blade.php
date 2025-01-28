@extends('layouts.master')
@section('title', 'View Ads')

@section('content')
@include('pages.frontend.partial.studentNav')

<section id="omrah" class="py-5">
    @if (Auth::guard('studentlogin')->user()->sts==1)
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="omrah_main text-center">
                    <h4>Comming Soon</h4>
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
@endsection