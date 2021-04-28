@extends('layouts.seller')

@section('content')

    <div class="container">
        <div class="seller-order-return">
            <div class="row">
                <div class="col-12 mx-auto">
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                     @endif
                     <span class="h4">Return Orders</span>
                    <div class="card">
                        <div class="card-body">
                            @foreach ($orders as $order) 
                                @php
                                    $orderLines = \App\ReturnOrder::getOrderLines($order->order_id)
                                @endphp
                               {{-- {{dd($orderLines)}} --}}
                                <div class="row">
                                    <div class="col-12 mb-5">
                                        <table class="table table-borderless">
                                            <thead>
                                              <tr>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                              </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($orderLines as $orderLine)
                                                    
                                              
                                              <tr>
                                                <td> <img src="{{ url('/storage/') }}{{ $orderLine->stock_image ? '/stock/'. $orderLine->stock_image : '/seller/product_type_image/default_product_image.jpg'  }}" alt=""></td>
                                                <td>  {{$orderLine->product_name}}  
                                                
                                                <td>Quantity: {{$orderLine->order_qty}}</td>
                                                <td>&#8369;{{number_format($orderLine->stock_price)}}/{{ucfirst($orderLine->unit_description)}}</td>
                                                <td>&#8369;{{number_format($orderLine->stock_price * $orderLine->order_qty) }}</td>
                                              </tr>
                                              @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                           
                            
                            <div class="row ">
                                <div class="col-3 d-flex flex-column justify-content-around">
                                    
                                  <span><span class="font-weight-bold">Other Fee :</span> <span>&#8369;{{number_format($order->fee_other)}}</span></span>
                                  <span><span class="font-weight-bold">Delivery fee:</span> <span>&#8369;{{number_format($order->fee_delivery)}}</span></span>
                                  <span><span class="font-weight-bold">Subtotal Fee:</span> <span>&#8369;{{number_format($order->payment_order )}}</span></span>
                                  <span><span class="font-weight-bold">Total fee: </span> <span> &#8369;{{number_format($order->payment_total) }}</span></span>
                                </div>
                                <div class="col-3 d-flex flex-column">
                                    
                              <span> <span class="font-weight-bold">Payment method:</span> <span>{{ucfirst($order->payment_method)}}</span></span> 
                                </div>
                                @if($order->payment_method == 'online')
                                <div class="col-3">
                                    <span> Payment Photo</span>
                                    <img class="payment-online" src="/storage/payment/{{$order->payment_image}}" alt="">
                                </div>
                               @else
                                    <span>No image!</span>
                                @endif
                                <div class="col-4">
                                    <span class="font-weight-bold">Reason: </span> <span class="text-capitalize"> {{$order->reason_name}}</span> 
                                  <br>  <span class="font-weight-bold">Description: </span> <span class="text-capitalize"> {{$order->description}}</span> 
                                  </div>
                            
                            </div>

                            @if($order->return_created_at)
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{route('seller.return.request',[$order->order_id])}}" method="POST" class="my-3">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="response" value="accept">
                                        <input type="submit" value="Accept" class="btn btn-sm btn-primary">
                                    </form>
                                    <form action="{{route('seller.return.request',[$order->order_id])}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="response" value="reject">
                                        <input type="submit" value="Reject" class="btn btn-sm btn-danger">
                                    </form>
                                </div>
                            </div>
                            @endif
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection