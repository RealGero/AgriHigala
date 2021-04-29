@extends('layouts.seller');

@section('content')

    <div class="container">
        <div class="myorder">
            <div class="row">
                <div class="col-10 mx-auto">
                    <span class="h3 m-2">Orders> My order</span>
                    <div class="card mt-3">
                        <div class="card-body">
                           <div class="row mt-3">
                               <div class="col-12">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Buyer</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Mobile #</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Status</th>
                                      </tr>
                                    </thead>

                                    @foreach($orders as $order) 
                                 
                                    @php
                                       $buyer = \App\Order::getBuyerWaddress($order->buyer_id);
                                       $riders = \App\Order::getRiders($order->seller_id);
    

                                    @endphp
                                      <tbody>
                                        <tr>
                                          <td>
                                            {{$order->order_id}} <br>
                                           <a href="{{route('sellerViewMore',[$order->order_id])}}"><small class="font-italic">View More</small> </a>

                                          </td>
                                          <td><span class="text-capitalize">{{$buyer->f_name}} {{$buyer->l_name}}</span>
                                            <br>
                                            <small>({{$buyer->username}})</small></td>
                                          <td>{{$buyer->brgy_name}}
                                            <br>
                                          <small class="text-capitalize">{{$buyer->address}}</small>  
                                          </td>
                                          <td> {{$buyer->mobile_number}} </td>
                                          <td>  &#8369;{{number_format($order->payment_total)}}</td>
                                          <td>
                                           
                                                  {{-- Reject/Cancelled --}}
                                                 @if($order->completed_at)
                                                      @if($order->order_accepted_at == null)
                                                          <span class="badge badge-pill badge-danger">Rejected/Cancelled</span>
                                                      {{-- Cancelled --}}
                                                     @elseif($order->order_accepted_at != null && $order->packed_at == null)  
                                                        <span class="badge badge-pill badge-danger">Cancelled</span>
                                                     @elseif($order->return_denied_at != null)
                                                        <span class="badge badge-pill badge-danger">Rejected</span>
                                                     @else
                                                        <span class="badge badge-pill badge-success">Complete</span>
                                                     @endif
                                                 @else
                                                      @if($order->return_created_at)
                                                          @if($order->return_accepted_at == null)
                                                             <span class="badge badge-pill badge-secondary">Requesting</span>
                                                          @elseif($order->return_accepted_at != null)
                                                            <span class="badge badge-pill badge-warning">Pending</span>
                                                         @endif
                                                      @else
                                                          @if($order->order_accepted_at == null)
                                            
                                                              <form action="{{route('orderRequestwithId',[$order->order_id])}}">
                                                                  @csrf
                                                                  @method('PUT')
                                                                  <input type="hidden" name="response" value="accept">
                                                                  <input type="submit" value="Accept" name="accept" id="" class="btn btn-success btn-sm d-block"> 
                                                              </form>
                                                              <form action="{{route('orderRequestwithId',[$order->order_id])}}">
                                                                  @csrf
                                                                  @method('PUT')
                                                                  <input type="hidden" name="response" value="decline">
                                                                  <input type="submit" name="decline" value="Decline" id="" class="btn btn-danger btn-sm d-block"> 
                                                              </form>
                                                          @elseif($order->order_accepted_at != null && $order->packed_at == null)
                                                              <form action="{{route('orderPacked',[$order->order_id])}}">
                                                                @csrf
                                                                @method('PUT')
                                                                <select class="form-control" name="rider" required>
                                                                  <option disabled selected><small> Select Rider</small></option>
                                                                    @if($riders)
                                                                      @foreach ($riders as $rider)
                                                                  <option value="{{$rider->rider_id}}">{{$rider->f_name}} {{$rider->l_name}}</option>
                                                                      @endforeach
                                                                  <input type="hidden" name="response" value="packed">
                                                                  <input type="submit" name="packed_at" value="Packed_at" class="m-2 btn btn-primary btn-sm d-block">
                                                                    @endif
                                                                </select>
                                                              </form>
                                                          @elseif($order->packed_at != null && $order->delivered_at == null)
                                                           <span class="badge badge-pill badge-info">Delivering</span>
                                                          @elseif($order->delivered_at != null)
                                                          <span class="badge badge-pill badge-success">Delivered</span>
                                                          @endif
                                                      @endif
                                               @endif 
                                          </td>
                                        </tr>
                                        @endforeach 
                                      </tbody>
                                  </table>      
                               </div>   
                           </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- @if($order->order_accepted_at == null)
<form action="{{route('orderRequestwithId',[$order->order_id])}}">
    @csrf
    @method('PUT')
    <input type="hidden" name="response" value="accept">
    <input type="submit" value="Accept" name="accept" id="" class="btn btn-success btn-sm d-block"> 
</form>

<form action="{{route('orderRequestwithId',[$order->order_id])}}">
    @csrf
    @method('PUT')
    <input type="hidden" name="response" value="decline">
    <input type="submit" name="decline" value="Decline" id="" class="btn btn-danger btn-sm d-block"> 
 </form>
@elseif($order->order_accepted_at != null && $order->packed_at == null)
  <form action="{{route('orderPacked',[$order->order_id])}}">
    @csrf
    @method('PUT')
    <select class="form-control" name="rider" required>
      <option disabled selected><small> Select Rider</small></option>
      @if($riders)
        @foreach ($riders as $rider)
        <option value="{{$rider->rider_id}}">{{$rider->f_name}} {{$rider->l_name}}</option>
        @endforeach
      <input type="hidden" name="response" value="packed">
      <input type="submit" name="packed_at" value="Packed_at" class="m-2 btn btn-primary btn-sm d-block">
        @endif
    </select>
  </form> --}}