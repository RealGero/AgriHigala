<?php

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


        // INBOX == PEOPLE , MESSAGE == CHAT ----------------------------------------------
Route::get('/', function () {

    return view('welcome');
});

Route::get('/admin', 'admin\AdminsController@adminDashboard')->name('admin');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

// Route::get('/buyer', 'HomeController@index')->name('home');

Route::resource('users', 'UsersController');

// Route::group(['middleware'=> ['auth']],function()
// {

    // Route::group(['middleware' => ['buyer']], function()
    // {
        
     
        Route::get('/buyer/browse/seller/{id}','BrowsesController@viewSellerDetails');


        Route::get('buyer/profile','Userscontroller@index');
        
      
        Route::get('/cart','CartController@getCart')->name('cart.index');
        Route::get('/buyer/cart/{id}','CartController@index');



        //delete item from cart
        Route::get('/buyer/deleteCart/{id}','CartController@deleteCart')->name('deleteCart');
///////////////////////////
        // Route::post::
        Route::get('/change-qty/{id}', "CartController@changeQty")->name('change_qty');

        Route::get('/buyer/browse','BrowsesController@index')->name('browse.index');
        Route::get('/buyer/browse/{id}','CartController@add');

        Route::get('/buyer/seller-detail/{id}','CartController@addFromSellerProfile');

        Route::get('/delete/session', 'CartController@deleteSession');
        Route::get('/checkout/{id}','OrdersController@checkoutIndex')->name('checkoutIndex')->middleware('auth');
        Route::post('/place-order/{id}' ,'OrdersController@clickedPlaceOrder');


        Route::put('/checkout/change','UsersController@updateProfileCheckout');
        // Route::get('/buyer/cart/checkout','buyercontroller\OrdersController@checkoutIndex')->name('check-out.index');


        // Route::get('/buyer/order/order-received','buyercontroller\OrdersController@orderReceivedIndex');
        // Route::get('/buyer/order/return','buyercontroller\OrdersController@orderReturn');
        // Route::get('/buyer/profile/id','UsersController@showprofile');
        // Route::get('/buyer/message','buyercontroller\MessagesController@index');



        Route::get('/buyer/history','buyercontroller\HistoriesController@index');

        Route::get('/buyer/profile/edit','UsersController@edit')->name('buyer.profile.edit');
        Route::put('/buyer/profile/edit','UsersController@update')->name('buyer.profile.update');
        Route::put('/buyer/profile/updateimage','UsersController@updateUserImage');
        Route::put('buyer/accout/updateid','UsersController@updateValidId');
        Route::post('/buyer/profile','UsersController@store');
       


        Route::get('/buyer/user/account','UsersController@userAccount')->name('buyer.useraccount');
        Route::put('/buyer/user/account','UsersController@updateAccountUsername');
        Route::put('/buyer/user/password','UsersController@updateAccountPassword');

        Route::get('/about','buyercontroller\PagesController@aboutUs');
        Route::get('/contact','buyercontroller\PagesController@contactUs');
        Route::get('/buyer/discount','buyercontroller\DiscountsController@index');
        Route::get('/buyer/feedback','FeedBacksController@buyerFeedbackIndex')->name('buyerFeedback.index');
        Route::post('/buyer/feedback','FeedBacksController@buyerFeedbackStore')->name('buyerFeedback.store');
        Route::get('/customer-service','buyercontroller\PagesController@customerService');

        Route::get('/buyer/order/order-view-details','buyercontroller\OrdersController@viewOrderDetails');

        Route::get('/buyer/order/myorder/{id?}', 'OrdersController@orderMyOrder')->name('buyer.order');
        Route::put('/buyer/order/cancel/{id}', 'OrdersController@orderMyOrderCancel')->name('buyer.order.cancel');
        Route::put('/buyer/order/received/{id}', 'OrdersController@orderMyOrderReceived')->name('buyer.order.received');
        Route::get('/buyer/order/vieworder/{id}','OrdersController@viewMoreOrder')->name('buyer.orderView.index');
        // Route::get('/buyer/order/uploadImage/{id}','OrdersController@uploadImageInViewOrder');
        Route::put('/buyer/order/uploadPayment/{id}','OrdersController@uploadImageInViewOrder');

        Route::put('/buyer/order/online-cod', 'OrdersController@changeToCod');
        Route::post('/buyer/send-image/{id}','OrdersController@paymentImage')->name('payment.image');

        // Route::get('buyer/order/payment','OrdersController@paymentIndex')->name('payment.index');
        //new -----------------------------------------------------------------------------------
        // Route::get('/buyer/placeholder','OrdersController@clickedPlaceOrder');

        Route::get('/buyer/order/myreturn', 'buyercontroller\OrdersController@orderMyReturn');
        Route::get('/buyer/order/mycancellation', 'buyercontroller\OrdersController@orderMyCancellation');

        Route::get('/buyer/chat/{id}','MessagesController@buyerInboxMessage')->name('buyer.chat');
        Route::get('/buyer/message/{id}', 'MessagesController@buyerMessage')->name('buyerMessage.index');
        Route::get('/buyer/inbox', 'InboxController@buyerInboxIndex');
        Route::post('/buyer/message/{id}', 'MessagesController@buyerMessageStore')->name('buyerMessage.store');
    // });

        // order------------------------------------------------------------------------
        // Ratings===========================================================
        Route::get('/buyer/ratings/{id}', 'RatingsController@orderMyOrderRatings')->name('buyer.ratings.index');
        Route::post('/buyer/ratings/store', 'RatingsController@buyerStore')->name('buyer.ratings.store');
        



