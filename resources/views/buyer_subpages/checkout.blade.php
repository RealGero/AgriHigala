@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="checkout">
            <div class="row pb-3">
                <div class="col-12">
                    <h2>Cart>Checkout</h2> 

                    @if(Session::has('cart'))
                    <div class="card">
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5 class="card-title"><i class="fas fa-map-marker-alt"> </i> Delivery Address</h5>             
                                </div>
                            </div>
                           
                     
                            @csrf
                            <div class="row d-flex justify-content-center">
                                <div class="col-2">
                                {{ucfirst($user->f_name)}} {{ucfirst($user->l_name)}}
                                </div>

                                <div class="col-2">
                                    {{ucfirst($user->brgy_name)}}
                                </div>
                                <div class="col-2">
                                    {{ucfirst($user->address)}}
                                </div>
                                
                                <div class="col-2">
                                    {{$user->mobile_number}} 
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update-profile-checkout">
                                       Change
                                </button>
                                </div>                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Products Ordered</h5>
                            <div class="row">
                                <div class="col-4">
                                    <i class="fa fa-store"></i>
                                    Seller: {{\App\Seller::getSellerName($seller)}}
                                    <i class="far fa-comment"></i>
                                    Chat Now
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Unit</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                             $total = 0;
                                            @endphp
                                            @foreach ($carts as $cart)
                                               
                                            {{-- {{dd($cart->items)}} --}}
                                         
                                            
                                             @if($seller == $cart['item']->seller_id)

                                             @php 
                                                $sub_total = $cart['price'] * $cart['qty'];
                                                $total += $sub_total;
                                                // return print_r($total);
                                             @endphp
                                            <tr>
                                                <td><img src="{{ $cart['item']->stock_image ? '/storage/stock/'. $cart['item']->stock_image : '/storage/seller/product_type_image/default_product_image.jpg'  }}" alt=""> </td>
                                                <td>{{$cart['item']->product_name}}</td>
                                                <td>&#8369;{{number_format($cart['price'])}}</td>
                                                <td> {{$cart['item']->unit_name}}</td>
                                                <td>{{$cart['qty']}}</td>
                                            <td>&#8369;{{number_format($sub_total)}}</td> 

                                            </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <ul> 
                                        <h5 class="pb-3">  Payment Method </h5>
                                        <li class="pb-2"><span class="font-weight-bold mb-5">Subtotal:</span></li>
                                        <li class="pb-2"><span class="font-weight-bold">Shipping total:</span></li>
                                        <li class="pb-2"><span class="font-weight-bold">Total Payment:  &#8369;{{number_format($total)}}</span></li>
                                        <li class="d-none" id="gcash"> <span class="font-weight-bold" >G-Cash Number:</span>  <input type="text" class="rounded" min="11"></li>
                                    </ul>
                                </div>
                                <form action="{{action('OrdersController@clickedPlaceOrder',[$seller])}}" method="POST" enctype="multipart/form-data"> 
                                    @csrf
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="CashOnDelivery" value="1" checked>
                                        <label class="form-check-label" for="CashOnDelivery">
                                          Cash on delivery
                                        </label>
                                      </div>
                           
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="payment-online" value="2" >
                                        <label class="form-check-label" for="payment-online">
                                         Payment Online
                    
                                        </label>
                                      </div>
                                    <div class="row">
                                        <div class="col-12">
                                             <button type="submit"  class="btn btn-primary btn-sm checkout-btn ">Place order</button> 
                                        </div>
                                    </div>
                                </form>
                                </div>
                           
                          @else
                             <div class="row">
                                 <div class="col-8 mx-auto ">
                                     <div class="mt-2 d-flex justify-content-center">
                                        <h5 class="text-danger"> You dont have a Product!</h5>
                                     </div>
                                    {{-- <div class="card">
                                        <div class="card-body"> --}}
                                            
                                        {{-- </div>
                                    </div> --}}
                                 </div>
                             </div>
                           @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
@include('modals.modals')

@endsection


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function () {
    $('#gcash-btn').click(function(e){
        e.preventDefault();


        $('#gcash').removeClass('d-none');
        // console.log('hello');
    });

    $('#cod-btn').click(function(e){
        e.preventDefault();

        $('#gcash').addClass('d-none');

    });

    

});
</script>