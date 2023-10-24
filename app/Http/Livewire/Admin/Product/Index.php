<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // $product = Product::withTrashed()->orderBy('id', 'DESC')->paginate(10);
        $product = Product::withTrashed()->orderBy('id', 'DESC')->get();
        return view('livewire.admin.product.index', compact('product'));
    }

    // public function restore($id)
    // {
    //     $product = Product::withTrashed()->findOrFail($id);
    //     $product->restore();

    //     return redirect('admin/products')->with('success', 'Product deleted successfully.');
    // }
    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        session()->flash('message', 'Product restored successfully.');
    }

    // public function destroy($id)
    // {
    //     $product = Product::findOrFail($id);
    //     $product->delete();

    //     return redirect('admin/products')->with('success', 'Product deleted successfully.');
    // }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        session()->flash('message', 'Product deleted successfully.');
    }

    public function updatedProduct()
    {
        $this->dispatchBrowserEvent('reinitialize-datatable');
    }
}
