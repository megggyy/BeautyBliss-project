<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Cart;


class View extends Component
{

    public $category, $products, $prodColorSelectedQuantity, $quantityCount = 1, $productColorId;

    public function addToWishList($productId)
    {
        if(Auth::check()){

            if(Wishlist::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists())
            {
                session()->flash('message', [
                    'text' => 'Already added to wishlist',
                    'type' => 'warning',
                    'status' => 401
                ]);
                return false;
            }else{
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('wishlistAddedUpdated');
                session()->flash('message', [
                    'text' => 'Wislist Added successfully',
                    'type' => 'success',
                    'status' => 401
                ]);
            }
        }else{
            session()->flash('message','Please Login to continue');
            $this->dispatchBrowserEvent('message',[
                'text' => 'Please Login to continue',
                'type' => 'info',
                'status' => 401
            ]);        
            return false;
        }
    }
    
    // protected $products = []; // products is now a protected property

    public function colorSelected($productColorId)
    {
        // dd($productColorId);
        $this->productColorId = $productColorId;
        $productColor = $this->products->productColors()->where('id', $productColorId)->first();
        
        if ($productColor) {
            $this->prodColorSelectedQuantity = $productColor->quantity;
            
            if ($this->prodColorSelectedQuantity == 0) {
                $this->prodColorSelectedQuantity = 'outOfStock';
            }
        }
    }

    public function incrementQuantity()
    {
        if($this->quantityCount < 10){
            $this->quantityCount++;
        }
    } 

    public function decrementQuantity()
    {
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }
    }

    public function mount($products, $category)
    {
        $this->products = $products;
        $this->category = $category;
    }


    public function addToCart(int $productId)
    {
        if(Auth::check())
        { 
            if($this->products->where('id',$productId)->where('status',0)->exists())
            {
                // Check for Product color quantity and add to cart
                if($this->products->productColors()->count() > 1)
                {
                    // dd('am product color');
                    if($this->prodColorSelectedQuantity != NULL)
                    {
                        if(Cart::where('user_id',auth()->user()->id)
                            ->where('product_id', $productId)
                            ->where('product_color_id', $this->productColorId)
                            ->exists())
                        {
                            session()->flash('message', [
                                'text' => 'Product Already Added',
                                'type' => 'warning',
                                'status' => 200
                            ]);
                        }
                        else
                        {
                        $productColor = $this->products->productColors()->where('id',$this->productColorId)->first(); 
                        if($productColor->quantity > 0)
                        {
                            if($productColor->quantity > $this->quantityCount)
                            {
                                // insert a product to cart
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'product_color_id' => $this->productColorId,
                                    'quantity' => $this->quantityCount,
                                ]);

                                $this->emit('CartAddedUpdated');
                                session()->flash('message', [
                                    'text' => 'Product Added to Cart',
                                    'type' => 'success',
                                    'status' => 200
                                ]);
                            }
                            else
                            {
                                session()->flash('message', [
                                    'text' => 'Only '.$this->products->quantity.' Quantity Available',
                                    'type' => 'warning',
                                    'status' => 401
                                ]);
                            }
                        }
                        else
                        {
                            session()->flash('message', [
                                'text' => 'Out of Stock',
                                'type' => 'warning',
                                'status' => 401
                            ]);
                        }
                    } 
                    }
                    else
                    {
                        session()->flash('message', [
                            'text' => 'Select Your Product Color',
                            'type' => 'info',
                            'status' => 401
                        ]);
                    }
                }
                else
                {

                if(Cart::where('user_id',auth()->user()->id)->where('product_id', $productId)->exists())
                {
                    session()->flash('message', [
                        'text' => 'Product Already Added',
                        'type' => 'warning',
                        'status' => 200
                    ]);
                }
                else
                {              
                // dd('am product');
                if($this->products->quantity > 0)
                {
                    if($this->products->quantity > $this->quantityCount)
                    {
                        // insert a product to cart
                        Cart::create([
                            'user_id' => auth()->user()->id,
                            'product_id' => $productId,
                            'product_color_id' => $this->productColorId,
                            'quantity' => $this->quantityCount,
                        ]);

                        $this->emit('CartAddedUpdated');
                        session()->flash('message', [
                            'text' => 'Product Added to Cart',
                            'type' => 'success',
                            'status' => 200
                        ]);
                    }
                    else
                    {
                        session()->flash('message', [
                            'text' => 'Only '.$this->products->quantity.' Quantity Available',
                            'type' => 'warning',
                            'status' => 401
                        ]);
                    }
                    
                }
                    else
                    {
                        session()->flash('message', [
                            'text' => 'Out of Stock',
                            'type' => 'warning',
                            'status' => 401
                        ]);
                    }
                }
            }
            }
            else
            {
                session()->flash('message', [
                    'text' => 'Product does not exist',
                    'type' => 'warning',
                    'status' => 401
                ]);
            }
        }
        else
        {
        session()->flash('message','Please Login to add to cart');
         $this->dispatchBrowserEvent('message',[
        'text' => 'Please Login to continue',
        'type' => 'info',
        'status' => 401
        ]);

        }
    }

    public function render()
    {
        return view('livewire.frontend.product.view',[ 
            'products' => $this->products,
            'category' => $this->category
        ]);
    }
}

