@extends('layouts.seller')

@section('content')
    <div class="container">
        <div class="myproduct">
            <div class="row">
                <div class="col-12">
                    <span class="h3">Product>My product</span>
                    @if(session()->has('success'))
                      <div class="alert alert-success">
                          {{ session()->get('success') }}
                      </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="col-6">
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <a class="btn btn-primary mx-3" href="/seller/product/add-new-product" role="button">+ Add new product</a>
                                </div> 
                            </div>
                            <table id="myproducttable" class="table">
                                <thead>
                                  <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Stock ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Unit type</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Uploaded date</th>
                                    <th scope="col">Expiration date</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                 
                                    @foreach($products as $product)
                                     @if(empty($product->deleted_at))
                                      <tr>
                                        <td><img src="{{ url('/storage/') }}{{ $product->stock_image ? '/stock/'. $product->stock_image : '/seller/product_type_image/default_product_image.jpg'  }}" alt=""></td>
                                        <td>{{$product->stock_id}}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{$product->unit_name ? $product->unit_name : '' }}</td>
                                        <td>{{$product->stock_price ? $product->stock_price : 0 }}</td>
                                        <td>{{$product->qty_added}}</td>
                                        <td>{{date('M d Y', strtotime($product->created_at))}}</td>
                                        <td>{{date('M d Y', strtotime($product->expiration_date))}}</td>
                                        
                                        <td> <a href="/seller/product/edit-product/{{$product->stock_id}}" class="pb-2"><button  class="btn btn-success btn-sm "> Edit </button> </a> 
                                          <a href="/seller/prduct/delete-product/{{$product->stock_id}}"><button  class="btn btn-danger btn-sm"> Delete </button> </a>
                                          </td>
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

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script>
  $(document).ready( function () {
    $('#myproducttable').DataTable();
} );
</script>