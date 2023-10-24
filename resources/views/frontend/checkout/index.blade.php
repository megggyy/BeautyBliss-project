@include('layouts.include.style')

    @include('frontend.topbar')

    <div class="container-fluid pt-5">
    
        <livewire:frontend.checkout.checkout-show /> 
      
     </div> 
      

    @include('frontend.footer')

    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

@include('layouts.include.scripts')