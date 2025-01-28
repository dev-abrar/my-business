<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Products</li>
    </ol>
    <div class="row mt-5">
        <div class="col-lg-12 m-auto">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#create_product">
                Create Product
              </button>
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-white">Product List</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered " id="dataTable">
                        <thead>
                            <tr class="bg-light">
                                <th>SL#</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>After Discount</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Preview Image</th>
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


