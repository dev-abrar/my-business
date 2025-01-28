@extends('layouts.master')
@section('title', 'Salary')

@section('content')
@include('pages.frontend.partial.studentNav')
<section id="salary" class="py-5">
    @if (Auth::guard('studentlogin')->user()->sts==1)
    <div class="container">
        <div class="row salary_main">
            <div class="col-lg-6">
                <div class="salary_item d-flex flex-wrap justify-content-center">
                    <h4 class="mb-4">মাসিক স্যালারির জন্য এপ্লাই করুন ৩ হাজার থেকে ১ লক্ষ টাকা পর্যন্ত বিজনেস প্ল্যানিং।</h4>
                    <h4 class="mb-4">
                        আপনি কি মাসিক সেলারিতে আর্নিং করতে চান? 
                    </h4>
                    <h4 class="mb-4">তাহলে এখানে ক্লিক করবেন অ্যাপ্লাই নাও</h4>
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor: pointer;">Apply Now</a>
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

     <!-- ============== modal ============== -->
<!-- Modal -->
<div class="modal fade mt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form>
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Apply Now</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body single_course">
                <h4 class="mb-3">মাসিক স্যালারির জন্য আবেদন</h4>

                <div class="mb-3">
                    <label class="form-label">Whatsapp Number</label>
                    <input type="text" class="form-control" placeholder="Number">
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Apply</button>
            </div>
        </div>
        </form>
    </div>
</div>


<!-- ============== modal ============== -->
@endsection