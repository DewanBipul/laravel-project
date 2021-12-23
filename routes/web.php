<?php

use App\Http\Controllers\cartcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontendcontroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\categorycontroller;
use App\Http\Controllers\Controller;
use App\Http\Controllers\couponcontroller;
use App\Http\Controllers\productcontroller;
use App\Http\Controllers\profilecontroller;
use App\Http\Controllers\subcategorycontroller;
use App\Models\subcategory;
use Monolog\Handler\RollbarHandler;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

//frontend

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/', [Controller::class, 'welcome']);
Route::get('/product/details/{product_id}', [Controller::class, 'product_details']);
Route::get('/product/single_view/{product_id}', [controller::class, 'singleview']);
Route::get('/shopproduct', [Controller::class, 'shop']);
Route::get('/category/product/{product_id}', [Controller::class, 'product_list']);
Route::get('/checkout', [Controller::class, 'checkout']);
Route::post('/getcitylist', [Controller::class, 'getcitylist']);

//category route

Route::get('/addcategory', [categorycontroller::class, 'index']);
Route::post('/category/insert', [categorycontroller::class, 'insert']);
Route::get('/category/delete/{category_id}', [categorycontroller::class, 'delete']);

//subcategory

Route::get('/subcategories', [subcategorycontroller::class, 'index']);
Route::post('/category/subcategory', [subcategorycontroller::class, 'insert']);
Route::get('/subcategory/delete/{subcategory_id}', [subcategorycontroller::class, 'delete']);
Route::get('/subcategory/edit/{subcategory_id}', [subcategorycontroller::class, 'edit']);
Route::post('/subcategory/update', [subcategorycontroller::class, 'update']);
Route::get('/subcategory/restore/{undo}', [subcategorycontroller::class, 'restore']);
Route::get('/subcategory/perdelete/{permanent}', [subcategorycontroller::class, 'perdelete']);
Route::post('/subcategory/markdelete', [subcategorycontroller::class, 'markdelete']);
Route::post('/trashed/markall', [subcategorycontroller::class, 'markall']);

//edit profile
Route::get('/edit/editprofile', [profilecontroller::class, 'editprofile']);
Route::post('/profile/update', [profilecontroller::class, 'namechange']);
Route::post('/profile/passchange', [profilecontroller::class, 'passchange']);
Route::post('/profile/photochange', [profilecontroller::class, 'photochange']);


//product route

Route::get('/product/list', [productcontroller::class, 'list']);
Route::post('/product/insert', [productcontroller::class, 'insert']);
Route::get('/product/edit/{id}', [productcontroller::class, 'edit']);
Route::post('/product/update', [productcontroller::class, 'update']);
Route::get('/product/delete/{id}', [productcontroller::class, 'delete']);


//cart route

Route::Post('/addto/cart', [cartcontroller::class, 'addtocart']);
Route::get('/delete/cart/{cart_id}', [cartcontroller::class, 'cartdelete']);
Route::get('/cart', [cartcontroller::class, 'cart']);
Route::get('/cart/{coupon_name}', [cartcontroller::class, 'cart']);
Route::post('/cart/update', [cartcontroller::class, 'cartupdate']);
Route::get('cart/delete/{cart_id}', [cartcontroller::class, 'delete']);
Route::post('/order/confirm', [cartcontroller::class, 'order']);




//coupon route

Route::get('/coupon', [couponcontroller::class, 'couponcart']);
Route::post('/coupon/insert', [couponcontroller::class, 'insert']);

Route::post('/user/insert', [HomeController::class, 'insert']);
Route::get('/user/get', [HomeController::class, 'view']);


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/online/payment', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

//invoice route

Route::get('/invoice/dwonload/{order_id}', [HomeController::class, 'invoicedwonload']);


//search route

Route::get('/search', [HomeController::class, 'search']);


//email varified


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');




Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');




Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

