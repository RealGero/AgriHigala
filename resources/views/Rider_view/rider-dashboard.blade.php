@extends('layouts.rider')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h3>Dashboard</h3>
                <div class="card">
                    <div class="card-body">
                        <div class="row mx-3 mt-3">
                            <div class="col-6">
                                <h4 class="card-title my-2">Orders</h4>
                            </div>
                            <div class="col-6 d-flex justify-content-end align-items-center">
                               <a href="{{route('rider.order.index')}}"> <i class="fas fa-arrow-alt-circle-right fa-3x text-success"></i></a> 
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-3 text-center">
                                <p>{{\App\Order::countRiderDashboard($id,null)}}</p>
                                <span class="h6">All</span>
                            </div>
                            <div class="col-3 text-center">
                                <p>{{\App\Order::countRiderDashboard($id,'D')}}</p>
                                <span class="h6">Delivering</span>
                            </div>
                            <div class="col-3 text-center">
                                <p>{{\App\Order::countRiderDashboard($id,'C')}}</p>
                                <span class="h6">Completed</span>
                            </div>
                            <div class="col-3 text-center">
                                <p>{{\App\Order::countRiderDashboard($id,'RE')}}</p>
                                <span class="h6">Return</span>
                            </div>
                        </div>
                    </div>
                </div>
         </div>
             
     </div>
    </div>  
@endsection