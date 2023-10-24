
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Our Products</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
     @forelse($products as $productItem)
 
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    @if ($productItem->quantity > 0)
                    <label class="stock in-stock">In Stock</label>  
                  @else
                    <label class="stock out-of-stock">Out of Stock</label>  
                  @endif
                  
                  @if($productItem->productImages->count() > 0)
                  <a href="{{ url('collections/'.$productItem->category->slug.'/'.$productItem->slug)}}" class="btn btn-sm text-dark p-0">
            
                  <img class="img-fluid w-100" src="{{ asset($productItem->productImages[0]->image)}}" alt="{{$productItem->name}}">
                </a>
                  @endif
              </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                  <p class="product-brand">{{ $productItem->brand }}</p>  
                  <h6 class="text-truncate mb-3">{{$productItem->name}}</h6>
                    <div class="d-flex justify-content-center">
                       
                         @if($productItem->original_price!=null)
                         <h6>₱{{$productItem->selling_price}}</h6>
                         <h6 class="text-muted ml-2">
                         <del>₱{{$productItem->original_price}}</del>
                        </h6>
                         @else
                         <h6>₱{{$productItem->selling_price}}</h6>
                          @endif
                   
                    </div>
                </div>
            </div>
        </div>
        
        @empty
        <div class="col-md-12">
          <div class="p-2">
              <h4>No Products Available</h4>
          </div>
        </div>
        @endforelse
     {{-- <span style="padding-top: 20px">
        {!!$products->withQueryString()->links('pagination::bootstrap-5')!!}
     </span> --}}
     </div>
 </div>
  