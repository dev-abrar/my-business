@extends('layouts.master')
@section('title', 'Our Products')

@section('content')
    @include('pages.frontend.partial.studentNav')

    <!-- ====================== Category  start=================  -->
    <section id="category-section">
        <div class="container">
            <div class="cmn_title text-center">
                <h3>Category</h3>
            </div>
            <div class="row category">
                @foreach ($categories as $category)
                <div class="col-lg-3 m-auto">
                    <div class="category-item">
                        <div class="category-img">
                            <span>
                                <img src="{{asset('upload/category')}}/{{$category->category_img}}" class="img-fluid w-100" alt="">
                           </span>
                        </div>
                        <div class="cagetory-name">
                            <h4>{{$category->category_name}}</h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
<!-- ====================== Category end=================  -->

<!-- ====================== Product Start=================  -->
 <section id="products" class="products-section">
    <div class="container">
        <div class="cmn_title text-center">
            <h3>Our Product</h3>
        </div>
        <div id="product-container">
            @include('pages.frontend.partial.product_list')
        </div>
        
    </div>
 </section>
<!-- ====================== Product end=================  -->
@endsection


@section('footer_script')
<script>
    $(document).ready(function () {
        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetchProducts(page);
        });

        function fetchProducts(page) {
            $.ajax({
                url: "reselling/?page=" + page,
                type: "GET",
                beforeSend: function () {
                    $('#product-container').html('<div>Loading...</div>');
                },
                success: function (response) {

                    $('#product-container').html(response);
                    $('html, body').animate({
                        scrollTop: $('.products-section').offset().top
                    }, 500);
                },
                error: function (xhr) {
                    console.error("Error fetching products:", xhr);
                }
            });
        }
    });

</script>

@endsection