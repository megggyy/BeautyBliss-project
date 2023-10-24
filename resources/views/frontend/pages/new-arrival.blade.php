<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Beauty Bliss</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/logo.png" rel="icon">

    <!-- Owl Carousel -->
    <link href="admin/assets/css/owl.carousel.min.css" rel="stylesheet">
    <link href="admin/assets/css/owl.theme.default.min.css" rel="stylesheet">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="frontend/css/style.css" rel="stylesheet">
</head>

<body>
@include('frontend.topbar')

<div class="py-5" bg-white>
    <div class="container-fluid pt-6">
        <div class="row px-xl-5 pb-4">
            <div class="col-md-12">
                <h4>New Arrivals</h4>
                <div class="underline"></div>
            </div>

                @forelse($newArrivalProducts as $productItem)
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <label class="stock out-of-stock">New</label>  
                     
                          
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
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="#" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <form action="#" method="Post">
                              @csrf
                              <i class="fas fa-shopping-cart text-primary mr-1"></i><input type="submit" value="Add to Cart" class="btn btn-sm text-dark p-0">
                            {{-- <input type="number" name="quantity" value="1" min="1" style="width: 50px"> --}}
                            <input type="number" name="quantity" value="1" style="width: 40px; font-size: 14px; padding: 1px;">
                            </form>
                        </div>
                    </div> 
                </div>
                    @empty
                        <div class="col-md-12 p-2">
                                <h4>No Products Available for {{ $category->name }}</h4>
                        </div>            
                    @endforelse
                    <div class="container-fluid pt-4">
                        <div class="row px-xl-5 pb-4">
                            <a href="{{ url('collections') }}" class="btn btn-primary px-3">View More</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            
        </div>
    </div>
</div> 
@include('frontend.footer')

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


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="frontend/lib/easing/easing.min.js"></script>
    <script src="frontend/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="frontend/mail/jqBootstrapValidation.min.js"></script>
    <script src="frontend/mail/contact.js"></script>

    <!-- Owl Carousel -->
    <script src="admin/assets/js/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="frontend/js/main.js"></script>
    @yield('script')
</body>
</html>