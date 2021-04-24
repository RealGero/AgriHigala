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
                                          <td>{{$order->order_id}}</td>
                                          <td><span class="text-capitalize">{{$buyer->f_name}} {{$buyer->l_name}}</span>
                                            <br>
                                            <small>({{$buyer->username}})</small></td>
                                          <td>{{$buyer->brgy_name}}
                                            <br>
                                          <small class="text-capitalize">{{$buyer->address}}</small>  
                                          </td>
                                          <td>  &#8369;{{number_format($order->payment_total)}}</td>
                                          <td>
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
                                                <form action="">
                                                  @csrf
                                                  <input type="submit" name="packed_at" value="Packed_at" class="m-2 btn btn-primary btn-sm d-block">
                                                  <select class="form-control">
                                                    <option disabled selected>--- Select Rider ---</option>
                                                    @if($riders)
                                                      @foreach ($riders as $rider)
                                                      <option value="{{$rider->rider_id}}">{{$rider->f_name}} {{$rider->l_name}}</option>
                                                      @endforeach
                                                   @endif
                                                  </select>
                                                </form>
                                              @endif
                                          </td>
                                        </tr>
                                        {{-- <tr>
                                          <td>Mark</td>
                                          <td>Otto</td>
                                          <td>@mdo</td>
                                          <td>@mdo</td>
                                          <td><select class="form-control form-control-sm">
                                              <option>Delivery Otion</option>
                                              <option>By seller</option>
                                              <option>By System</option>
                                            </select>
                                              <a class="btn btn-primary btn-sm d-block" href="#" role="button">Deliver now</a>
                                          </td>
                                        </tr> --}}
                                        {{-- <tr>
                                          <td>Mark</td>
                                          <td>Otto</td>
                                          <td>@mdo</td>
                                          <td>@mdo</td>
                                          <td> <i class="fas fa-check text-primary"> </i> <span class="text-primary"> Shipped</span> 
                                          </td>
                                        </tr> --}}
                                      </tbody>
                                     @endforeach 
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