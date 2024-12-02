<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ChapaController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TelegramBotController;
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
Route::get('/',[HomeController::class ,'index']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect',[HomeController::class ,'redirect'])->middleware('auth','verified');
Route::post("/sendsms/{id}",[SmsController::class,'sendsms']);
Route::get('auth/login', [RegisterController::class, 'googlepagelogin']);
// Route::get('auth/google/signup/callback', [RegisterController::class, 'googlecallbacklogin'])->name('auth.google.signup.callback');
Route::get('auth/google/callback', [RegisterController::class, 'googlecallbacklogin']);
// Route::post('auth/google', [RegisterController::class, 'googlepage']);
Route::post('newlogin', [RegisterController::class, 'newlogin']);
Route::get('newl', [RegisterController::class, 'newlogin2']);
Route::post('regnew', [RegisterController::class, 'registerUser'])->name('regnew');
// Route::get('auth/google/callback', [RegisterController::class, 'googlecallback']);
Route::get('/red',[HomeController::class ,'red']);
Route::get('/view_catagory',[AdminController::class,'view_catagory']);
Route::post('/add_catagory',[AdminController::class,'add_catagory']);
Route::get('delete/{id}',[AdminController::class,'delete']);
Route::get('/view_product',[AdminController::class,'view_product']);
Route::get('/view_customer',[AdminController::class,'view_customer']);
Route::post('/add_product',[AdminController::class,'add_product']);
Route::get('show_product',[AdminController::class,'show_product']);
Route::get('deletepro/{id}',[AdminController::class,'Deletepro']);
Route::get('deleteuser/{id}',[AdminController::class,'Deleteuser']);
Route::get('deletecustpro/{id}',[AdminController::class,'Deletecustpro']);
Route::get('editpro/{id}',[AdminController::class,'EditPro']);
Route::get('editcust/{id}',[AdminController::class,'Editcust']);
Route::post('updpro/{id}',[AdminController::class,'Update']);
Route::post('updcust/{id}',[AdminController::class,'Updcust']);
Route::get('change/{id}',[AdminController::class,'Change']);
Route::get('/order',[AdminController::class,'order']);
Route::get('/normalusers',[AdminController::class,'users']);
Route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);
Route::get('/print_pdfuser/{id}',[HomeController::class,'print_pdf']);
Route::get('/send_email/{id}',[AdminController::class,'send_email']);
Route::get('/search',[AdminController::class,'searchdata']);
Route::get('/searchpro',[AdminController::class,'searchpro']);
Route::get('/searchcustpro',[AdminController::class,'searchcustpro']);
Route::get('/searchuser',[AdminController::class,'searchuser']);
Route::get('/comment',[AdminController::class,'comment']);
Route::get('/deletecom/{id}',[AdminController::class,'deletecom']);
Route::post('/send_user_email/{id}',[AdminController::class,'send_user_email']);
Route::get('/shippingadmin',[AdminController::class,'shippingadmin'])->name('shippingadmin');
Route::get('/searchship',[AdminController::class,'searchship'])->name('searchship');
Route::get('/deleteodrshp/{id}',[AdminController::class,'deleteodrshp'])->name('deleteodrshp');
Route::post('/send_seller_email/{id}',[HomeController::class,'send_seller_email']);
Route::get('product_details',[HomeController::class,'product_details'])->name('product_detail');
Route::get('product_detail/{productId}',[HomeController::class,'product_detail']);
Route::get('product_detailseller',[HomeController::class,'product_detailseller'])->name('product_detailseller');
Route::get('store',[HomeController::class,'store'])->name('store');
Route::get('back',[HomeController::class,'back']);
Route::post('add_cart',[HomeController::class,'add_cart'])->name('add_cart');
Route::post('add_cartfull',[HomeController::class,'add_cartfull'])->name('add_cartfull');
Route::post('add_wishlist',[HomeController::class,'add_wishlist'])->name('add_wishlist');
Route::post('add_wishlistfull',[HomeController::class,'add_wishlistfull'])->name('add_wishlistfull');
Route::post('upd_cart/{id}',[HomeController::class,'upd_cart']);
Route::get('/show_cart',[HomeController::class,'show_cart'])->name('show_cart');
Route::get('/show_wishlist',[HomeController::class,'show_wishlist'])->name('show_wishlist');
Route::post('/delete_wish',[HomeController::class,'delete_wish'])->name('delete_wish');
Route::get('/restorewish/{wishid}',[HomeController::class,'restorewish'])->name('restorewish');
Route::get('/show_order',[HomeController::class,'show_order']);
Route::get('/contact',[HomeController::class,'contact']);
Route::get('/about',[HomeController::class,'about']);
Route::get('/sell',[HomeController::class,'sell']);
Route::post('/sellproduct',[HomeController::class,'sellproduct']);
Route::get('/category/{name}',[HomeController::class,'category']);
Route::get('/deletecart/{id}',[HomeController::class,'deletecart']);
Route::get('/restorecart/{id}',[HomeController::class,'restorecart']);
Route::get('/cancel_order/{id}',[HomeController::class,'cancel_order']);
Route::get('/cash_order',[HomeController::class,'cash_order']);
Route::post('/send_comment',[HomeController::class,'send_comment']);
Route::get('/full_product',[HomeController::class,'full_product']);
Route::get('/seller_items',[HomeController::class,'seller_items']);
Route::get('/search_product',[HomeController::class,'search_product']);
Route::get('/email',[OrderController::class,'email']);
Route::get('/checkout',[HomeController::class,'checkout']);
Route::post('/shipping',[HomeController::class,'shipping'])->name('shipping');
Route::get('/paymethod',[HomeController::class,'paymethod'])->name('payment.methods');
Route::get('confirmchapapayment',[HomeController::class,'confirmchapapayment']);
Route::get('/search_seller_Item',[HomeController::class,'search_seller_Item']);
Route::get('/stripe',[HomeController::class,'stripe'])->name('stripe');
Route::post('/stripe',[HomeController::class,'stripePost'])->name('stripe.post');
Route::get('createpaypal',[PayPalController::class,'createpaypal'])->name('createpaypal');
Route::get('processPaypal',[PayPalController::class,'processPaypal'])->name('processPaypal');
Route::get('processSuccess',[PayPalController::class,'processSuccess'])->name('processSuccess');
Route::get('processCancel',[PayPalController::class,'processCancel'])->name('processCancel');
Route::get('/payoption',[HomeController::class,'payoption'])->name('payoption');
Route::get('/chapa',[HomeController::class,'chapa'])->name('chapa');
Route::post('/telegram/webhook', [TelegramBotController::class,'handle'])->name('handle');
// The route that the button calls to initialize payment

Route::post('/pay',[ChapaController::class,'initialize'])->name('pay');

// The callback url after a payment
Route::get('callback/{reference}', [ChapaController::class,'callback'])->name('callback');



