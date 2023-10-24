@include('layouts.include.style')

@include('frontend.topbar')

<div class="py-3 pyt-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <!-- Add your logo image here -->
                <img src="{{ asset('img/beautybliss.png') }}" alt="Your Logo" style="max-width: 200px;">

                <h4>Thank you for Shopping with Beauty Bliss</h4>
                <a href="{{ url('collections')}}" class="btn btn-primary">Shop now</a>
            </div>
        </div>
    </div>     
</div>

@include('frontend.footer')

<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

@include('layouts.include.scripts')
