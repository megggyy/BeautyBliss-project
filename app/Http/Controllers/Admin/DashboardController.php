<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Charts\CustomerChart;
use DB;

class DashboardController extends Controller
{

    public function index()
    {
        //for customer chart
        $customer = DB::table('customers')
            ->select('address', DB::raw('count(address) as total'))
            ->whereNotNull('address')
            ->groupBy('address')
            ->orderBy('total') 
            ->get();

        $address = [];
        $total = [];
        foreach ($customer as $cus) {
            $address[] = $cus->address;
            $total[] = $cus->total;
        }

        //for product chart
        $orders = DB::table('orders')
            ->selectRaw("DATE_FORMAT(created_at, '%M') AS month, COUNT(*) AS totalord")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $month = [];
        $totalord = [];

        foreach ($orders as $order) {
            $month[] = $order->month;
            $totalord[] = $order->totalord;
        }

        //stocks chart
        $stocks = DB::table('products AS pro')
            ->select('pro.name AS product', 'pro.quantity AS stock')
            ->get();

            $product = [];
            $stock = [];
    
            foreach ($stocks as $sto) {
                $product[] = $sto->product;
                $stock[] = $sto->stock;
            }

        return view('admin.dashboard')->with([
            'customer' => $customer,
            'address' => $address,
            'total' => $total,
            'orders' => $orders,
            'month' => $month,
            'totalord' => $totalord,
            'stocks' => $stocks,
            'product'=>$product,
            'stock'=> $stock
        ]);
    }

}
