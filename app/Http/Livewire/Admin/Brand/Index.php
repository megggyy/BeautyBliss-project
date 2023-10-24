<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Imports\BrandImport;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Category;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads; // Add this line to use the WithFileUploads trait
    public $selectedBrandId;
    protected $paginationTheme = 'bootstrap';
    public $name, $slug, $status, $brand_id, $category_id, $images = [];
    public function rules()
    {
        return [
            'name' => 'required|string', 
            'slug' => 'required|string',
            'category_id' => 'required|integer',
            'status' => 'nullable',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    } 
    public function setSelectedBrandId($brand_id)
    {
        $this->selectedBrandId = $brand_id;
       $this->emit('reinitialize-datatable');
    }

    public function create()
    {
       $this->emit('reinitialize-datatable');
    }
    public function storeBrand()
{
    $validatedData = $this->validate();

    // Handle image uploads and store paths in the "images" column
    $imagePaths = [];
    if ($this->images) {
        foreach ($this->images as $image) {
            $path = $image->store('brands', 'public');
            $imagePaths[] = $path;
        }
    }

    // Create the brand with the image paths
    $brand = Brand::create([
        'name' => $this->name,
        'slug' => Str::slug($this->slug),
        'status' => $this->status == true ? '1':'0',
        'category_id' => $this->category_id,
        'images' => $imagePaths, // Assign the image paths here
    ]);

    // Emit the event to refresh DataTables
    $this->emit('reinitialize-datatable');
    session()->flash('message','Brand Added Successfully');
    
    $this->dispatchBrowserEvent('close-modal');
    $this->resetInput();
}

    public function resetInput()
    {
       $this->name = NULL;
       $this->slug = NULL;
       $this->status = NULL;
       $this->brand_id = NULL;
       $this->category_id = NULL;
       $this->images = NULL;
        // Emit the event to refresh DataTables
    $this->emit('reinitialize-datatable');

    }
    public function closeModal()
    {
        
        $this->resetInput();
  
    }

    public function openModal()
    {
        $this->resetInput();

    }

    public function editBrand(int $brand_id)
    {
        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
        $this->category_id = $brand->category_id;
         // Emit the event to refresh DataTables
        $this->emit('reinitialize-datatable');
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();
        $brand = Brand::findOrFail($this->brand_id);
        $brand->update([
        'name' => $this->name,
        'slug' => Str::slug($this->slug),
        'status' => $this->status == true ? '1':'0',
        'category_id' => $this->category_id,
        'images' => [],
        ]);

        // Handle image uploads and store paths in the "images" column
        if ($this->images) {
            $imagePaths = [];
            foreach ($this->images as $image) {
                $path = $image->store('brands', 'public');
                $imagePaths[] = $path;
            }
            $existingImages = $brand->images ?? [];
            $this->emit('reinitialize-datatable');
            $brand->update(['images' => array_merge($existingImages, $imagePaths)]);
            $this->dispatchBrowserEvent('close-modal');
        }

         // Emit the event to refresh DataTables
        $this->emit('reinitialize-datatable');
        session()->flash('message','Brand Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteBrand($brand_id)
    {
        $this->brand_id = $brand_id;
         // Emit the event to refresh DataTables
        $this->emit('reinitialize-datatable');
    }

    public function destroyBrand()
    {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message','Brand Deleted Successfully');
         // Emit the event to refresh DataTables
        $this->emit('reinitialize-datatable');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function restoreBrand()
    {
        $brand_id = $this->selectedBrandId;
        $brand = Brand::withTrashed()->findOrFail($brand_id);
    
        if ($brand->trashed()) {
            $brand->restore();
            session()->flash('message', 'Brand Restored Successfully');          
        }  
        // Emit the event to refresh DataTables
        $this->emit('reinitialize-datatable');
        $this->dispatchBrowserEvent('close-modal');      
    }

    public $importFile; // Add the $importFile property

    public function import()
    {
        $this->validate([
            'importFile' => 'required|file|mimes:xls,xlsx',
        ]);

        $path = $this->importFile->store('temp', 'public');

        $import = new BrandImport();
        Excel::import($import, $this->importFile);
      // Emit the event to refresh DataTables
      $this->emit('reinitialize-datatable');
      $this->dispatchBrowserEvent('close-modal');    
        session()->flash('message', 'Brands imported successfully.');

        // Emit an event to indicate that the DataTable needs to be reinitialized
        $this->emit('import-finished');

        // Clear the importFile property and reset the input
        $this->importFile = null;
        $this->reset(['importFile']);

   
    }

    public function render()
    {
        $categories = Category::where('status', '0')->get();
        // $brands = Brand::orderBy('id', 'DESC')->withTrashed()->paginate(10);
        $brands = Brand::orderBy('id', 'DESC')->withTrashed()->get();
        return view('livewire.admin.brand.index', ['brands' => $brands, 'categories' => $categories])
            ->extends('layouts.admin')
            ->section('content');
    }

}
