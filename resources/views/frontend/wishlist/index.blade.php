@include('layouts.include.style')

    @include('frontend.topbar')

    
    <div class="container-fluid pt-5">
        <h1 class="text-center">Wishlist</h1>
            <livewire:frontend.wishlist-show />
      
     </div>
      

    @include('frontend.footer')

    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

@include('layouts.include.scripts')