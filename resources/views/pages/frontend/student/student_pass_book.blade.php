@extends('layouts.master')

@section('title', "Past Book")

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
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Work</th>
                                    <th>Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ( $pass_book as $sl=>$money)
                                <tr>
                                    <td>{{$sl+1}}</td>
                                    <td>{{$money->work}}</td>
                                    <td>{{$money->amount}} &#2547;</td>
                                </tr>
                                @empty
                                <td colspan="4" class="text-center text-danger">You didn't earn yet</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{$pass_book->links()}}
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
