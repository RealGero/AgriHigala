@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="myorders-order">
            @if(session()->has('success'))
                <div class="alert alert-success">
                  {{ session()->get('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-2 container-fluid">
                     @include('include.leftside_buyer')
                </div>
                <div class="col-9 mx-auto">
                    <span class="h3">Orders</span>
                    <div class="row mt-4 d-flex ">
                        <div class="col-12">
                            <ul class=" d-flex flex-row remove-pad-ul">
                                <li> <a href="{{route('buyer.order')}}">All&nbsp; &nbsp;|</a> </li>
                                <li> <a href="{{route('buyer.order',[1])}}">Request &nbsp; &nbsp;|</a> </li>
                                <li> <a href="{{route('buyer.order',[2])}}">Pending &nbsp; &nbsp;|</a> </li>
                                <li> <a href="{{route('buyer.order',[3])}}">Delivery &nbsp; &nbsp;|</a> </li>
                                <li> <a href="{{route('buyer.order',[4])}}">Recieved</a> </li>
                            </ul>
                        </div>
                    </div> 
                    {{-- {{dd($orders)}} --}}
                    @foreach($orders as $order)
                    
                    @php
                    $orderLines = \App\OrderLine::getOrderLines($order->order_id);    
                    
                    
                    if(empty($order->accepted_at))
                    {
                        $order_status = 'Request';
                        $badge = 'badge-warning';
                    }elseif($order->accepted_at != null && $order->packed_at == null )
                    {
                        $order_status = 'Pending';
                        $badge = 'badge-primary';
    
                    }elseif($order->packed_at != null && $order->delivered_at == null)
                    {
                        $order_status = 'Delevering';
                        $badge = 'badge-primary';
    
                    }elseif($order->delivered_at != null && $order->completed == null)
                    {
                        $order_status = 'Received';
                        $badge = 'badge-info';
                    }
    
                     @endphp    
                    <div class="card my-3">
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
                                           <td > <span class="badge badge-pill {{$badge}}"> {{$order_status}}</span></td>
                                            <td>Placed On 
                                                {{date('M d Y', strtotime($order->created_at))}}
                                            </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href={{url('/buyer/order/vieworder/'.$order->order_id)}}>View more..</a>
                                            
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