@extends('layouts.rider')


@section('content')
    <div class="container">
        <div class="order-detail">
            <div class="row">
                <div class="col-10 mx-auto">
                    <span class="h3">Orders>My order</span>
                    @forelse($orders as $order)
                    @php
                     $orderLine  = \App\Rider::orderLines($order->order_id)  
                    @endphp
                    <div class="card">
                        <div class="card-body">
                            <div class="row m-3">
                                <div class="col-7">      
                                   <div><span class="font-weight-bold"> Order ID: </span><span> {{$order->order_id}}</span> </div> 
                                   <div><span class="font-weight-bold">Customer Name: </span><span class="text-capitalize"> {{$order->f_name}} {{$order->f_name[0]}}. {{$order->f_name}}</span> </div>
                                   <div><span class="font-weight-bold">Address: </span><span>{{$order->brgy_name}}, {{$order->address}}</span> </div> 
                                   <div><span class="font-weight-bold">Mobile Number: </span> <span>{{$order->mobile_number}}</span> </div>  
                                </div>
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
                            <div class="row mt-5 mx-3">
                                <div class="col-12">
                                    <h5 class="card-title font-weight-bold">Products:</h5>
                                </div>
                            </div>
                            <div class="row mx-3">
                                <div class="col-12">
                                    <table class="table table-borderless">
                                        <thead>
                                          <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Product name</th>
                                            <th scope="col">Unit price</th>
                                            {{-- <th scope="col">Unit type</th> --}}
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total price</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderLine as $item)
                                          <tr>
                                            <td><img src="{{ url('/storage/') }}{{ $item->stock_image ? '/stock/'. $item->stock_image : '/seller/product_type_image/default_product_image.jpg'  }}" alt=""></td>
                                            <td>{{$item->product_name}}</td>
                                            <td>&#8369;{{number_format($item->stock_price)}}/{{$item->unit_name}}</td>
                                            {{-- <td></td> --}}
                                            <td>{{$item->order_qty}}</td>
                                            <td>&#8369;{{number_format($item->order_qty * $item->stock_price)}}</td>
                                          </tr>
                                          @endforeach
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                            <div class="row mr-5 ">
                                <div class="col-12 ">
                                    <span class="font-weight-bold">Additional Fee:</span> <span>&#8369;{{number_format($order->fee_other)}} </span>
                                   <br> <span class="font-weight-bold">Shipping Fee:</span> <span>&#8369;{{number_format($order->fee_delivery)}} </span>
                                   <br> <span class="font-weight-bold">Sub Total: </span><span>&#8369;{{number_format($order->payment_order)}}  </span>
                                   <br> <span class="font-weight-bold">Total: </span><span>&#8369;{{number_format($order->payment_total)}}</span> 
                                </div>
                            </div>
                       
                    </div>
                    @empty
                        <div>You don't have an Order</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
