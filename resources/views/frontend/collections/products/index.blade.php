{{-- @extends('layouts.app') --}}
@include('layouts.include.style')


    <!-- Topbar Start -->
    @include('frontend.topbar')
    <!-- Topbar End -->
   
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Our Products</span></h2>
    </div>

        <livewire:frontend.product.index :products="$products" :category="$category" />
 
        @livewireStyles
        @livewireScripts
 </div>

  
    <!-- Footer Start -->
    @include('frontend.footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    @include('layouts.include.scripts')

