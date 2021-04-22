@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="viewmore">
            <div class="row">
                <div class="col-12 mx-auto">
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                     @endif
                    <div class="card">
                        <div class="card-body">
                            @foreach ($orderLine as $orderLines) 
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
                                              <tr>
                                                <td> <img src="{{ url('/storage/') }}{{ $orderLines->stock_image ? '/stock/'. $orderLines->stock_image : '/seller/product_type_image/default_product_image.jpg'  }}" alt=""></td>
                                                <td>  {{$orderLines->product_name}}  
                                                
                                                <td>Quantity: {{$orderLines->order_qty}}</td>
                                                <td>&#8369;{{number_format($orderLines->stock_price)}}/{{ucfirst($orderLines->unit_description)}}</td>
                                                <td>&#8369;{{number_format($orderLines->stock_price * $orderLines->order_qty) }}</td>
                                              </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="row ">
                                <div class="col-3 d-flex flex-column justify-content-around">
                                    
                                    <span>Other Fee &#8369;{{number_format($order->fee_other)}}</span>
                                    <span>Delivery fee: &#8369;{{number_format($order->fee_delivery)}}</span>
                                    <span>Subtotal Fee: &#8369;{{number_format($order->payment_order )}}</span>
                                    <span>Total fee: &#8369;{{number_format($order->payment_total) }}</span>
                                </div>
                                <div class="col-3 d-flex flex-column">
                                    <span>Organization Name: {{$order->org_name}}</span>
                                    <span>Payment method: {{ucfirst($order->payment_method)}}</span>
                                </div>
                                @if($order->payment_method == 'online')
                                <div class="col-3">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#online-img">
                                        Upload Photo
                                    </button>
                                </div>
                                @endif
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    @include('modals.modal-online')
@endsection