//Seller-----------------------------------------------------------------------------------------

        
        // Route::post('addtocart',function(){
        //    return Cart::add('293ad', 'Product 1', 1, 9.99);
        // });


// ADD TO CART--------------------------------------------------------------------------------------------------
        

        Route::get('/seller/dashboard','DashboardsController@sellerIndex')->name('sellerdashboard');
        
        Route::get('/seller/product/my-product', 'sellercontroller\ProductsController@productMyProduct');
                
        //edit product -----------------------------------------------------

        Route::get('/seller/product/product-name/','sellercontroller\ProductsController@editProduct');
        Route::get('/seller/product/product-name/{id}', 'sellercontroller\ProductsController@getProductName');

        Route::get('/seller/product/edit-product/{id}','sellercontroller\ProductsController@editProduct');
        Route::put('/seller/product/update-product/{id}','sellercontroller\ProductsController@updateProduct')->name('updateProd');

    

        // PRODUCT-------------------------------------------------------------------------------------------
        Route::get('/seller/product/add-new-product', 'sellercontroller\ProductsController@addNewProduct');
        Route::get('/seller/product/add-new-product/{id?}', 'sellercontroller\ProductsController@addNewProduct');
       
        Route::get('/seller/prduct/delete-product/{id}', 'sellercontroller\ProductsController@deleteProduct');
        Route::post('/seller/product/add-new-product/', 'sellercontroller\ProductsController@storeNewProduct');

        Route::get('/seller/order/viewmore/{id}','OrdersController@sellerViewmore')->name('sellerViewMore');       
        Route::get('/seller/order/order-request', 'OrdersController@orderRequest')->name('order.request.index');
        Route::get('/seller/order/order-request/{id}', 'OrdersController@sellerOrderRequest')->name('orderRequestwithId');
        Route::get('/seller/order/order-packed/{id}', 'OrdersController@orderPacked')->name('orderPacked');

        Route::get('/seller/order/order-detail', 'SellerOrdersController@orderDetails');
        Route::get('/seller/history', 'SellerOrdersController@transactionHistory');
        Route::get('/seller/return', 'SellerOrdersController@orderReturn');

        // Route::get('/seller/inbox/','MessagesController@sellerMessage')->name('sellerMessage.index');
        Route::get('/seller/inbox','InboxController@sellerInboxIndex')->name('sellerInbox.index');
        Route::get('/seller/message/{id}','MessagesController@sellerMessageIndex')->name('sellerMessage.index');

        Route::get('/seller/feedback', 'FeedBacksController@sellerFeedbackIndex')->name('sellerFeedback.index');
        Route::post('/seller/feedback', 'FeedBacksController@sellerFeedbackStore')->name('sellerFeedback.store');

    
        Route::get('/seller/earnings', 'sellercontroller\EarningsController@index');

        Route::get('/seller/profile', 'UsersController@sellerProfile')->name('seller.profile');
        Route::put('/seller/profile/updateImage', 'UsersController@updateSellerProfileImage');
        Route::put('/seller/profile', 'UsersController@updateSellerDetails');

        Route::get('/seller/account', 'UsersController@sellerAccount')->name('seller.account');
        Route::put('/seller/account/update', 'UsersController@sellerAccountUpdate')->name('seller.update');
        Route::put('/seller/account/username' ,'UsersController@sellerUpdateUsername');
        // Route::get('/seller/rider','sellercontroller\MyRiderController@index');
        Route::get('/seller/ratings', 'RatingsController@sellerIndex')->name('seller.ratings.index');
        
        
        
        
        
        //Rider------------------------------------------------------------------------------------------
        
        
        
        Route::get('seller/view-rider','RidersController@viewSellerRider')->name('rider.index') ;      
        Route::get('/seller/rider/create','RidersController@createRider')->name('rider.create');
        Route::post('/seller/rider/create','RidersController@store')->name('rider.store');
      
        Route::get('/rider/profile/','RidersController@profileIndex')->name('rider.profile.index');      
        Route::put('/rider/profile/edit','RidersController@profileUpdate')->name('rider.profile.update');      
        Route::put('/rider/profile/image','RidersController@imageUpdate')->name('rider.image.update'); 
        
        
        Route::get('/rider/account','RidersController@accountIndex')->name('account.index');
        Route::put('/rider/password','RidersController@passwordUpdate')->name('rider.changepassword');

        Route::get('/rider/orders', 'RidersController@orders')->name('rider.order.index');
        Route::put('/rider/orders/deliver/{id}','RidersController@riderDeliveredAt')->name('rider.deliveredAt');

        Route::get('/rider/dashboard','Riderscontroller@dashboard');
        Route::get('/rider/history', 'RidersController@orderDetails');

   

