@extends('layouts.rider')


@section('content')
<div class="container">
    <div class="seller-viewmore">
        <div class="row">

            <div class="col-10 mx-auto">
                <a href="{{route('rider.dashboard')}}" class="btn btn-primary mb-2">Back</a>
              <div class="card">
                  <div class="card-body">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>

                            </tr>
                            </thead>
                            <tbody>
                                @foreach($orderLine as $orderLines)
                            
                                @php
                                    $price = \App\Price::getLatestPrice($orderLines->stock_id);
                                @endphp

                            <tr>
                                <td> <img src="{{ url('/storage/') }}{{ $orderLines->stock_image ? '/stock/'. $orderLines->stock_image : '/seller/product_type_image/default_product_image.jpg'  }}" alt=""> </td>
                                <td>  {{$orderLines->product_name}}  
                                <td>Quantity: {{$orderLines->order_qty}}</td>
                                <td>&#8369;{{number_format($price->stock_price)}}/{{ucfirst($price->unit_description)}}</td>
                                <td>&#8369;{{number_format($price->stock_price * $orderLines->order_qty) }}</td>
                                <td>
                                    @if($order->accepted_at == null && $order->packed_at == null && $order->delivered_at == null && $order->completed_at = null)
                                        <span>Requesting</span>

                                    @elseif($order->accepted_at != null && $order->packed_at == null && $order->delivered_at == null && $order->completed_at == null)

                                    <span>Pending</span>
                                    @elseif($order->accepted_at != null && $order->packed_at != null && $order->delivered_at == null && $order->completed_at == null)
                                        <span>Delivering</span>
                                    @elseif($order->accepted_at != null && $order->packed_at != null && $order->delivered_at != null && $order->completed_at == null)
                                        <span>Delivered</span>
                                    @elseif($order->accepted_at != null && $order->packed_at != null && $order->delivered_at != null && $order->completed_at != null)
                                    <span>Completed</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    <div class="row ">
                        <div class="col-4 d-flex flex-column justify-content-around">
                            <span>Other Fee &#8369;{{number_format($order->fee_other)}}</span>
                            <span>Delivery fee: &#8369;{{number_format($order->fee_delivery)}}</span>
                            <span>Subtotal Fee: &#8369;{{number_format($order->payment_order )}}</span>
                            <span>Total fee: &#8369;{{number_format($order->payment_total) }}</span>
                        </div>
                        <div class="col-6    d-flex flex-column">
                            <span>Organization Name: {{$order->org_name}}</span>
                            <span>Payment method: {{ucfirst($order->payment_method)}}</span>
                        </div>
                        {{-- date('M d Y', strtotime(($order->completed_at)) --}}
                        {{-- \Carbon\Carbon::parse($order->completed_at)->diffForHumans() --}}
                   
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{-- <img src="{{ url('/storage/') }}{{ $orderLines->stock_image ? '/stock/'. $orderLines->stock_image : '/seller/product_type_image/default_product_image.jpg'  }}" alt=""> --}}
                            {{-- <img class="payment-online" src="{{Storage::url('storage/payment/'.$order->payment_image)}}" alt=""> --}}
                            {{-- {{dd($order->payment_image)}} --}}
                            <img class="payment-online" src="/storage/payment/{{$order->payment_image}}" alt="">
                           
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                          <span class="font-weight-bold">Buyer name:</span>    <span class="text-capitalize">{{$order->buyer_fname}} {{$order->buyer_mname[0]}}. {{$order->buyer_lname}}</span>  
                        <br><span class="font-weight-bold">Mobile Number:</span> <span>{{$order->buyer_mobile}}</span>
                        <br><span class="font-weight-bold">Address:</span> <span>{{$order->address}}, {{$order->brgy_name}}</span>
                        </div>

                    </div>
                    <hr>
                    <div class="col-5">
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
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>


@endsection
