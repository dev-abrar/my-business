@extends('layouts.sideNav')

@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h5>Welcome to dashboard</h5>
                </div>
                <div class="card-body">
                    <h3>You are logged in, {{Auth::user()->name}}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection