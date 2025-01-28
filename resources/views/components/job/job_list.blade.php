<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Microjobs</li>
    </ol>
    <div class="row mt-5">
        <div class="col-lg-12">
            <button type="button" class="btn btn-success mb-3 ms-auto" data-bs-toggle="modal" data-bs-target="#create_category">
                Create Job
              </button>
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-white">Job List</h3>
                    
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered" id="tabledata">
                        <thead>
                            <tr class="bg-light">
                                <th>SL#</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Image</th>
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


