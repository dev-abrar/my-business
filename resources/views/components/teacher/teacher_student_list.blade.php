<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Students</li>
    </ol>
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-white">Student List</h3>
                    
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered " id="tabledataStudent">
                        <thead>
                            <tr class="bg-light">
                                <th>SL#</th>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Whatsapp</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableListStudent">
                            @forelse ( $students as $sl=>$student)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$student->name}}</td>
                                <td>{{$student->email}}</td>
                                <td>{{$student->number}}</td>
                                <td>
                                    <button data-id="{{$student->id}}" class="btn btn-danger student_delete">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div class="text-danger text-center">No student here</div>
                                </td>
                            </tr>
                            @endforelse
                                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


