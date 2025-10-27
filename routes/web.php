<?php

use App\Http\Controllers\FirstController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\category;
use App\Models\product;
use App\Models\cart;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;







Route::get('/', [FirstController::class, 'mainpage']);
Route::get('/product/{catid?}', [FirstController::class, 'Getproduct']);
Route::get('/category', [FirstController::class, 'Getcategory']);


Route::get('/addproduct', [ProductController::class, 'AddProduct'])->middleware('auth');
Route::get('/editproduct/{productid?}', [ProductController::class, 'EditProduct']);
Route::get('/single-product/{productid}', [ProductController::class, 'showProduct']);
Route::get('/removeproduct/{productid?}', [ProductController::class, 'RemoveProduct']);
Route::post('/storeproduct', [ProductController::class, 'StoreProduct']);
Route::post('/search', function (Request $request) {
    $products = product::where('name', 'like', '%' . $request->search . '%')->paginate(6);
    return view('/product', ['products' => $products]);
});

Route::get('/cart', [CartController::class, 'cart'])->middleware('auth');
Route::get('/order', [CartController::class, 'order'])->middleware('customauth');
Route::get('/previousorder', [CartController::class, 'previousOrder'])->middleware('auth');
Route::post('/storeOrder', [CartController::class, 'storeOrder']);



Route::get('/addtocart/{productid}', function ($productid) {
    $user_id = auth()->user()->id;


    $result = Cart::where('user_id', $user_id)
        ->where('product_id', $productid)
        ->first();

    if ($result) {
        $result->amount += 1;
        $result->save();
    } else {
        $newCart = new Cart();
        $newCart->product_id = $productid;
        $newCart->user_id = $user_id;
        $newCart->amount = 1;
        $newCart->save();
    }
    return redirect('/cart');
})->middleware('auth');

Route::get('/deletecartitem/{cartid}', function ($cartid) {
    Cart::find($cartid)->delete();
    return redirect('/cart');
});




// 🔹 Login routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// 🔹 Register routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// 🔹 Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 🔹 Protected Home page
Route::get('/home', function () {
    return view('home');
})->middleware('auth');


// Route::get('/previousorder',function (){
//    return "/login";
// })->middleware('admin.auth:admin');