// });

/* 
Admin
 */
Route::prefix('admin')->group(function () {
    // ADMIN
    Route::get('/login', 'admin\AdminsController@showAdminLoginForm')->name('admin.login');
    Route::get('/reviews', 'admin\AdminsController@showAdminLoginForm')->name('admin.review.index');

    // USERS
    Route::resource('/users','admin\UsersController', ['names' => 'admin.users']);
    Route::get('/users/create/{id?}', 'admin\UsersController@create')->name('admin.users.create');

    // CATEGORIES:PRODUCT-TYPE
    Route::resource('/categories','admin\ProductTypesController', ['names' => 'admin.categories']);

    // PRODUCTS
    Route::resource('/products','admin\ProductsController', ['names' => 'admin.products']);

    // STOCKS
    Route::resource('/stocks','admin\StocksController', ['names' => 'admin.stocks']);
    Route::get('/stocks/create/{id?}', 'admin\StocksController@create')->name('admin.stocks.create');
    
    // ORDERS
    Route::resource('/orders','admin\OrdersController', ['names' => 'admin.orders']);
    Route::put('/orders/{id}/response', 'admin\OrdersController@sellerOrderRequest')->name('admin.orders.response');
    Route::put('/orders/{id}/packed', 'admin\OrdersController@sellerOrderPending')->name('admin.orders.packed');
    Route::put('/orders/{id}/cancel', 'admin\OrdersController@buyerOrderPending')->name('admin.orders.cancel');
    Route::put('/orders/{id}/delivered', 'admin\OrdersController@riderOrderDelivering')->name('admin.orders.delivered');
    Route::put('/orders/{id}/received', 'admin\OrdersController@buyerOrderDelivered')->name('admin.orders.received');
    
    // RETURN ORDERS
    Route::resource('/returns','admin\ReturnOrdersController', ['names' => 'admin.returns']);
    Route::put('/returns/{id}/response', 'admin\ReturnOrdersController@sellerReturnRequest')->name('admin.returns.response');
    Route::put('/returns/{id}/delivered', 'admin\ReturnOrdersController@riderReturnDelivering')->name('admin.returns.delivered');

    // HISTORY ORDERS
    Route::resource('/history','admin\HistoryController', ['names' => 'admin.history']);

    // MESSAGES
    Route::resource('/messages','admin\MessagesController', ['names' => 'admin.messages']);
    
    // RATINGS
    Route::get('/ratings', 'admin\RatingsController@index')->name('admin.ratings.index');
    
    // FEEDBACK
    Route::get('/feedbacks', 'admin\SettingsController@feedbacks')->name('admin.feedbacks');

    // ANNOUNCEMENT
    Route::get('/announcements', 'admin\SettingsController@announcements')->name('admin.announcements');
    Route::get('/announcements/create', 'admin\SettingsController@createAnnouncements')->name('admin.announcements.create');
    Route::post('/announcements/store', 'admin\SettingsController@storeAnnouncements')->name('admin.announcements.store');
    Route::delete('/announcements/destroy/{id}', 'admin\SettingsController@destroyAnnouncements')->name('admin.announcements.destroy');

    // CUSTOMER SERVICE
    Route::get('/customer-service', 'admin\SettingsController@customerService')->name('admin.customer-service');
    Route::get('/customer-service/{id}', 'admin\SettingsController@replyCustomerService')->name('admin.customer-service.reply');
    Route::post('/customer-service/store', 'admin\SettingsController@storeCustomerService')->name('admin.customer-service.store');    

    

});

// NOTIFICATION
Route::post('/notifications/get', 'NotificationsController@get')->name('notifications.get');
Route::post('/notifications/read/{id}', 'NotificationsController@read')->name('notifications.read');
Route::post('/notifications/read-all/', 'NotificationsController@readAll')->name('notifications.read.all');