@extends('layouts.master')
@section('title', 'Teachers Dashboard')
@section('content')
@include('pages.frontend.partial.teacherNav')
<!-- ====================== Dashboard start=================  -->
<section id="refered">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6 m-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Total Students: {{$total_students}}</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $sl=>$student )
                                    <tr>
                                        <td>{{$sl+1}}</td>
                                        <td>{{$student->name}}</td>
                                        <td>{{$student->email}}</td>
                                        <td>{{$student->number}}</td>
                                    </tr>
                                    @empty
                                    <td colspan="4" class="text-center text-danger">No student yet</td>
                                    @endforelse
                            </tbody>
                        </table>
                        {{$students->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ====================== Dashboard end=================  -->

@endsection
