<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render() 
    {
        // $categories = Category::withTrashed()->orderBy('id', 'DESC')->paginate(10);
        $categories = Category::withTrashed()->orderBy('id', 'DESC')->get();
        return view('livewire.admin.category.index', compact('categories'));
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();

        return redirect('admin/category')->with('success', 'Category deleted successfully.');
    }

    public function destroy($id)
    { 
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('admin/category')->with('success', 'Category deleted successfully.');
    }

    public function updatedCategories()
    {
        $this->dispatchBrowserEvent('reinitialize-datatable');
    }
}
