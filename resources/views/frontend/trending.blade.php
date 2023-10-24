<div class="py-5" bg-white>
  <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
      <div class="d-flex justify-content-center">
          <div class="col-md-8">
              <h4>Welcome to Beauty Bliss!</h4>
              <div class="underline mx-auto"></div>
              <p>
                  Welcome to Beauty Bliss, your one-stop destination for all things makeup! 
                  We are excited to bring you a stunning selection of high-quality makeup 
                  products that will help you achieve your desired look. From foundation to 
                  lipstick, eyeshadow to mascara, we have everything you need to enhance your 
                  natural beauty and express yourself through makeup.
              </p>
          </div>
      </div>
  </div>
</div> 

<div class="py-5" bg-white>
  <div class="container-fluid pt-4">
      <div class="row px-xl-5 pb-4">
          <div class="col-md-12">
              <h4>Trending Products</h4>
              <div class="underline"></div>
          </div>
          @if($trendingProducts)
          <div class="col-md-12">
              <div class="owl-carousel owl-theme trending-product">
              @foreach($trendingProducts as $productItem)
              <div class="item">
                  <div class="card product-item border-0 mb-4">
                      <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                          <label class="stock out-of-stock">Trending!</label>  
                   
                        
                        @if($productItem->productImages->count() > 0)
                        <a href="{{ url('collections/'.$productItem->category->slug.'/'.$productItem->slug)}}" class="btn btn-sm text-dark p-0">
                  
                        <img class="img-fluid w-100" src="{{ asset($productItem->productImages[0]->image)}}" alt="{{$productItem->name}}">
                      </a>
                        @endif
                    </div>
                      <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <p class="product-brand">{{ $productItem->brands}}</p>  
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
        @endforeach
      </div>
        @else
        <div class="col-md-12">
          <div class="p-2">
                   <h4>No Products Available for {{ $category->name }}</h4>
                      </div>
                  </div>
          @endif
              </div>
              </div>
          </div>
          
      </div>
  </div>
</div> 

@section('script')
<script>
  $('.trending-product').owlCarousel({
  loop:true,
  margin:10,
  nav:false,
  responsive:{
      0:{
          items:1
      },
      600:{
          items:3
      },
      1000:{
          items:4
      }
  }
})
</script>
@endsection

