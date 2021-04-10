@extends('layouts.seller')

@section('content')
    <div class="container">
        <div class="myproduct">
            <div class="row">
                <div class="col-12">
                    <span class="h3">Product>My product</span>
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
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($products as $product)
                                    <tr>
                                      <td><img src="{{ url('/storage/') }}{{ $product->stock_image ? '/stock/'. $product->stock_image : '/seller/product_type_image/default_product_image.jpg'  }}" alt=""></td>
                                      <td>Otto</td>
                                      <td>{{ $product->product_name }}</td>
                                      <td>{{$product->unit_name ? $product->unit_name : '' }}</td>
                                      <td>{{$product->stock_price ? $product->stock_price : 0 }}</td>
                                      <td>{{$product->qty_added}}</td>
                                      <td>{{$product->created_at}}</td>
                                      <td>{{$product->expiration_date}}</td>
                                    </tr>
                                  @endforeach
                                  <tr>
                                    <td><img src="/images/lansones.jpg" alt=""></td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                  </tr>
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