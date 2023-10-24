<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Review;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $usertype=Auth::user()->usertype;

        if($usertype=='1')
        {
             
            return view('admin.dashboard');
        }

        else
        {
            $user = User::findOrFail(auth()->id());

            $review = Review::with(['product', 'user', 'customer','product_images'])
                ->get();
    
            return view('frontend.users.profile', compact('user', 'review'));
        }
        // return view('home');
    }


}
