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
                                         <a href="/buyer/browse/seller/{{$product->stock_id}}"> 
                                            @if(is_null($product->stock_image))
                                                <img src="/storage/seller/product_type_image/{{$product->product_image}}" alt=""> </a>  
                                            @else
                                                <img src="/storage/stock/{{$product->stock_image}}" alt=""> </a>   
                                            @endif
                                            {{-- <img src="{{ url('/storage/') }}{{ $product->stock_image ? '/stock/'. $product->stock_image : '/seller/product_type_image/default_product_image.jpg'  }}" alt=""> </a> </td> --}}
                                            <h5>{{$product->product_name}}</h5>
                                            <p> &#8369; {{$product->stock_price}}</p>                                                                                                   
                                            <p>{{$product->brgy_name}}</p>
                                             <a href="/buyer/browse/{{$product->product_id}}" class="btn btn-success">Add to Cart</a>
                                           
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script>
  $(document).ready( function () {
    $('select[name="category"]').on('change', function(){
        window.location.href = '/buyer/browse/?category='+ this.value;
    });

    $('select[name="brgy"]').on('change', function(){
     window.location.href = '/buyer/browse/?brgy='+ this.value;
    });
} );
</script>