@extends('layouts.seller')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h3>Dashboard</h3>
                <div class="card">
                    <div class="card-body">
                        <div class="row mx-3">
                            <div class="col-6">
                                <h4 class="card-title my-2">Available items</h4>
                            </div>
                            <div class="col-6 d-flex justify-content-end align-items-center">
                               <a href="/seller/product/my-product"> <i class="fas fa-arrow-alt-circle-right fa-3x text-success"></i></a> 
                            </div>
                        </div>
                        
                        <div class="row my-3">
                            <div class="col-4 text-center">
                                <p>{{\App\Stock::all()->where('seller_id', $id)->count()}}</p>
                                <span class="h6">All</span>
                            </div>
                            <div class="col-4 text-center">
                              <p> {{\App\Stock::countStockFromByCategory($id,2)}}</p> 
                                <span class="h6">Meat</span>
                            </div>
                            <div class="col-4 text-center">
                               <p>{{\App\Stock::countStockFromByCategory($id,3)}}</p> 
                                <span class="h6">Vegetable</span>
                            </div>
                        </div>
        
                        <div class="row my-3">
                            <div class="col-4 text-center">
                              <p> {{\App\Stock::countStockFromByCategory($id,4)}}</p> 
                                <span class="h6">Fuits</span>
                            </div>
                            <div class="col-4 text-center">
                               <p> {{\App\Stock::countStockFromByCategory($id,1)}}</p>
                                <span class="h6">Fish</span>
                            </div>
                           
                        </div>
                        <div class="row mx-3 mt-3">
                            <div class="col-6">
                                <h4 class="card-title my-2">Orders</h4>
                            </div>
                            <div class="col-6 d-flex justify-content-end align-items-center">
                               <a href="/seller/order/order-request"> <i class="fas fa-arrow-alt-circle-right fa-3x text-success"></i></a> 
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-4 text-center">
                                <p>{{\App\Order::countSellerDashboard($id,null)}}</p>
                                <span class="h6">All</span>
                            </div>
                            <div class="col-4 text-center">
                                <p>{{\App\Order::countSellerDashboard($id,'OR')}}</p>
                                <span class="h6">Order Request</span>
                            </div>
                            <div class="col-4 text-center">
                                <p>{{\App\Order::countSellerDashboard($id,'P')}}</p>
                                <span class="h6">Pending</span>
                            </div>
                        </div>
        
                        <div class="row my-3">
                            <div class="col-4 text-center">
                                <p>{{\App\Order::countSellerDashboard($id,'D')}}</p>
                                <span class="h6">Delivering</span>
                            </div>
                            <div class="col-4 text-center">
                                <p>{{\App\Order::countSellerDashboard($id,'RR')}}</p>
                                <span class="h6">Return request</span>
                            </div>
                            
                        </div>

                        <div class="row mx-3 mt-3">
                            <div class="col-6">
                                <h4 class="card-title my-2">Transaction history</h4>
                            </div>
                            <div class="col-6 d-flex justify-content-end align-items-center">
                               {{-- <a href="/seller/history"> <i class="fas fa-arrow-alt-circle-right fa-3x text-success"></i></a>  --}}
                            </div>
                        </div>
                        <div class="row my-3">
                        
                            <div class="col-4 text-center">
                                <p>{{\App\Order::countSellerDashboard($id,'C')}}</p>
                                <span class="h6">Completed</span>
                            </div>
                            <div class="col-4 text-center">
                                <p>{{\App\Order::countSellerDashboard($id,'RC')}}</p>
                                <span class="h6">Rejected/Cancelled</span>
                            </div>
                            <div class="col-4 text-center">
                                <p>{{\App\Order::countSellerDashboard($id,'RE')}}</p>
                                <span class="h6">Returned</span>
                            </div>
                        </div>
                </div>
            </div>
        </div>
             
    </div>
    
@endsection