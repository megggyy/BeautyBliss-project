<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Customer;
use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use App\Mail\PlaceOrderMailable;
use Illuminate\Support\Facades\Mail;

class CheckoutShow extends Component
{
    
    public $carts, $totalProductAmount = 0;
    public $fullname, $email, $phone, $pincode, $address, $payment_mode =NULL, $payment_id = NULL;

    
    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:11|min:10',
            'pincode' => 'required|string|max:6|min:6',
            'address' => 'required|string|max:500',
        ];
    }

    public function placeOrder()
    {
        $this->validate();

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'funda-'.Str::random(10),
            'fullname' => $this->fullname,
            'email'=> $this->email,
            'phone'=> $this->phone,
            'pincode'=> $this->pincode,
            'address'=> $this->address,
            'status_message'=> 'in progress',
            'payment_mode'=> $this->payment_mode,
            'payment_id'=> $this->payment_id,
        ]);

        foreach($this->carts as $cartItem) {
            $orderItems = OrderItem::create([
                'order_id' => $order->id,
                'product_id'=> $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity'=> $cartItem->quantity,
                'price'=> $cartItem->product->selling_price
            ]);

             // Reduce product quantity
        $product = $cartItem->product;
        $product->quantity -= $cartItem->quantity;
        $product->save();
         }
         return $order;
       
    }
    public function codOrder()
    {
       $this->payment_mode = 'Cash on Delivery';
       $codOrder = $this->placeOrder();
       if($codOrder){

        Cart::where('user_id', auth()->user()->id)->delete();

        try {
            $order = Order::findOrFail($codOrder->id);
            Mail::to("luminouslooksbeauty@gmail.com")->send(new PlaceOrderMailable($order));
            // Mail Sent Successfully
        } catch (\Exception $e) {
            // Something went wrong
        }
        
        session()->flash('message', [
            'text' => 'Order Placed Successfully',
            'type' => 'success',
            'status' => 200
        ]);
        return redirect()->to('thank-you');
       }else{
        session()->flash('message', [
            'text' => 'Something Went Wrong',
            'type' => 'error',
            'status' => 200
        ]);
       } 
    }
    public function totalProductAmount()
    {
        $this->carts = Cart::where('user_id',auth()->user()->id)->get();
        foreach($this->carts as $cartItem) {
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }

        return $this->totalProductAmount;
    }
    public function render()
    {
        $this->fullname = auth()->user()->name;
    $this->email = auth()->user()->email;

    // Fetch the customer data from the database based on the authenticated user's ID.
    $customer = Customer::where('user_id', auth()->user()->id)->first();

    // If the customer exists, set the properties to the retrieved data.
    if ($customer) {
        $this->phone = $customer->phone; // Assuming the column name in the table is "phone".
        $this->pincode = $customer->pin_code; // Assuming the column name in the table is "pin_code".
        $this->address = $customer->address; // Assuming the column name in the table is "address".
    } else {
        // If the customer doesn't exist, you can handle it accordingly, for example, leave the fields empty or set default values.
        // You may also redirect the user to update their profile to complete the checkout process.
        // For simplicity, we'll set empty values here.
        $this->phone = '';
        $this->pincode = '';
        $this->address = '';
    }

    $this->totalProductAmount = $this->totalProductAmount();

    return view('livewire.frontend.checkout.checkout-show', [
        'totalProductAmount' => $this->totalProductAmount
    ]);
    }
}
