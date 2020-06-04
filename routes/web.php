<?php


/*
|--------------------------------------------------------------------------
| Apps ALL Routes
|--------------------------------------------------------------------------s
*/
Route::get('/' , function(){
    return redirect()->route('apps.home');
});

Auth::routes();
Route::prefix('apps')->group(function(){
    Route::get('/home','apps\HomeController@index')->name('apps.home');
    Route::group(['middleware' => 'prevent-back-history'],function(){
    Auth::routes();    
    Route::get('/login', 'Auth\AppsUserLoginController@showLoginForm')->name('apps.login');
    Route::post('/login', 'Auth\AppsUserLoginController@login')->name('apps.login.submit');    
    Route::post('/verify/otp', 'Auth\AppsUserLoginController@chkOtpLogin')->name('apps.otp.login.submit');    
    //Resend OTP route
    Route::get('/login/verification/resend/otp', 'Auth\AppsUserLoginController@resendOtp')->name('apps.otp.resend'); 
    //Accounts Routes are here   
    Route::get('/account', 'apps\AccountController@index')->name('apps.account');
    Route::match(['get','post'],'/account/user/edit', 'apps\AccountController@edit')->name('apps.account.edit');
    Route::post('/logout', 'Auth\AppsUserLoginController@logout')->name('apps.logout');
    //Register page will not show, so redirct to login page//
    Route::get('/register', 'Auth\AppsRegisterController@redirectLogin');
    Route::post('/register', 'Auth\AppsRegisterController@register')->name('apps.register');    
    });
    //Home Page related routes are here
    Route::get('/home/products/top/savers','apps\HomeController@topSavers')->name('apps.product.top.savers');
    //Category Routes are here 
    Route::get('/category', 'apps\CategoryController@index')->name('apps.category');    
    Route::get('/category/sub/product/{sub_cat_id}', 'apps\CategoryController@product_by_sub_category')->name('apps.category.sub.product.list');
    Route::get('/product/loadmore/{sub_cat_id}/{product_id}', 'apps\CategoryController@load_more')->name('apps.product.loadmore');
    //Shop and Carts Related Routes are here
    Route::post('/product/add-to-cart','apps\ShopController@add_to_cart')->name('product.add.cart')->middleware('auth:apps');

    // this two routes are not required because of no single page shown
    // Route::get('/show-single-product/{product_id}','apps\ShopController@index')->name('apps.show.single.product');
    // Route::match(['get','post'],'/add-to-cart','apps\ShopController@addCart_singlePage')->middleware('auth:apps');

    Route::get('/cart/add-qty/{cart_id}/{qty}','apps\ShopController@cartAddQty')->name('cart.add.qty')->middleware('auth:apps');
    Route::get('/show-cart/','apps\ShopController@showCart')->name('apps.show.cart')->middleware('auth:apps');
    Route::get('/cart-delete/{cart_id}','apps\ShopController@cart_product_delete')->name('apps.cart.del')->middleware('auth:apps');
    
    //Address Routes are here
    //this route for address when user placing order
    Route::get('show/order/address','apps\AddressController@index_for_order')->middleware('auth:apps')->name('order.address');
    //Account address
    Route::get('show/account/address','apps\AddressController@index_for_account')->middleware('auth:apps')->name('account.address');
    Route::get('address/destroy/{address_id}','apps\AddressController@destroy')->name('address.destroy')->middleware('auth:apps'); 
    
    Route::group(['middleware' => 'prevent-back-history'],function(){

    Route::get('/order/payment/{address_id}/{del_charge}','apps\PaymentController@index')->middleware('prevent-back-history')->middleware('auth:apps')->name('order.payment');
    Route::get('/order/payment/cod','apps\PaymentController@codPayment')->middleware('auth:apps')->name('order.payment.cod');
     //Orders Routes are here
    Route::get('/order/confirm/process','apps\OrderController@confirm_process')->middleware('auth:apps')->name('apps.order.confirm');
    Route::get('/order/success','apps\OrderController@success')->middleware('auth:apps');
    Route::get('/order','apps\OrderController@index')->middleware('auth:apps')->name('apps.order');
    Route::get('/order/view/details/{order_id}','apps\OrderController@orderDetails')->middleware('auth:apps');   
    Route::get('/order/cancel/{order_id}/{product_id}','apps\OrderController@orderCancel')->name('order.cancel')->middleware('auth:apps');
     });
    //Search related routes are here
    Route::get('/search', 'apps\HomeController@search_index');
    Route::get('/search/product', 'apps\HomeController@searchProduct')->name('search.product');
});


