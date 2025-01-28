@extends('layouts.master')

@section('title', "Teacher Balance")

@section('content')
@include('pages.frontend.partial.teacherNav')

<!-- ====================== balance part start=================  -->
<section id="balance" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="balance_item text-center">
                    <h5>Total Balance</h5>
                    <h4>&#2547; {{$totalBalance}}</h4>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="balance_item text-center">
                    <h5>Available Balance</h5>
                    <h4>&#2547; {{$availableBalance}}</h4>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="balance_item text-center">
                    <h5>Total Withraw</h5>
                    <h4>&#2547; {{$totalWithdrawn}}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 m-auto">
                <div class="withraw_balance">
                    <button type="button" class="btn btn-success form-control" data-bs-toggle="modal"
                        data-bs-target="#withraw">
                        Withraw Balance
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ====================== balance part end=================  -->

<!-- Modal -->
<div class="modal fade mt-5 pb-5" id="withraw" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="WithrawForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Withraw Money</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body refered_stutednt">

                    <div class="mb-3">
                        <label>Amount</label>
                        <input type="number" class="form-control t_withraw_amount">
                        <input type="hidden" class="form-control t_withraw_student_id">
                    </div>
                    <div class="mb-3">
                        <select class="form-control t_withraw_method">
                            <option value="">--select oparetor--</option>
                            <option value="1">Bkash </option>
                            <option value="2">Nagad </option>
                            <option value="3">Rocket </option>
                            <option value="4">Bank</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Number</label>
                        <input type="number" class="form-control t_withraw_number">
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control t_withraw_password">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success t_withraw_btn">Withraw</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
