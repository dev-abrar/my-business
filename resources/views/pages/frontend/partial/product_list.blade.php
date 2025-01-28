<div class="row">
    @foreach ($products as $product)
    <div class="col-lg-3">
        <div class="product-item">
            <a href="{{route('single.product', $product->slug)}}">
                <div class="product-img">
                    <img src="{{asset('upload/product/preview')}}/{{$product->preview}}" class="img-fluid w-100" alt="">
                </div>
                <div class="product-name">
                    <h3>{{substr($product->product_name,0,25)}}</h3>
                    @if ($product->discount > 0)
                    <strong>&#2547; {{$product->after_discount}} <span>&#2547;{{$product->price}}</span></strong>
                    @else
                    <strong>&#2547; {{$product->after_discount}}</strong>
                    @endif
                    
                    
                </div>
            </a>
        </div>
    </div>
    @endforeach
    
</div>

<div id="pagination-links">
    {{ $products->links() }}
</div>