<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;

Route::get('/',[HomeController::class, 'home']);

//login
Route::any('/login',[LoginController::class, 'login']);
Route::any('/ajax-login',[LoginController::class, 'ajaxLogin']);
Route::any('/Wishlogin/{id?}',[LoginController::class, 'Wishlogin']);
Route::any('/logout',[LoginController::class, 'logout']);
Route::any('/loginAction',[LoginController::class, 'loginAction']);

Route::any('/add_wishlist',[ProductController::class, 'add_wishlist']);
Route::any('/wishList',[UserController::class, 'wishList']);


Route::any('/get-wishlist-items',[UserController::class, 'getwishListItems']);
Route::any('/check-product-wishlist',[UserController::class, 'checkWishList']);


Route::any('/remove_wishlist',[ProductController::class, 'remove_wishlist']);

//add cart
Route::any('/addToCart',[ProductController::class,'addToCart']);
Route::any('/cart-products',[ProductController::class,'cartProducts']);
Route::any('/get-cart-items',[ProductController::class,'getCartItems']);
Route::any('/get-cart-count',[ProductController::class,'getCartCount']);
Route::any('/remove-cart-item',[ProductController::class,'removeCartItem']);



//sinup
Route::any('/signup',[UserController::class, 'create']);
Route::any('/registerAction',[UserController::class, 'store']);

//products

Route::get('/products',[ProductController::class, 'products']);
Route::any('/product-view/{id}',[ProductController::class, 'productView']);

//add
Route::get('/add-product',[ProductController::class, 'addProduct']);
Route::post('/store-product',[ProductController::class, 'storeProduct']);

//edit
Route::any('/edit-product/{id}',[ProductController::class, 'editProduct']);
Route::any('/update-product/{id}',[ProductController::class, 'updateProduct']);

Route::any('/update-product-quantity',[ProductController::class, 'updateProductQuantity']);
Route::any('/delete-product/{id}',[ProductController::class, 'deleteProduct']);

Route::any('/get-products-ajax',[ProductController::class, 'productsAjax']);

//
Route::any('/photos',[PhotoController::class, 'index']);
Route::any('/getimages',[PhotoController::class, 'getimages']);
Route::any('/imageUpload',[PhotoController::class, 'imageUpload']);
