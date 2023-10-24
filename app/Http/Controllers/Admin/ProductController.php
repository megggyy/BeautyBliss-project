<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::withTrashed()->paginate(10);
        $products = Product::withTrashed()->get();
       return view('admin.products.index',compact('products'));
    }

    public function render()
    {
        $product = Product::withTrashed()->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.product.index', compact('product'));
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->where('id', $id)->first();
    
        if ($product) {
            $product->restore();
    
            // Restore associated product images
            $product->productImages()->onlyTrashed()->restore();
    
            return redirect('admin/products')->with('success', 'Product restored successfully.');
        } else {
            return redirect('admin/products')->with('error', 'No Such Product ID Found');
        }
    }
    

    public function create()
    {
        $categories =  Category::all();
        $brands = Brand::all();
        $colors = Color::where('status','0')->get(); 
        return view('admin.products.create', compact('categories','brands','colors'));
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);
        $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'brand' => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $request->trending == true ? '1' : '0',
            'status' => $request->status == true ? '1' : '0',
        ]);

        if($request->hasFile('image')){
            $uploadPath= 'uploads/products';

            $i = 1;
            foreach($request->file('image') as $imageFile){
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extension;
                $imageFile->move($uploadPath,$filename);
                $finalImagePathName =$uploadPath.'/'.$filename;
                
                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }           

        }
        
        if($request->colors){
            foreach($request->colors as $key => $color){
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0
                ]);
            }
        }

        return redirect('/admin/products')->with('message','Product Added Successfully');
    }

    public function edit(int $product_id)
    {
       
        $categories =  Category::all();
        $brands = Brand::all();
        $product = Product::findOrFail($product_id);

        $product_color = $product->productColors->pluck('color_id')->toArray();
        $colors = Color::whereNotIn('id',$product_color)->get();
       return view('admin.products.edit', compact('categories','brands','product','colors'));
    }

    public function update(ProductFormRequest $request, int $product_id)
    {
        $validatedData = $request->validated();
        $product = Product::where('id', $product_id)->first();
            if($product)
            {
                $product->update([
                    'category_id' => $validatedData['category_id'],
                    'name' => $validatedData['name'],
                    'slug' => Str::slug($validatedData['slug']),
                    'brand' => $validatedData['brand'],
                    'small_description' => $validatedData['small_description'],
                    'description' => $validatedData['description'],
                    'original_price' => $validatedData['original_price'],
                    'selling_price' => $validatedData['selling_price'],
                    'quantity' => $validatedData['quantity'],
                    'trending' => $request->trending == true ? '1' : '0',
                    'status' => $request->status == true ? '1' : '0',
                ]);

                if($request->hasFile('image')){
                    $uploadPath= 'uploads/products';
        
                    $i = 1;
                    foreach($request->file('image') as $imageFile){
                        $extension = $imageFile->getClientOriginalExtension();
                        $filename = time().$i++.'.'.$extension;
                        $imageFile->move($uploadPath,$filename);
                        $finalImagePathName =$uploadPath.'/'.$filename;
                        
                        $product->productImages()->create([
                            'product_id' => $product->id,
                            'image' => $finalImagePathName,
                        ]);
                    }           
        
                }

                if($request->colors){
                    foreach($request->colors as $key => $color){
                        $product->productColors()->create([
                            'product_id' => $product->id,
                            'color_id' => $color,
                            'quantity' => $request->colorquantity[$key] ?? 0
                        ]);
                    }
                }

                return redirect('admin/products')->with('message','Product Updated Successfully');
            }
            else
            {
                return redirect('admin/products')->with('message','No Such Product ID Found');
            }

    }

    public function destroy($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        // Soft delete the product along with its images and colors
        $product->delete();
        $product->productImages()->delete();
        $product->productColors()->delete();
    
        return redirect()->back()->with('message', 'Product Deleted with all its Images');
    }

    public function destroyImage(int $product_image_id)
    {
        $productImage = ProductImage::findOrFail($product_image_id);
        if(File::exists($productImage->image)){
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message','Product Image Deleted');
       
    }

    public function updateProdColorQty(Request $request, $prod_color_id)
    {
        $productColorData = Product::findOrFail($request->product_id)
        ->productColors()->where('id',$prod_color_id)->first();

        $productColorData->update([
            'quantity' => $request->qty
        ]);

        return response()->json(['message'=>'Product Color Quantity Updated']);
    }

    public function deleteProdColor($prod_color_id)
    {
        $prodColor = ProductColor::findOrFail($prod_color_id);
        $prodColor->delete();
        return response()->json(['message'=>'Product Color Deleted']);
    }

    public function importProducts(Request $request)
    {
        if ($request->hasFile('excel_file')) {
            Excel::import(new ProductImport, $request->file('excel_file'));
            return redirect()->back()->with('message', 'Products imported successfully.');
        }

        return redirect()->back()->withErrors(['message' => 'Please upload a valid Excel file.']);
    }

}
