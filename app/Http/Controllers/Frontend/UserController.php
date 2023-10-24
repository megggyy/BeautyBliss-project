<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;


class UserController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth()->id());

        $review = Review::with(['product', 'user', 'customer','product_images'])
            ->get();

        return view('frontend.users.profile', compact('user', 'review'));
    }

    public function updateUserDetails(Request $request)
    {
        $categories = Category::all();
        // $products=product::all();
        $products=product::paginate(4);
        $trendingProducts = Product::where('trending','1')->latest()->take(15)->get();
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'digits:11'],
            'pin_code' => ['required', 'digits:6'],
            'address' => ['required', 'string', 'max:499'],
            'images' => ['nullable', 'array', 'max:5'], 
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name,
        ]);
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $filename = $image->store('customer_images', 'public');
                $images[] = $filename;
            }
        }
        
        $user->Customer()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'name' =>$request->name,
                'phone' => $request->phone,
                'pin_code' => $request->pin_code,
                'address' => $request->address,
                'images' => ($images),
            ]
        );
        

        // return redirect()->back()->with('message', 'User Profile Updated');
        return view('frontend.index',compact('categories','products','trendingProducts'));    
    }

    public function passwordCreate()
    {
        return view('frontend.users.change-password');
    }

    public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required','string','min:8'],
        'password' => ['required', 'string', 'min:8', 'confirmed']
    ]);

    $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
    if($currentPasswordStatus){

        User::findOrFail(Auth::user()->id)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('message','Password Updated Successfully');

    }else{

        return redirect()->back()->with('message','Current Password does not match with Old Password');
    }
}

}
