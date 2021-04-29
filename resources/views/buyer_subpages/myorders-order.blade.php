@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="myorders-order">
            @if(session()->has('success'))
                <div class="alert alert-success">
                  {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('thanks'))
                <div class="alert alert-success">
                  {{ session()->get('thanks') }}
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
                                <li> <a href="{{route('buyer.order',[4])}}">Recieved &nbsp; &nbsp;| </a> </li>
                                <li> <a href="{{route('buyer.order',[5])}}">Completed &nbsp; &nbsp;|</a> </li>
                                <li> <a href="{{route('buyer.order',[6])}}">Returned  </a> </li>
                            </ul>
                        </div>
                    </div> 
                    {{-- {{dd($orders)}} --}}
                   
                    @foreach($orders as $order)
                    
                    @php
                    $orderLines = \App\OrderLine::getOrderLines($order->order_id);    
                    $reasons = App\Reason::all();
                    
                    // if(empty($order->accepted_at))
                    // {
                    //     $order_status = 'Request';
                    //     $status_btn = 'badge-warning';
                    // }elseif($order->accepted_at != null && $order->packed_at == null )
                    // {
                    //     $order_status = 'Pending';
                    //     $status_btn = 'badge-primary';
    
                    // }elseif($order->packed_at != null && $order->delivered_at == null)
                    // {
                    //     $order_status = 'Delevering';
                    //     $status_btn = 'badge-primary';
    
                    // }elseif($order->delivered_at != null && $order->completed_at == null)
                    // {
                    //     $order_status = 'Received';
                    //     $status_btn = 'badge-info';
                    // }elseif($order->delivered_at != null && $order->completed_at != null)
                    // {
                    //     $order_status = 'Completed';
                    //     $status_btn = 'badge-success';
                    // }
                    
    if ($order->completed_at) {
        // SET STATUS FOR COMPLETE
        if ($order->order_accepted_at == null) {
          $status = 'Rejected/Cancelled';
          $status_btn = 'badge-danger';
        } elseif ($order->order_accepted_at != null && $order->packed_at == null) {
          $status = 'Cancelled';
          $status_btn = 'badge-danger';
        } elseif ($order->return_denied_at != null) {
          $status = 'Rejected';
          $status_btn = 'badge-danger';
        } else{
          $status = 'Complete';
          $status_btn = 'badge-success';
        }
      } else {
        if ($order->return_created_at){
          // SET STATUS FOR RETURN ORDER
          if($order->return_accepted_at == null ){
            $return_btn = true;
            $return_disable = '';
            $status = 'Requesting';
            $status_btn = 'badge-secondary';
          }elseif($order->return_accepted_at != null ){
            $return_pending_btn = true;
            $return_pending_disable = '';
            $status = 'Pending';
            $status_btn = 'badge-warning';
          }
        }else {
          // SET STATUS FOR ORDER
          if($order->order_accepted_at == null){
            $request_btn = true;
            $request_disable = '';
            $status = 'Requesting';
            $status_btn = 'badge-secondary';
          }
          elseif($order->order_accepted_at != null && $order->packed_at == null){
            $pending_btn = true;
            $pending_disable = '';
            $status = 'Pending';
            $status_btn = 'badge-warning';
          }
          elseif($order->packed_at != null && $order->delivered_at == null){
            $delivering_btn = true;
            $delivering_disable = '';
            $status = 'Delivering';
            $status_btn = 'badge-info';
          }
          elseif($order->delivered_at != null){
            $delivered_btn = true;
            $delivered_disable = '';
            $status = 'Delivered';
            $status_btn = 'badge-success';
          }
        }
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
                                        <td > @if ($order->return_id)
                                            <span class="badge badge-pill badge-info">Return</span>  
                                        @endif 
                                        <span class="badge badge-pill {{$status_btn}}"> {{$status}}</span></td>
                                        <td>Placed On 
                                            {{date('M d Y', strtotime($order->created_at))}}
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        @if($order->packed_at == null && $order->completed_at == null)
                                                <form action="{{route('buyer.order.cancel',[$order->order_id])}}" method="POST">
                                                    @method('PUT')

                                                    <input type="hidden" name="response" value="cancel">
                                                    <input type="submit" value="Cancel Order" class="btn btn-sm btn-primary">
                                                </form>
                                            @elseif($order->packed_at == null && $order->completed_at != null)
                                                 <span class="text-danger">Canceled Order</span>
                                    
                                            @elseif($order->delivered_at != null && $order->completed_at == null)
                                             <div class="form-group mb-3">
                                              
                                                <form action="{{route('buyer.order.received',[$order->order_id])}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="response" value="received">
                                                    <input type="submit" value="Received" class="btn btn-sm btn-primary">
                                                </form>
                                               
                                            </div>
                                            <hr>   
                                    </div>   
                                </div>
                                <div class="row">
                                    <div class="col-6 mx-auto">
                                        <form action="{{action('OrdersController@buyerOrderReturnStore',[$order->order_id])}}" method="POST">
                                            <label for="exampleFormControlSelect1" class="h5">Reason for return</label>
                                            <select class="form-control text-capitalize" id="exampleFormControlSelect1" name="reason" required>
                                                @foreach($reasons as $reason)
                                                    <option hidden>Select reason</option>
                                                    <option class="text-capitalize" value="{{$reason->reason_id}}" >{{$reason->reason_name}}</option>
                                                @endforeach
                                            </select>
                                                <label for="description" class="h5 mt-3">Description:</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required></textarea>
                                                
                                                <input type="hidden" name="order" value="{{$order->order_id}}">
                                                <input type="hidden" name="response" value="return">
                                                <input type="submit" value="Return" class="btn btn-sm btn-primary mt-2">
                                        </form>
                                    </div>                    
                                </div>
             
                                @endif 
                                <div class="row mt-3">
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
 {{-- <div class="row">
                                    <div class="col-12">
                                        <a href={{url('/buyer/order/vieworder/'.$order->order_id)}}>View more..</a>
                                        
                                    </div>
                                </div> --}}