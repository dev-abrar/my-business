@extends('layouts.master')
@section('title', 'Free Quran')

@section('content')
@include('pages.frontend.partial.studentNav')
<section id="omrah" class="py-5">
    @if (Auth::guard('studentlogin')->user()->sts==1)
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="omrah_main text-center">
                    <h4>প্রতিদিন বিকেল ৩ টা থেকে ৪ টা পর্যন্ত চলবে</h4>
                    <h4>বিদ্রঃ শুক্রবার-শনিবার ক্লাস বন্ধ থাকবে।</h4>
                    <a class="btn btn-success mt-4" href="#">Link</a>
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
