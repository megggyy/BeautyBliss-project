<!DOCTYPE html>
<html lang="en">

<head>
  @include('layouts.include.style')
</head>

@livewireStyles

<body>
    <!-- Topbar Start -->
      @include('frontend.topbar')
    <!-- Topbar End -->

    <!-- Topbar Start -->
    <style>
      .h1{
          text-align: center;
      }
  </style>
  <h1 class="h1 mx-auto">Our Categories</h1>
  <div class="container-fluid pt-5">
     <div class="row px-xl-5 pb-3">
  
        @forelse ($categories as $key => $categoryItem)
        <div class="col-lg-2 col-md-3 col-sm-4 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <a href="{{ url('/collections/'.$categoryItem->slug)}}" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="{{ asset($categoryItem->images[0]) }}" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">{{$categoryItem->name}}</h5>
            </div>
        </div>
        
        @empty
         <div class="col-md-12">
             <h5>No Categories Available</h5>
         </div>
        @endforelse
        
         </div>

        @livewireScripts
     </div>
  
    <!-- Topbar End -->
    
    <!-- Footer Start -->
    @include('frontend.footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    @include('layouts.include.scripts')
</body>

</html>
