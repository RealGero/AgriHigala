@extends('layouts.rider')

@section('content')
        <div class="container">
            <div class="rider-viewmore">
                <div class="row">
                    <div class="col-12 mx-auto">
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                         @endif
                         <div class="row mb-3">
                            <div class="col">
                                <a href="{{route('rider.order.index')}}" class="btn btn-primary"> Back</a>
                            </div>
                        </div>
                       
                        <div class="card">
                            <div class="card-body">
                                @foreach ($orderLines as $orderLine)  
                                    @php
                                        $price = \App\Price::getLatestPrice($orderLine->stock_id);
                                    @endphp
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
                                                            <td> <img src="{{ url('/storage/') }}{{ $orderLine->stock_image ? '/stock/'. $orderLine->stock_image : '/seller/product_type_image/default_product_image.jpg'  }}" alt=""></td>
                                                            <td>  {{$orderLine->product_name}}  
                                                            
                                                            <td>Quantity: {{$orderLine->order_qty}}</td>
                                                            <td>&#8369;{{number_format($price->stock_price)}}/{{ucfirst($price->unit_description)}}</td>
                                                            <td>&#8369;{{number_format($price->stock_price * $orderLine->order_qty) }}</td>
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
                                    
                                    <div class="col-3">
                                        <span class="font-weight-bold">Buyer name:</span> <span class="text-capitalize">{{$order->f_name}} {{$order->f_name[0]}}. {{$order->f_name}}</span>
                                    <br>    <span class="font-weight-bold">Mobile number:</span> <span class="text-capitalize">{{$order->mobile_number}}</span>
                                    <br>    <span class="font-weight-bold">Address:</span> <span class="text-capitalize">{{$order->address}},{{$order->brgy_name}}</span>
                                    </div>
                                 </div> 
                              
                                
                             
                            </div>
                        {{-- <div class="row mt-3">
                            <div class="col">
                                                                       
                               @if($order->delivered_at)
                                                   
                               <span>Already received by buyer</span>
                               @else
                               <form action="{{route('rider.deliveredAt',[$order->order_id])}}" method="POST">
                                   @method('PUT')
                                   <input type="hidden" name="response" value="delivered">
                                   <input type="submit" value="Delivered" class="btn btn-sm btn-primary">
                               </form>
                               @endif
                            </div>
                        </div> --}}
                    </div>

                 </div>
             </div>
         </div>
      </div>
@endsection