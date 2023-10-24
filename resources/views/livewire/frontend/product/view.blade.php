<div>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    
    <div class="py-3 py-md-5 bg-light">
        <div class="container">

            {{-- @if (session()->has('message'))
            <div class="alert alert-{{ session('message.type') }}">
                {{ session('message.text') }}
            </div>
        @endif --}}
    

            <div class="row">
                <div class="col-md-5 mt-3"> 
                    <div class="bg-white border" wire:ignore>
                        @if($products->productImages)
                        {{-- <img src="{{ asset($products->productImages[0]->image) }}" class="w-100" alt="Img"> --}}
                        <div class="exzoom" id="exzoom">

                            <div class="exzoom_img_box">
                              <ul class='exzoom_img_ul'>
                                @foreach($products->productImages as $itemImg)
                                <li><img src="{{ asset($itemImg->image)}}"/></li>
                                @endforeach
                              </ul>
                            </div>
                           
                            <div class="exzoom_nav"></div>
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                          </div>
                        @else
                            No Image Added
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name" style="color: rgb(142, 71, 82);">
                            {{ $products->name }}
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{ $products->category->name }} / {{ $products->name }}
                        </p>
                        <div>
                            @if($products->original_price!=null)
                            <span class="selling-price">₱{{$products->selling_price}}</span>
                            <span class="text-muted ml-2">
                                <del>₱{{$products->original_price}}</del>
                            </span>
                            @else
                            <span class="original-price">₱{{$products->selling_price}}</span>
                             @endif
                        </div>
                        <div>
                            @if($products->productColors->count() > 0)
                                @if($products->productColors)
                                    @foreach ($products->productColors as $colorItem)
                                        <label class="colorSelectionLabel" style="background-color: {{ $colorItem->color->code }}" wire:click="colorSelected({{ $colorItem->id }})" >
                                            {{ $colorItem->color->name }}
                                        </label>
                                    @endforeach
                                @endif

                                <div>
                                    @if ($this->prodColorSelectedQuantity == 'outOfStock')
                                        <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                                    @elseif ($this->prodColorSelectedQuantity > 0)
                                        <label class="btn-sm py-1 mt-2 text-white bg-danger">In Stock</label>
                                    @endif
                                </div>

                            @else

                                @if($products->quantity)
                                    <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                                @else
                                    <label class="btn-sm py-1 mt-2 text-white bg-danger">Out of Stock</label>
                                @endif

                            @endif
                        </div>

                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}" readonly class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>

                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{$products->id}})" class="btn btn1">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </button>

                            <button type="button" wire:click="addToWishList({{ $products->id }})" class="btn btn1"> 
                                <span wire:loading.remove wire:target="addToWishList"> 
                                    <i class="fa fa-heart"></i> Add To Wishlist 
                                </span>
                                <span wire:loading wire:target="addToWishList">Adding.....</span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {{ $products->small_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $products->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</div>

@push('scripts')
<script>
    $(function(){

$("#exzoom").exzoom({


  "navWidth": 60,
  "navHeight": 60,
  "navItemNum": 5,
  "navItemMargin": 7,
  "navBorder": 1,
  "autoPlay": true,
  "autoPlayTimeout": 2000
  
});

});
</script>

@endpush

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
        @livewireStyles

        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <script>
		window.addEventListener('message', event => {
          		alertify.set('notifier','position', 'top-right');
          		alertify.success(event.detail.text);
            });
        </script>
        @livewireScripts

    