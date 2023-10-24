<style>
    .h1 {
        text-align: center;
    }
</style>

<h1 class="h1 mx-auto">Our Brands</h1>
<div class="container-fluid pt-5">
    <div class="row px-xl-4 pb-3">
        @php
        // Use the paginate method to fetch brands and limit to 12 per page
        $brands = \App\Models\Brand::get();
        @endphp

        @forelse ($brands as $brand)
        <div class="col-lg-2 col-md-3 col-sm-4 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                {{-- Replace the URL with the desired link for the brand --}}
                <a class="cat-img position-relative overflow-hidden mb-3">
                    {{-- Use the appropriate image URL from your Brand model --}}
                    <img class="img-fluid" src="{{ asset($brand->image_url) }}" alt="Brand Image">
                </a>
                <h5 class="font-weight-semi-bold m-0">{{ $brand->name }}</h5>
            </div>
        </div> 
        @empty
        <div class="col-md-12">
            <h5>No Brands Available</h5>
        </div>
        @endforelse
    </div>
    <!-- Display pagination links -->
    {{-- {{ $brands->links() }} --}}
</div>
