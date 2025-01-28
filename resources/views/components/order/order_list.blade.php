<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Order Request</li>
    </ol>
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-white">Order List</h3>
                    
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered" id="tabledata">
                        <thead>
                            <tr class="bg-light">
                                <th>SL#</th>
                                <th>Order_id</th>
                                <th>Total</th>
                                <th>Member</th>
                                <th>Commision</th>
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


