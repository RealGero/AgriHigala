@extends('layouts.app')

@section('content')
    
<div class="container ">
  <div class="cart ">
      <div class="row">
        <div class="col-10 mx-auto">
          <h2>Cart</h2>
          @if($sellers)
            @foreach($sellers as $seller)

              <div class="card mb-5" style="">
                <div class="card-body">
                  <div class="row">
                    <div class="col-3">
                      {{-- <h4 class="text-capitalize">{{\App\Seller::getSellerName($seller)}}</h4> --}}
                    </div>
                  </div>
                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          {{-- <th scope="col"></th> --}}
                          <th scope="col"></th>
                          <th scope="col">Name</th>
                          <th scope="col">Unit</th>
                          {{-- <th scope="col">Price</th> --}}
                          <th scope="col">Quantity</th>
                          <th scope="col">Remaining stock</th>
                          {{-- <th scope="col">Total price</th> --}}
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                        {{-- @if(Cart::count()>0) --}}
                        @php $total = 0; @endphp
                        {{-- <h2>{{Cart::count()}} item(s) in your cart </h2> --}}
                        @foreach($products as $product )
                          @if($seller == $product['item']->seller_id)
                            {{-- {{dd($product['item']->stock_id)}} --}}
                            @php
                              $sub_total = $product['price'] * $product['qty'];
                              $total += $sub_total;
                               
                            @endphp
                            <tr class="cartpage">
                              {{-- <td> --}}
                                  {{-- <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> 
                                </div> --}}
                              
                              {{-- </td> --}}
                              {{-- <td>  <img src="{{ url('/storage/') }}{{ $products->stock_image ? '/stock/'. $products->stock_image : '/seller/product_type_image/default_product_image.jpg'  }}" alt=""> </td> --}}
                              {{-- {{dd($product['item']->product_image)}} --}}

                              {{-- @if (is_null($product['item'->stock_image]))
                                <img src="/storage/seller/product_type_image/{{$products->product_image}}" alt="">
                              @else
                                <img src="/storage/stock/{{$products->stock_image}}" alt="">  
                              @endif --}}
                                
                              <td><img src="{{ $product['item']->stock_image ? '/storage/stock/'. $product['item']->stock_image : '/storage/seller/product_type_image/default_product_image.jpg'  }}" alt=""> </td>
                              <td>{{$product['item']->product_name }}</td>
                              <td> {{number_format($product['item']->stock_price)}}/{{$product['item']->unit_name}}</td>
                              {{-- <td> &#8369;{{number_format($sub_total)}}</td> --}}
                              <td> 
                                {{-- <div>
                                  <input type="hidden" value="{{$product['item']->product_id}}" class="product_id">
                                  <button class="btn btn-danger" id="" class="changeQuantity subtract" data-cartid = "">-</button>
                                  <span class="badge">{{$product['qty']}}</span> 
                                  <input type="text" class="qty-input" name="quality" value="{{$product['qty']}}" id="qty">
                                  <button class="btn btn-success" id=""  class="changeQuantity add">+</button>
                                  <button type="submit" class="btn btn-primary">Update</button>
                                
                                </div>   --}}
                                
                                <form action="{{route('change_qty', $product['item']->stock_id)}}" class="d-flex">
                                  @if($product['qty'] == 1)
                                    <button type="submit" value="down" name="change_to" class="btn btn-danger" disabled>-</button>
                                  @else
                                    <button type="submit" value="down" name="change_to" class="btn btn-danger ">-</button>
                                  @endif 
                            
                                  {{-- {{dd($product['item']->qty_added)}} --}}
                                  <input type="number" value="{{$product['qty']}}" disabled>

                                  @if($product['qty'] == $product['item']->qty_added)
                                    <button type="submit" value="up" name="change_to" class="btn btn-success" disabled>+</button>
                                  @else
                                    <button type="submit" value="up" name="change_to" class="btn btn-success">+</button>
                                  @endif
                                </form>
                              </td>
                              <td>{{$product['item']->qty_added}}</td>
                              <td><a href="/buyer/deleteCart/{{$product['item']->stock_id}}" class="btn btn-danger btn-sm">Delete</a></td>
                            </tr>
                          @endif
                        @endforeach
                        <div class="row mr-5">
                          <div class="col-6">
                            <h5 class="text-capitalize">Seller: {{\App\Seller::getSellerName($seller)}}</h5>
                          </div>
                          <div class="col-6">
                            <h5 class="text-right"><span>Order Total:</span>  &#8369;{{number_format($total)}}</h5>
                          </div>
                        </div>
                      </tbody>
                    </table>
                    {{-- Checkout --}}
                    <div class="row">
                      <div class="col-md-10 d-flex justify-content-end mt-4">
                        <a href="/checkout/{{$seller}}" class="btn btn-primary">Checkout</a>
                      </div>
                    </div>
                </div>
              </div>  
            @endforeach
          @else
            <div class="row">
              <div class="col-12 mx-auto text-center">
                <div class="card">
                  <div class="card-body">
                    <span class="h4"> No items in Cart!</span>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
     
  </div>
</div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>

<script type="text/javascript">

$(document).ready(function(){

  $('.changeQuantity').click(function(e){
    e.preventDefault();

    var quantity = $(this).closest('.cartpage').find('.qty-input').val();
    var product_id = $(this).closest('.cartpage').find('.product_id').val();

    var data = {

      '_token': $('input[name = _token]').val(),
      'quantity':quantity,
      'product_id':product_id,
    };

    // $.ajax({
    //   url:'/cart',
    //   type:'POST',
    //   data:data;
    //   success: function(response(){

    //     window.location.reload();
    //     alertify.set('notifier','position','top-right');
    //     alerttify.success('response.status');
    //   });
    // });

  });



});







</script>