<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Quiz Submission List</li>
    </ol>
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header bg-info">
                    <h3 class="text-white">Quize Submission List</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered " id="tabledata">
                        <thead>
                            <tr class="bg-light">
                                <th>SL#</th>
                                <th>Name</th>
                                <th>Score</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($submits as $sl=>$submit )
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$submit->rel_to_student->name}}</td>
                                <td>{{$submit->correct_answers_count}}</td>
                                <td>
                                    <button class="btn btn-danger submitdelete" 
                                        data-id="{{ $submit->id }}">Delete</button>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                {{$submits->links()}}
            </div>
        </div>
    </div>
</div>
