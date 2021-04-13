@extends('layouts.app')

@section('content')
    

    <div class="container ">
        <div class="cart ">
            <div class="row">
                <div class="col-8 mx-auto">
                    <h2>Cart</h2>
                    <div class="card" style="">
                        <div class="card-body">
                            <table class="table table-borderless">
                                <thead>
                                  <tr>
                                    {{-- <th scope="col"></th> --}}
                                    {{-- <th scope="col"></th> --}}
                                    <th scope="col">Name</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    {{-- <th scope="col">Total price</th> --}}
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                
                                  {{-- @if(Cart::count()>0) --}}

                                  {{-- <h2>{{Cart::count()}} item(s) in your cart </h2> --}}
                                  @if(Session::has('cart'))
                                  @foreach($products as $product )
                                  <tr>
          
                                    {{-- <td> --}}
                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> 
                                      </div> --}}
                                     
                                    {{-- </td> --}}
                                    {{-- <td>  <img src="{{ url('/storage/') }}{{ $products->stock_image ? '/stock/'. $products->stock_image : '/seller/product_type_image/default_product_image.jpg'  }}" alt=""> </td> --}}
                                   
                                    <td>{{$product['item']->product_name }}</td>
                                    <td> {{$product['item']->unit_name}}</td>
                                    <td> &#8369;{{number_format($product['price'])}}</td>
                                      
                                    <td> 
                                      <div>
                                        <button>+</button>
                                        {{-- <span class="badge">{{$product['qty']}}</span> --}}
                                         <input type="text" name="quality" value="{{$product['qty']}}">
                                        <button>-</button>
                                      </div> 
                                    </td>
                                  
                                    <td>
                                        <a href="/buyer/deleteCart/{{$product['item']->product_id}}" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                  </tr>
                                  @endforeach
                                  <div class="row mr-5">
                                    <div class="col-12 ">
                                      <h4 class="text-right"><span class="h5">Grand Total:</span>  &#8369;{{number_format($totalPrice)}}</h4>
                                    </div>
                                  </div>
                                  @else
                                    <div class="row">
                                      <div class="col-12">
                                        <h2> No items in Cart!</h2>
                                      </div>
                                    </div>
                                  @endif
                                 
                                </tbody>
                                
                              </table>
                              
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 d-flex justify-content-end mt-4">
                   <a href="" class="btn btn-primary">Place order</button></a>
                </div>
            </div>
        </div>


    </div>
@endsection