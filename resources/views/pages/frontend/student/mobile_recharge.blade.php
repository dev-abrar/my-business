@extends('layouts.master')

@section('title', 'Mobile Recharge')

@section('content')
    @include('pages.frontend.partial.studentNav')
      <!-- ====================== Mobile Reacharge=================  -->
      <section id="login-form" style="padding-bottom: 80px;">
        @if (Auth::guard('studentlogin')->user()->sts==1)
        <div class="container">
            <div class="row">
                <div class="col-lg-5 m-auto">
                    <div class="wrapper">
                        <div class="text-center mt-4">
                            <h3>Recharge</h3>
                        </div>
                        <form class="p-3 mt-3" id="MobileForm">
                            <div class="form-field d-flex align-items-center">
                                <i class="far fa-user"></i>
                                <input type="name" name="name" id="m_name" placeholder="Name*">
                            </div>
                            <div class="form-field d-flex align-items-center">
                                <i class="far fa-user"></i>
                                <input type="number" name="number" id="m_number" placeholder="Number*">
                            </div>
                            <div class="form-field d-flex align-items-center">
                                <i class="far fa-user"></i>
                                <input type="number" name="amount" id="m_amount" placeholder="Amount*">
                            </div>
                        
                            <div class="form-field">
                                <select data-mdb-select-init id="m_operator">
                                    <option value="">--select oparetor--</option>
                                    <option value="1">Grameenphone </option>
                                    <option value="2">Banglalink  </option>
                                    <option value="3">Teletalk </option>
                                    <option value="4">Robi </option>                  
                                  </select>
                            </div>
                            <div class="form-field">
                                <select data-mdb-select-init id="m_type">
                                    <option value="">--select type--</option>
                                    <option value="1">Prepaid</option>
                                    <option value="2">Postpaid</option>
                                    <option value="3">Skitto</option>
                                  
                                  </select>
                            </div>
                            <div class="form-field d-flex align-items-center">
                                <i class="fas fa-key"></i>
                                <input type="password" name="password" id="pwd" placeholder="Password">
                                <i class="fas fa-eye" id="toggle-password" style="cursor: pointer;"></i>
                            </div>

                            <button type="button" class="btn mt-3 m_button">Submit</button>
                        </form>
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
    <!-- ====================== Mobile Recharge=================  -->
@endsection