<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $rev = Review::with(['products', 'users', 'customers'])->get();

        return view('frontend.collections.products.view', compact('rev'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function userReviews()
{
    $user = Auth::user();
    $reviews = Review::where('user_id', $user->id)->get();

    return view('frontend.users.user_reviews', compact('reviews'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $product_id)
    {
        //

        $rules = [
            'comment' => 'required',
        ];

        $message = [
            'comment' => 'Enter comment',

        ];
        Validator::make($request->all(), $rules, $message)->validate();

        $reviews = new Review;
        $reviews->product_id = $product_id;
        $reviews->user_id = Auth::id();
        $reviews->rate = $request->rating;
        $reviews->comment = $request->comment;
        $reviews->save();

        return back()->with('message', 'Review Created Successfully');
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($product_id)
    {
        //
        $product = Product::find($product_id); // Fetch the product based on $id
        $rev = Review::where('product_id', $product_id)->get();
        return view('frontend.collections.products.view', ['product' => $product, 'rev' => $rev, 'product_id' => $product_id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $review = Review::find($id);

        if (!$review) {
            return back()->with('error', 'Review not found.');
        }

        // Check if the logged-in user is the author of the review
        if (Auth::check() && Auth::user()->id === $review->user->id) {
            return view('frontend.collections.products.view', compact('review'));
        } else {
            return back()->with('error', 'You are not authorized to edit this review.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, $product_id)
    {
        //
        $review = Review::find($id);

        if (!$review) {
            return back()->with('error', 'Review not found.');
        }
        $review->rate = $request->rating;
        $review->product_id = $product_id;
        $review->user_id = Auth::id();
        $review->comment = $request->comment;
        $review->save();

        return back()->with('message', 'Review Updated Successfully');
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $review = Review::find($id);
        if (!$review) {
            return back()->with('error', 'Review not found.');
        }

        $review->delete();

        return back()->with('message', 'Review Deleted Successfully');
    }

}
