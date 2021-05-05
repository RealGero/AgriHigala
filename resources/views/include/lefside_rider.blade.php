<div class="leftnav-buyer">
    <div>
      <a class="" data-toggle="collapse" href="#myaccount-items" aria-expanded="false" aria-controls="product-items">
        My Account
      </a>
   </div>
    <div class="collapse" id="myaccount-items">
      <div class="d-flex flex-column myaccount-collapse text-white">
         <a href="{{route('account.index')}}">Account</a> 
          <a href="{{route('rider.profile.index')}}">Profile</a>
      </div>
  </div>
   
    <a href="{{route('rider.order.index')}}">Orders</a>
   
  </div>