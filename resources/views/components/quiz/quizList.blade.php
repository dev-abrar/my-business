<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Quiz-List</li>
    </ol>
    <div class="row mt-3">
        <div class="col-lg-12">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <button type="button" class="btn btn-primary mb-3" style="width: 10%" data-bs-toggle="modal"
                data-bs-target="#create_quiz">
                Create Quiz
            </button>
            <div class="card">

                <div class="card-header bg-info">
                    <h3 class="text-white">Add New Quiz Question</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered " id="tabledata">
                        <thead>
                            <tr class="bg-light">
                                <th>SL#</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quizes as $sl=>$quiz )
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$quiz->question_text}}</td>
                                <td>{{$quiz->correct_answer}}</td>
                                <td>
                                    
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#update_quiz"
                                        data-id="{{ $quiz->id }}" data-question="{{ $quiz->question_text }}"
                                        data-options="{{ json_encode($quiz->options) }}"
                                        data-correct-answer="{{ $quiz->correct_answer }}">
                                        Update Quiz
                                    </button>

                                    <button class="btn btn-danger deleteBtn" id=""
                                        data-id="{{ $quiz->id }}">Delete</button>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
