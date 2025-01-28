@extends('layouts.master')

@section('title', "Notification")

@section('content')
@include('pages.frontend.partial.studentNav')

<!-- ====================== Dashboard start=================  -->
<section id="refered">
    @if (Auth::guard('studentlogin')->user()->sts==1)
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6 m-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                                <tr>
                                    <th>SL#</th>
                                    <th>Title</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>{{$notify->title}}</td>
                                </tr>
                        </table>
                    </div>
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
<!-- ====================== Dashboard end=================  -->

@endsection
