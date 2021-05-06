@extends('layouts.rider')


@section('content')
<div class="container">
    <div class="seller-viewmore">
        <div class="row">

            <div class="col-10 mx-auto">
                <a href="{{route('rider.dashboard')}}" class="btn btn-primary mb-2">Back</a>
               
                @foreach($orders as $order)
                            
                @php
                    // $price = \App\Price::getLatestPrice($orderLines->stock_id);
                    $orderLines = \App\OrderLine::getOrderLines($order->order_id);    
                @endphp
              <div class="card mb-3">
               
                     <div class="card-body">
                        <div class="row border-bottom">
                            <div class="col-6 d-flex flex-column">
                                <span class="h5">Order {{$order->order_id}}</span>  
                                {{-- <span class="h5">Order#</span>   --}}
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <span>Total : &#8369;{{number_format($order->payment_total)}}</span>  
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            {{-- <th>Items</th> --}}
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr> 
                                            {{-- <td><img src="{{ url('/storage/') }}{{ $orderLines['items']->stock_image ? '/stock/'. $orderLines['items']->stock_image : '/seller/product_type_image/default_product_image.jpg'  }}" alt=""></td> --}}

                                        <td> 
                                            <ul  class="list-unstyled">
                                                @foreach($orderLines->orderLine as $productItem)
                                                    <li>{{$productItem->product_name}} x {{$productItem->order_qty}}</li>
                                                @endforeach
                                            </ul>
                                        </td> 
                                        <td> Quantity {{$orderLines->quantity}}</td>
                                        <td >
                                            @if($order->completed_at)
                                                
                                                @if($order->return_denied_at != null)
                                                    <span class="badge badge-pill badge-danger">Rejected</span>
                                                @else
                                                    <span class="badge badge-pill badge-success">Complete</span>
                                                @endif
                                        @else
                                            @if($order->return_created_at)
                                                @if($order->return_accepted_at == null)
                                                   <span class="badge badge-pill badge-secondary">Return requesting</span>
                                                @elseif($order->return_accepted_at != null)
                                                <form action="{{route('rider.deliveredAt',[$order->order_id])}}" method="POST">
                                                    @method('PUT')
                                                    <input type="hidden" name="response" value="delivered">
                                                    <input type="submit" value="Delivered" class="btn btn-sm btn-primary">
                                                </form>
                                                @endif 
                                            
                                            @else
                                                @if($order->order_accepted_at == null)
                                                @elseif($order->packed_at != null && $order->delivered_at == null)
                                                <form action="{{route('rider.deliveredAt',[$order->order_id])}}" method="POST">
                                                    @method('PUT')
                                                    <input type="hidden" name="response" value="delivered">
                                                    <input type="submit" value="Delivered" class="btn btn-sm btn-primary">
                                                </form>
                                                @elseif($order->delivered_at != null)
                                                    <span class="badge badge-pill badge-success">Delivered</span>
                                                @endif
                                            @endif
                                     @endif 
                                        <td>Placed On 
                                            {{date('M d Y', strtotime($order->created_at))}}
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>
                
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <a href={{route('rider.viewmore',[$order->order_id])}}>View more..</a>

                                    </div>
                                </div>         
                               
                            </div>
                        </div>
                        
                    </div>
              </div>
              @endforeach
            </div>
        </div>
    </div>
</div>


@endsection
{{-- @if($order->accepted_at == null && $order->packed_at == null && $order->delivered_at == null && $order->completed_at = null)
<span>Requesting</span>

@elseif($order->accepted_at != null && $order->packed_at == null && $order->delivered_at == null && $order->completed_at == null)

<span>Pending</span>
@elseif($order->accepted_at != null && $order->packed_at != null && $order->delivered_at == null && $order->completed_at == null)
<span>Delivering</span>
@elseif($order->accepted_at != null && $order->packed_at != null && $order->delivered_at != null && $order->completed_at == null)
<span>Delivered</span>
@elseif($order->accepted_at != null && $order->packed_at != null && $order->delivered_at != null && $order->completed_at != null)
<span>Completed</span>
@endif --}}


{{-- 
@if($order->delivered_at)
                    
<span>Already received by buyer</span>
@else
<form action="{{route('rider.deliveredAt',[$order->order_id])}}" method="POST">
    @method('PUT')
    <input type="hidden" name="response" value="delivered">
    <input type="submit" value="Delivered" class="btn btn-sm btn-primary">
</form>
@endif --}}