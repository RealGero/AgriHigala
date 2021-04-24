@extends('layouts.app')


@section('content')
    
    <div class="container">
        <div class="product-detail d-flex justify-content-center">
            <div class="card" style="width: 40rem;">
                <div class="card-body">
                    <a href="/buyer/browse/" class="btn btn-success mb-3" >Back</a> 
                    <div class="row">
                   
                        <div class="col-12 d-flex justify-content-center mb-3 ">
                            {{-- {{dd($products)}} --}}
                            {{-- {{dd($products)}} --}}
                            @if(is_null($products->stock_image))
                                <img src="/storage/seller/product_type_image/{{$products->product_image}}" alt=""> 
                            @else
                                <img src="/storage/stock/{{$products->stock_image}}" alt="">   
                            @endif
                            {{-- <a href="/buyer/browse/seller/{{$products->stock_id}}">  --}}
                            {{-- <img src="{{ url('/storage/') }}{{ $products->stock_image ? '/stock/'. $products->stock_image : '/seller/product_type_image/default_product_image.jpg'  }}" class="profile-seller-upper" alt=""> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <ul>
                                <li><span class="font-weight-bold">Product Name: {{$products->product_name}}</span> </li>
                                <li><span class="font-weight-bold"> Location: {{$products->brgy_name}}</span></li>
                                <li><span class="font-weight-bold"> Price:  &#8369;{{$products->stock_price}}</span></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul>

                                <li><span class="font-weight-bold"> Stock: {{$products->qty_added}}</span></li>
                                <li><span class="font-weight-bold">Unit Type:  {{$products->unit_name}}</span></li>
                                <li><span class="font-weight-bold">Date Added:</span> {{date('M d Y ', strtotime($products->created_at))}}</li>

                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12  border-bottom d-flex justify-content-center">
                           <a href="/buyer/seller-detail/{{$products->product_id}}" class="btn btn-success mb-3">Add to Cart</a>  
                        </div>
                       
                    </div>
                    {{-- d-flex justify-content-center my-3 --}}
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center my-2">
                            <img src="/storage/user/{{$products->user_image}}" class="rounded-circle my-3 profile-seller-lower" alt="profile-pic">
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-8">
                            Supplier Name: {{ ucfirst($products->f_name). ' ' .ucfirst($products->m_name) .' '.  ucfirst($products->l_name)}} 
                        </div>
                        <div class="col-4 product-detail-btn">
                            <a href="#" class="btn btn-success btn-md">Follow</a>  
                            <a href="/buyer/message/{{$products->seller_id}}" class="btn btn-success btn-md">Chat</a>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">

                          
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection