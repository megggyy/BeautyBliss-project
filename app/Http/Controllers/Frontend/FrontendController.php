<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class FrontendController extends Controller
{
    public function index() 
    {
        $products=product::get();
        $categories = Category::get();
        $trendingProducts = Product::where('trending','1')->latest()->take(15)->get();
        
       return view('frontend.index',compact('categories','products','trendingProducts'));
    }

    public function searchProducts(Request $request)
    {
        // if($request->search){

        //     $searchProducts = Product::where('name','LIKE','%'.$request->search.'%')->latest()->paginate(5);
        //     return view('frontend.pages.search',compact('searchProducts'));
        // }else{
        //     return redirect()->back()->with('message','Empty Search');
        // }
    }

    public function newArrival()
    {
        $newArrivalProducts = Product::latest()->take(16)->get();
        return view('frontend.pages.new-arrival',compact('newArrivalProducts'));
    }

    public function categories()
    {
        $categories = Category::all();
        $categories = Category::where('status','0')->get();
        return view('frontend.collections.category.index',compact('categories'));
    }

    public function products($category_slug)
    {
        $category = Category::where('slug',$category_slug)->first();
        if($category){

            // $products = $category->products()->paginate(4);
            $products = $category->products()->get();
            return view('frontend.collections.products.index',compact('products','category'));
        }else
        {
            return redirect()->back();
        }
    }

    // public function productView(string $category_slug, string $product_slug)
    // {
    //     $category = Category::where('slug', $category_slug)->first();

    //     $rev = Review::with(['product', 'user', 'customer'])
    //         ->get();
            
    //     if ($category) {

    //         $products = $category->products()->where('slug', $product_slug)->where('status', '0')->first();
    //         if ($products) {
    //             $product = Product::where('slug', $product_slug)->first();
    //             if ($product) {
    //                 $id = $product->id;
    //             } else {
    //                 // Handle the case when the product is not found
    //                 $id = null;
    //             }

    //             return view('frontend.collections.products.view', compact('products', 'category', 'rev', 'product', 'id'));
    //         } else {
    //             return redirect()->back();
    //         }

    //     } else {
    //         return redirect()->back();
    //     }
    // }

    public function productView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        $userHasBoughtProduct = false; // Initialize the variable
    
        if (Auth::check()) {
            $user = Auth::user();
            $userOrders = $user->orders;
    
            foreach ($userOrders as $order) {
                $orderItems = $order->orderItems; // Assuming there's a relationship between Order and OrderItem
    
                foreach ($orderItems as $orderItem) {
                    if ($orderItem->product->slug == $product_slug) {
                        $userHasBoughtProduct = true;
                        break 2; // Break out of both loops
                    }
                }
            }
        }
    
        $rev = Review::with(['product', 'user', 'customer'])
            ->get();
    
        if ($category) {
            $products = $category->products()->where('slug', $product_slug)->where('status', '0')->first();
            if ($products) {
                $product = Product::where('slug', $product_slug)->first();
                if ($product) {
                    $id = $product->id;
                } else {
                    // Handle the case when the product is not found
                    $id = null;
                }
    
                return view('frontend.collections.products.view', compact('products', 'category', 'rev', 'product', 'id', 'userHasBoughtProduct'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
    
    
    



    public function thankyou()
    {
       return view('frontend.thank-you');
    }

    
}

