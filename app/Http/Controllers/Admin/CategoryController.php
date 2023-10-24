<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoryImport;


class CategoryController extends Controller
{
    
    public function index()
    {
        // $categories = Category::withTrashed()->paginate(10);
        $categories = Category::withTrashed()->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        
        $validatedData = $request->validated();
 
        $category = new Category;
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        $uploadPath = 'uploads/category/';

      // Handle multiple images
      $images = [];
      if ($request->hasFile('images')) {
          foreach ($request->file('images') as $file) {
              $ext = $file->getClientOriginalExtension();
              $filename = time() . '_' . uniqid() . '.' . $ext;
              $file->move($uploadPath, $filename);
              $images[] = $uploadPath . $filename;
          }
      }

      $category->images = $images;

        $category->status = $request->status == true ? '1':'0';
        $category->save();

        return redirect('admin/category')->with('message','Category Added Successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($category);
    
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];
    
  // Handle multiple images
  if ($request->hasFile('images')) {
    $uploadPath = 'uploads/category/';
    $images = [];
    foreach ($request->file('images') as $file) {
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '.' . $ext;

        // Delete the old image file
        if ($category->images && is_array($category->images)) {
            foreach ($category->images as $oldImage) {
                $oldImagePath = public_path($oldImage);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
        }
         $file->move($uploadPath, $filename);
                $images[] = $uploadPath . $filename;
            }

            $category->images = $images;
        }

        $category->status = $request->status == true ? '1' : '0';
        $category->update();

        return redirect('admin/category')->with('message', 'Category Updated Successfully');
    }

    public function importExcel(Request $request)
    {
        $file = $request->file('excel_file');

        if (!$file) {
            return redirect()->back()->with('error', 'No file uploaded.');
        }

        Excel::import(new CategoryImport, $file, null, \Maatwebsite\Excel\Excel::XLSX);

        return redirect()->back()->with('message', 'Categories imported successfully!');
    }
}

