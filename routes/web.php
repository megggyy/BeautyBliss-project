<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
 
Route::get('/get-customer-data', 'App\Http\Controllers\ChartController@getCustomerData');
Route::get('/customer-chart', function () {
   return view('customer_chart');
});
 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

 Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function () {

    Route::get('/','index');
    // Route::get('/home','index');
    Route::get('/collections','categories');
    Route::get('/collections/{category_slug}','products');
    Route::get('/collections/{category_slug}/{product_slug}','productView');
    Route::get('/new-arrivals','newArrival');

    // Route::get('search', 'searchProducts');
    
 });

 Route::controller(App\Http\Controllers\Frontend\ReviewController::class)->group(function () {
 
    Route::get('/review/edit/{id}', 'edit')->name('review.edit');
    Route::post('/review/{product_id}', 'store')->name('review.store');
    Route::put('/review/{product_id}/{id}', 'update')->name('review.update');
    Route::delete('/review/delete/{id}', 'destroy')->name('review.destroy');
   
});

 Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');
 Route::get('/autocomplete', [App\Http\Controllers\AutocompleteController::class, 'index']);
 Route::post('/autocomplete/fetch', [App\Http\Controllers\AutocompleteController::class, 'fetch'])->name('autocomplete.fetch');

 Route::middleware(['auth'])->group(function(){ 
    Route::get('wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index']);
    Route::get('cart',[App\Http\Controllers\Frontend\CartController::class, 'index']);
    Route::get('checkout',[App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
    Route::get('orders', [App\Http\Controllers\Frontend\OrderController::class, 'index']);
    Route::get('orders/{orderId}', [App\Http\Controllers\Frontend\OrderController::class, 'show']);
    Route::get('profile', [App\Http\Controllers\Frontend\UserController::class, 'index']);
    Route::post('profile', [App\Http\Controllers\Frontend\UserController::class, 'updateUserDetails']); // Change the method to POST  
    Route::get('change-password', [App\Http\Controllers\Frontend\UserController::class, 'passwordCreate']);
    Route::post('change-password', [App\Http\Controllers\Frontend\UserController::class, 'changePassword']);

    Route::get('/user-reviews', [App\Http\Controllers\Frontend\ReviewController::class, 'userReviews'])
    ->name('user.reviews');

 });
 Route::get('thank-you',[App\Http\Controllers\Frontend\FrontendController::class, 'thankyou']);
 

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    //Category Route
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}','update');      
        Route::post('/category/import', 'importExcel')->name('category.import');
    });

    
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('products','store');
        Route::get('/products/{product}/edit','edit');
        Route::put('/products/{product}','update');
        Route::delete('/products/{product_id}/delete','destroy');
        Route::patch('/products/{product_id}/restore', 'restore');
        Route::get('product-image/{product_image_id}/delete','destroyImage');
    
        Route::post('product-color/{prod_color_id}','updateProdColorQty');
        Route::get('product-color/{prod_color_id}/delete','deleteProdColor');

        Route::post('/product/import', 'importProducts')->name('product.import');

    });
    
    Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class );

    Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function () {
        Route::resource('colors', App\Http\Controllers\Admin\ColorController::class);
        Route::get('/colors', 'index');
        Route::get('/colors/create', 'create');
        Route::post('/colors/create', 'store');
        Route::get('/colors/{color}/edit', 'edit');
        Route::put('/colors/{color_id}', 'update');
        Route::get('/colors/{color_id}/delete', 'destroy');
        Route::match(['get', 'post'],'/colors/{color_id}/restore', 'restore');

        // New route for importing Excel file
        Route::post('/colors/import', 'import')->name('admin.colors.import');

    });

    //admin orders
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/{orderId}', 'show');
        Route::put('/orders/{orderId}', 'updateOrderStatus');

        Route::get('/invoice/{orderId}', 'viewInvoice');
        Route::get('/invoice/{orderId}/generate', 'generateInvoice');
        Route::get('/invoice/{orderId}/mail', 'mailInvoice');
        
        Route::post('/complete-transaction/{orderId}', 'completeTransaction');
    });

    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users', 'store');
        Route::get('/users/{user_id}/edit', 'edit');
        Route::put('/users/{user_id}', 'update');
        Route::delete('/users/{user_id}/delete', 'destroy');
        Route::patch('/users/{user_id}/restore', 'restore');
    });

    Route::controller(App\Http\Controllers\Admin\CustomerController::class)->group(function () {
        Route::get('/customers', 'index');
        Route::get('/customers/create', 'create');
        Route::post('/customers', 'store');
        Route::get('/customers/{user_id}/edit', 'edit');
        Route::put('/customers/{user_id}', 'update');
        Route::get('/customers/{user_id}/delete', 'destroy');
        Route::match(['get', 'post'],'/customers/{customer_id}/restore', 'restore');
        Route::post('/customers/import', 'import');
    });
});