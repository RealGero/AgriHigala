@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="browse pb-3">
            <div class="row">
                <div class="col-10 mx-auto ">
                    <h3>Recommended</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex">
                                <div class="col-2  d-flex flex-row ">
                                    @foreach($products as $product)
                                        <div class="d-flex flex-column justify-content-center mx-4" >
                                            <img src="{{ url('/storage/') }}{{ $product->stock_image ? '/stock/'. $product->stock_image : '/seller/product_type_image/default_product_image.jpg'  }}" alt=""></td>
                                            <h5>{{$product->product_name}}</h5>
                                            <p> &#8369; {{$product->stock_price}}</p>
                                            <p>Brgy.1</p>
                                            <a class="btn btn-success" href="#" role="button">Add to cart</a>
                                        </div>                        
                                    @endforeach
 
                                </div>
                             </div>
                             <div class="row mt-3">
                                 <div class="col-12 d-flex justify-content-center">
                                    {{$products->links()}}
                                 </div>
                             </div>
                             
                         </div>
                    </div>
            </div>
        </div>
       
    </div>
    @include('browse_view.browse-products')
    @include('browse_view.dropdowns')
@endsection

{{-- browse product --}}
            {{-- <br>
            <h2>Browse Products</h2>
             @include('browse_view.browse-products')
            @include('browse_view.dropdowns') --}}