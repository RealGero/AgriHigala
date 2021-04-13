<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {

    return view('welcome');
});

Auth::routes();

// Route::get('/buyer', 'HomeController@index')->name('home');

Route::resource('users', 'UsersController');

// Route::group(['middleware'=> ['auth']],function()
// {

    // Route::group(['middleware' => ['buyer']], function()
    // {
        
      
        Route::get('/buyer/browse/seller/{id}','BrowsesController@viewSellerDetails');
        Route::get('buyer/profile','Userscontroller@index');
        
        Route::get('/buyer/verification','buyercontroller\ProfilesController@verification');
        Route::get('/buyer/order','buyercontroller\OrdersController@index');
        Route::get('/buyer/product-detail','buyercontroller\ProductsController@index');

        Route::get('/cart','CartController@getCart')->name('cart.index');
        Route::get('/buyer/cart/{id}','CartController@index');

        //delete item from cart
        Route::get('/buyer/deleteCart/{id}','CartController@deleteCart')->name('deleteCart');

        Route::get('/buyer/browse','BrowsesController@index')->name('browse.index');
        Route::get('/buyer/browse/{id}','CartController@add');

        Route::get('/delete/session', 'CartController@deleteSession');


        Route::get('/buyer/cart/checkout','buyercontroller\OrdersController@checkoutIndex');
        Route::get('/buyer/order/order-received','buyercontroller\OrdersController@orderReceivedIndex');
        Route::get('/buyer/order/return','buyercontroller\OrdersController@orderReturn');
        // Route::get('/buyer/profile/id','UsersController@showprofile');
        Route::get('/buyer/message','buyercontroller\MessagesController@index');
        Route::get('/buyer/history','buyercontroller\HistoriesController@index');

        Route::get('/buyer/profile/edit','UsersController@edit');
        Route::put('/buyer/profile/edit','UsersController@update');
        Route::put('/buyer/profile/updateimage','UsersController@updateUserImage');
        Route::put('buyer/accout/updateid','UsersController@updateValidId');
        Route::post('/buyer/profile','UsersController@store');
       


        Route::get('/buyer/user/account','UsersController@userAccount');
        Route::put('/buyer/user/account','UsersController@updateAccountUsername');
        Route::put('/buyer/user/password','UsersController@updateAccountPassword');

        Route::get('/about','buyercontroller\PagesController@aboutUs');
        Route::get('/contact','buyercontroller\PagesController@contactUs');
        Route::get('/buyer/discount','buyercontroller\DiscountsController@index');
        Route::get('/feedback','buyercontroller\PagesController@feedback');
        Route::get('/customer-service','buyercontroller\PagesController@customerService');

        Route::get('/buyer/order/order-view-details','buyercontroller\OrdersController@viewOrderDetails');

        //new -----------------------------------------------------------------------------------

        Route::get('/buyer/order/myorder', 'buyercontroller\OrdersController@orderMyOrder');
        Route::get('/buyer/order/myreturn', 'buyercontroller\OrdersController@orderMyReturn');
        Route::get('/buyer/order/mycancellation', 'buyercontroller\OrdersController@orderMyCancellation');
    // });

//Seller-----------------------------------------------------------------------------------------

        
        // Route::post('addtocart',function(){
        //    return Cart::add('293ad', 'Product 1', 1, 9.99);
        // });


// ADD TO CART--------------------------------------------------------------------------------------------------
        

        Route::get('/seller/dashboard','UsersController@sellerIndex');
        
        Route::get('/seller/product/my-product', 'sellercontroller\ProductsController@productMyProduct');

        Route::get('/seller/order/order-request', 'sellercontroller\OrdersController@orderRequest');

        // PRODUCT-------------------------------------------------------------------------------------------
        Route::get('/seller/product/add-new-product', 'sellercontroller\ProductsController@addNewProduct');
        Route::get('/seller/product/add-new-product/{id}', 'sellercontroller\ProductsController@addNewProduct');
        Route::get('/seller/product/product-name/{id}', 'sellercontroller\ProductsController@getProductName');
        Route::get('/seller/prduct/delete-product/{id}', 'sellercontroller\ProductsController@deleteProduct');
        Route::post('/seller/product/add-new-product', 'sellercontroller\ProductsController@storeNewProduct');


        
        Route::get('/seller/order/order-detail', 'sellercontroller\OrdersController@orderDetails');
        Route::get('/seller/history', 'sellercontroller\OrdersController@transactionHistory');
        Route::get('/seller/return', 'sellercontroller\OrdersController@orderReturn');
        Route::get('/seller/ratings', 'sellercontroller\RatingsController@index');
        Route::get('/seller/earnings', 'sellercontroller\EarningsController@index');
        Route::get('/seller/profile', 'UsersController@sellerProfile');
        Route::put('/seller/profile/updateImage', 'UsersController@updateSellerProfileImage');
        Route::put('/seller/profile', 'UsersController@updateSellerDetails');

        Route::get('/seller/account', 'UsersController@sellerAccount');
        Route::get('/seller/rider','sellercontroller\MyRiderController@index');
    
    



//Rider------------------------------------------------------------------------------------------



        Route::get('/seller/rider/create','RidersController@index');
        Route::post('/seller/rider/create','RidersController@store');
      

        Route::get('/rider/dashboard','Riderscontroller@dashboard');
        Route::get('/rider/orders', 'RidersController@orders');
        Route::get('/rider/history', 'RidersController@orderDetails');
   

   

// });

