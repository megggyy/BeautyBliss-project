<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomerImport;
use DB;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('user')->withTrashed()->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.customers.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
            'pin_code' => ['required', 'string', 'max:10'],
            'address' => ['required', 'string'],
            'images' => ['nullable', 'array', 'max:5'], // Validate the image input (allowing up to 5 images)
            // 'images.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validate each individual image
        ]);
    
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $filename = $image->store('customer_images', 'public');
                $images[] = $filename;
            }
            $validated['images'] = $images;
        }
    
        Customer::create($validated);
    
        return redirect('/admin/customers')->with('message', 'Customer Created Successfully');
    }

    public function edit(int $customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $users = User::all(); // Fetch all users to populate the select dropdown
        return view('admin.customers.edit', compact('customer', 'users'));
    }

    public function update(Request $request, int $customerId)
    {
        $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'string', 'max:15'],
        'pin_code' => ['required', 'string', 'max:10'],
        'address' => ['required', 'string'],
        'images' => ['nullable', 'array', 'max:5'], // Validate the image input (allowing up to 5 images)
        //'images.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validate each individual image
        ]);

        $customer = Customer::findOrFail($customerId);

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $filename = $image->store('customer_images', 'public');
                $images[] = $filename;
            }
            $validated['images'] = $images;
        }
    
        $customer->update($validated);
    
        return redirect('/admin/customers')->with('message', 'Customer Updated Successfully');
    }
    public function destroy(int $customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->delete();
        return redirect('/admin/customers')->with('message', 'Customer Deleted Successfully');
    }

    public function restore(int $customerId)
    {
    DB::transaction(function () use ($customerId) {
        $customer = Customer::withTrashed()->findOrFail($customerId);

        if ($customer->trashed()) {
            $customer->restore();
            session()->flash('message', 'Customer Restored Successfully');
        }
    });

    return redirect('/admin/customers')->with('message', 'Customer Restored Successfully');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,csv'],
        ]);

        $file = $request->file('file');

        try {
            Excel::import(new CustomerImport, $file);

            return redirect('/admin/customers')->with('message', 'Customers Imported Successfully');
        } catch (\Exception $e) {
            return redirect('/admin/customers')->with('error', 'Error importing customers: ' . $e->getMessage());
        }
    }
}
