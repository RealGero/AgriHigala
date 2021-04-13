@extends('layouts.seller')

@section('content')
    <div class="container">
        <div class="addnewproduct">
           <div class="row">
               <div class="col-8 mx-auto">
                   <span class="h3">Products>Add new products</span>
                   @if(session()->has('success'))
                     <div class="alert alert-success">
                         {{ session()->get('success') }}
                    </div>
                    @endif
                   <div class="card">
                       <form method="POST" action="{{action( 'sellercontroller\ProductsController@storeNewProduct')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$products ? $products->product_id : ''}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <a class="btn btn-primary" href="#" role="button">Back</a>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-6">

                                    <div class="form-group">
                                        <select class="form-control" id="product_type" name="product_type">
                                            <option hidden>Category</option>
                                            @if($products)
                                             @foreach($productTypes as $productType)
                                                <option value="{{$productType->product_type_id}}" {{ $productType->product_type_id == $products->product_type_id ? "selected" : "" }}>{{ucfirst($productType->product_type_name)}}</option>
                                             @endforeach 
                                            @else
                                                @foreach($productTypes as $productType)
                                                    <option class="text-capitalize" value="{{$productType->product_type_id}}"> {{ ucfirst($productType->product_type_name)}}</option>
                                                @endforeach
                                            @endif
                                      
                                         
                                        </select>
                                      </div>
                                </div>
                                <div class="col-6" id="product_name_id">
                                    <div class="form-group product-name">
                                        <select class="form-control formselect required" id="product_name" placeholder="Product Name"  name="product_name" >
                                            <option hidden>Product Name</option>
                                            @if($products)
                                           
                                                @foreach($products as $product)
                                                    <option value="{{$products->product_id}}" {{ $products->product_id ? "selected" : "" }}>{{ucfirst($products->product_name)}}</option> 
                                                @endforeach
                                            @endif
                                        </select>
                                      </div>
                                </div>
                            </div>
                           
                            <div class="row mt-3">
                                <div class="col-6">
                                    @if($products)
                                    <input type="text" class="form-control" placeholder="Price" name="price" id="price" required value="{{$products->stock_price}}">
                                    @else
                                    <input type="text" class="form-control" placeholder="Price" name="price" id="price" required >
                                    @endif
                                   
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="srp" placeholder="SRP" readonly>
                                </div>
                            </div>
                            <div class="row  mt-3">
                                <div class="col-6">
                                    <div class="form-group">
                                        <select class="form-control" id="exampleFormControlSelect1" name="unit">
                                          <option hidden>Unit</option>
                                         @if($products)
                                            @foreach($units as $unit)
                                                <option value="{{$unit->unit_id}}" {{ $unit->unit_id == $products->unit_id ? "selected" : "" }}>{{ucfirst($unit->unit_name)}}</option>
                                            @endforeach
                                         @else
                                            @foreach($units as $unit)
                                                <option value="{{$unit->unit_id}}">{{ucfirst($unit->unit_name)}}</option>
                                            @endforeach
                                        @endif
                                        </select>
                                      </div>

                                </div>
                             
                                <div class="col-6 d-flex flex-row align-items-center">
                                    <label for="stock" class="mr-2">Stock:</label>

                                   @if($products)
                                        <input type="number" min="1" id="stock" class="form-control" min="1" value="{{$products->qty_added}}" name="stock" >

                                    @else
                                          <input type="number" min="1" id="stock" class="form-control" min="1" value="" name="stock" >
                          
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3">
                                {{-- <div class="col-6">
                                    <select class="form-control" id="exampleFormControlSelect1" name="brgy">
                                        <option hidden>Barangay</option>
                                       @foreach($brgy as $brgys)
                                          <option value="{{$brgys->brgy_id}}">{{ucfirst($brgys->brgy_name)}}</option>
                                       @endforeach
                                      </select>
                                </div> --}}
                              
                                <div class="col-6 d-flex flex-row align-items-center">
                                    <label for="expiration">Expiration Date:</label>
                                    @if ($products)
                                     <input type="date" class="form-control" id="expiration" name="expiration" placeholder="expiration date" value="{{$products->expiration_date}}">
                                    @else
                                    <input type="date" class="form-control" id="expiration" name="expiration" placeholder="expiration date" value="">
                               
                                    @endif
                                   
                                    
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    @if($products)
                                    <div class="col-12 d-flex justify-content-center">
                                        {{-- {{dd($products)}} --}}
                                        <img src="{{ url('/storage/') }}{{ $products->stock_image ? '/stock/'. $products->stock_image : '/seller/product_type_image/default_product_image.jpg'  }}" alt="">
                                    </div>
                                    <div class="row">
                                        <label for="prod image">Product Photo</label>
                                        <input class="form-control" type="file" id="prod-img" name="prod-img">
                                    </div> 
                                        
                                </div>
                             </div>
                                @else 
 
                                <div class="row mt-3 ">
                                    <div class="col-12">
                                        <label for="prod image">Product Photo</label>
                                        <input class="form-control" type="file" id="prod-img" name="prod-img">
                                    </div>
                                </div> 
                                @endif
                            <div class="row mt-3">
                                <div class="col-12 mx-2">
                                    <div class="form-group">
                                        @if ($products)
                                         <textarea class="form-control text-justify" id="exampleFormControlTextarea1" rows="3" placeholder="Descreption" name="description" >{{$products->product_description}}</textarea>
                                   
                                        @else
                                        <textarea class="form-control text-justify" id="exampleFormControlTextarea1" rows="3" placeholder="Descreption" name="description" ></textarea>
                                   
                                        @endif
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                   <button  class="btn btn-primary d-block" type="submit">Publish</button>
                                </div>
                            </div>
                        </div>
                    </form>
                   </div>
               </div>
            </div> 
        </div>
    </div>
@endsection

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>

<script type="text/javascript">

$(document).ready(function () {

                $('#product_type').on('change', function () {
                let id = $(this).val();
                $('#product_name').empty();
                $('#product_name').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                type: 'GET',
                url: '/seller/product/product-name/' +id, 
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);   
                $('#product_name').empty();
                $('#product_name').append(`<option value="0" disabled selected>Select Product Name</option>`);
                response.forEach(element => {
                    $('#product_name').append(`<option data-price="${element['product_price']}" value="${element['product_id']}">${element['product_name']}</option>`);
                    });
                }
            });
        });

// ---------------------------------------------------------------------------------------------

        $('#product_name').on('change', function (e) {
            $('input[name="srp"]').val($(this).find(':selected').attr('data-price'));
        });


        var stock =$('#stock');

        $('#add').on('click',function(e){
            e.preventDefault();
            stock.val(parseInt(stock.val()) + 1);
        });

        $('#subtract').on('click',function(e){
            e.preventDefault();
            stock.val(parseInt(stock.val()) - 1);
        });


        $('#expiration')[0].min = new Date().toISOString().split("T")[0];
    });
</script>




