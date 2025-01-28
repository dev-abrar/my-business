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
                    <table class="table table-bordered " id="tabledata">
                        <thead>
                            <tr class="bg-light">
                                <th>SL#</th>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Whatsapp</th>
                                <th>Teacher</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableList">

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>


