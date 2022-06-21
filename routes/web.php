<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Item\ItemsController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Deliver\DeliverController;
use App\Http\Controllers\Review\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\ReturnController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//pages
Route::get('/',[App\Http\Controllers\PageController::class, 'index'])->name('home')->middleware('preventBackHistory');
Route::get('/men',[App\Http\Controllers\PageController::class, 'menPage'])->name('men')->middleware('preventBackHistory');
Route::get('/women',[App\Http\Controllers\PageController::class, 'womenPage'])->name('women')->middleware('preventBackHistory');
Route::get('/kids',[App\Http\Controllers\PageController::class, 'kidsPage'])->name('kids')->middleware('preventBackHistory');
Route::get('/stock-clearance',[App\Http\Controllers\PageController::class, 'clearancePage'])->name('stockclearance')->middleware('preventBackHistory');
Route::view('/support','support')->name('support');
Route::get('/filter', [App\Http\Controllers\SearchController::class, 'filter'])->name('filter');
Route::any('/search*',[App\Http\Controllers\SearchController::class, 'search'])->name('search');



//show items
Route::get('/items/{id}',[ItemsController::class, 'show'])->name('itemshow');



Route::prefix('user')->name('user.')->group(function(){
    Route::middleware(['guest','preventBackHistory'])->group(function(){
        Route::view('/login', 'User.login')->name('login');
        Route::view('/register', 'User.register')->name('register');
        Route::post('/check',[UserController::class, 'check'])->name('check');
        Route::post('/create', [UserController::class, 'create'])->name('create');

    });
    Route::middleware(['auth','preventBackHistory'])->group(function(){
        //logout
        Route::post('/logout',[UserController::class, 'logout'])->name('logout');

        //my account
        Route::view('/my-account', 'User.myAccount')->name('myaccount');
        Route::post('/my-account/{id}',[UserController::class, 'updateProfile'])->name('updateProdile');
        Route::post('/my-account/password/{id}',[UserController::class, 'updatePassword'])->name('updatePassword');
        Route::view('/my-address', 'User.myAddress')->name('myaddress');
        Route::post('/my-address/{id}',[UserController::class, 'updateAddress'])->name('updateAddress');

        //cart
        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::post('/add-to-cart',[CartController::class, 'addToCart'])->name('addtocart');
        Route::delete('/cart/{id}',[CartController::class, 'removeFromCart'])->name('removeFromCart');
        Route::post('/cart/update',[CartController::class, 'updateCart'])->name('updateCart');

        // orders
        Route::view('/my-orders', 'User.myOrders')->name('myorders');
        Route::get('/my-orders/view/{id}', [OrderController::class, 'myOrderView'])->name('myOrderView');
        Route::post('/orders',[OrderController::class, 'store'])->name('storeorders');
        Route::get('/orders/place',[OrderController::class, 'create'])->name('placeorders');
        Route::get('/checkout',[OrderController::class, 'checkoutPage'])->name('checkout')->middleware('checkout');
        

        //review
        Route::view('/my-reviews', 'User.myReviews')->name('myreviews');
        Route::get('/reviews/add/{id}',[ReviewController::class, 'create'])->name('addreviews');
        Route::post('/reviews',[ReviewController::class, 'store'])->name('storereviews');
        Route::delete('/reviews/{id}',[ReviewController::class, 'destroy'])->name('destroyreviews');

        // wishlist
        Route::get('/my-wishlist',[WishlistController::class,'index'])->name('wishlist');
        Route::post('/add-wishlist/{item_id}/{user_id}',[WishlistController::class,'addToWishlist'])->name('addToWishlist');
        Route::delete('/wishlist/{item_id}/{user_id}',[WishlistController::class,'removeFromWishlist'])->name('removeFromWishlist');

    });
    Route::any('/search*',[App\Http\Controllers\SearchController::class, 'search'])->name('search');
});


Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['guest:admin','preventBackHistory'])->group(function(){
        Route::view('/login', 'Admin.login')->name('login');
        Route::post('/check',[AdminController::class, 'check'])->name('check');
        });
    Route::middleware(['auth:admin','preventBackHistory'])->group(function(){
        // logout
        Route::post('/logout',[AdminController::class, 'logout'])->name('logout');

        //dashboard
        Route::get('/dashboard',[AdminController::class, 'index'])->name('dashboard');

        // items
        Route::get('/items',[ItemsController::class, 'index'])->name('items');
        Route::post('/items',[ItemsController::class, 'store'])->name('storeitems');
        Route::get('/items/create',[ItemsController::class, 'create'])->name('createitems');
        Route::get('/items/{id}/edit',[ItemsController::class, 'edit'])->name('edititems');
        Route::post('/items/{id}',[ItemsController::class, 'update'])->name('updateitems');
        Route::delete('/items/{id}',[ItemsController::class, 'destroy'])->name('destroyitems');
        // items softdelete
        Route::get('/items/trash',[ItemsController::class, 'trashPage'])->name('itemstrash');
        Route::get('/items/restore/{id}',[ItemsController::class, 'restore'])->name('restoreitems');
        Route::delete('/items/trash/{id}',[ItemsController::class, 'deleteTrash'])->name('deleteitems');


        // orders
        Route::get('/orders',[OrderController::class, 'index'])->name('orders');
        Route::get('/orders/{id}',[OrderController::class, 'show'])->name('ordershow');
        Route::post('/orders/{id}',[OrderController::class, 'update'])->name('updateorder');
        Route::delete('/orders/{id}',[OrderController::class, 'destroy'])->name('destroyorder');

        // returns
        Route::get('/orders/return/{id}',[ReturnController::class, 'returnItem'])->name('returnItem');
        Route::post('/orders/return/change',[ReturnController::class, 'returnItemUpdate'])->name('returnItemUpdate');
        Route::post('/orders/return/change/size',[ReturnController::class, 'returnItemSizeUpdate'])->name('returnItemSizeUpdate');

        // invoice
        Route::get('/orders/invoice/{id}',[InvoiceController::class, 'invoiceGenarate'])->name('invoicegenarate');
        
        //delivers
        Route::get('/delivers',[DeliverController::class, 'index'])->name('delivers');
        Route::post('/delivers/{id}',[DeliverController::class, 'update'])->name('updatedelivers');
        Route::get('/delivers/{id}',[DeliverController::class, 'show'])->name('delivershow');

        // reviews
        Route::get('/reviews',[ReviewController::class, 'index'])->name('reviews');
        Route::get('/reviews/{id}/edit',[ReviewController::class, 'edit'])->name('editreviews');
        Route::post('/reviews/{id}',[ReviewController::class, 'update'])->name('updatereviews');
        
        // reports
        Route::view('/reports','Report.reportPage')->name('reports');
        Route::get('/reports/view',[ReportController::class, 'genarateReport'])->name('genarateReport');
        Route::get('/reports/print/{report}/{fromDate}/{toDate}',[ReportController::class, 'printReport'])->name('printReport');

        // attribute
        Route::get('/attributes',[AttributeController::class, 'index'])->name('attributes');
        Route::post('/attributes/size',[AttributeController::class, 'addSize'])->name('addSize');
        Route::delete('/attributes/size/{id}',[AttributeController::class, 'dropSize'])->name('dropSize');
        Route::post('/attributes/brand',[AttributeController::class, 'addBrand'])->name('addBrand');
        Route::delete('/attributes/brand/{id}',[AttributeController::class, 'dropBrand'])->name('dropBrand');
        Route::post('/attributes/others',[AttributeController::class, 'updateOthers'])->name('updateOthers');
        
    });

});









