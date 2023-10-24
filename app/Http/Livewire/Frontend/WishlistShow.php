<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistShow extends Component
{
    public function removeWishlistItem(int $wishlistId)
    {
        Wishlist::where('user_id',auth()->user()->id)->where('id',$wishlistId)->delete();
        $this->emit('wishlistAddedUpdated');
        session()->flash('message', 'Wishlist Item Removed Succesfully');
    }

    public function render()
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show',[
            'wishlist' => $wishlist
        ]);
    }
}
