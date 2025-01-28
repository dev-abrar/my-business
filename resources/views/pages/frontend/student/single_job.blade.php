@extends('layouts.master')
@section('title', 'Single Job')

@section('content')
@include('pages.frontend.partial.studentNav')

<!-- ====================== Category  start=================  -->
<section id="singleJob" >
    @if (Auth::guard('studentlogin')->user()->sts==1)
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="job_img">
                    <img src="{{asset('upload/job')}}/{{$job_info->image}}" class="w-100 img-fluid" alt="">
                </div>
                <h4 class="text-center">Your Work : {{$job_info->desp}}</h4>
                <div class="job_btn text-center mt-5">
                    <a href="{{$job_info->link}}" class="link">Link</a>
                    <button class="link" data-bs-toggle="modal" data-bs-target="#exampleModal">Send Proof</button>
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
<!-- ====================== Category end=================  -->

<!-- ============== modal ============== -->
<!-- Modal -->
<div class="modal fade mt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">SEND PROOF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="proofForm">
                    @csrf <!-- Add CSRF Token -->
                    <div class="mb-3">
                        <label class="form-label">Screenshot</label>
                        <input type="file" name="images[]" multiple class="form-control">
                        <input type="hidden" name="student_id" value="{{ Auth::guard('studentlogin')->id() }}">
                        <input type="hidden" name="job_id" value="{{ $job_info->id }}"> <!-- Dynamic Job ID -->
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="desp"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="sendProof">SEND</button>
            </div>
        </div>
    </div>
</div>

<!-- ============== modal ============== -->
@endsection