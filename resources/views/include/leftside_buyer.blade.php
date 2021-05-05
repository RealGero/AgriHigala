<div class="leftnav-buyer border">
  <div>
    <a class="" data-toggle="collapse" href="#myaccount-items" aria-expanded="false" aria-controls="product-items">
      My Account
    </a>
  </div>
  <div class="collapse" id="myaccount-items">
    <div class="d-flex flex-column myaccount-collapse text-white pl-3">
        <a href="{{route('buyer.profile.edit')}}">Account</a> 
        <a href="{{route('buyer.useraccount')}}">Profile</a>
    </div>
  </div>
  <div>
    <a class="" data-toggle="collapse" href="#myorder-items" aria-expanded="false" aria-controls="product-items">
      My Orders
    </a>
  </div>
  <div class="collapse" id="myorder-items">
    <div class="d-flex flex-column text-white pl-3">
       <a href="{{route('buyer.order')}}">Orders</a> 
        {{-- <a href="{{route('buyer.return.index')}}">Returns</a> --}}
     
    </div>
  </div>
  

</div>
