<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    
    public function search(Request $request){
        // dd($request);
        if($request->filled('search')){
          
            $searchResults = Product::search($request->search)->get();
        }else{
            $searchResults = Product::all(); 
             
        }
             
                return view('frontend.pages.search', compact('searchResults'));
    }

    

}

