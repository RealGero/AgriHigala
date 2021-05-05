  

@auth
 
<div class="dropdown dropdown-menu-left">
  @include('admin.notification.show')
</div>

{{-- SIDENAV LINKS--}}
<div id="mySidenav" class="sidenav">
  {{-- DASHBOARD --}}
  <a href="{{route('rider.dashboard')}}"> <i class="fas fa-tachometer-alt"></i> Dashboard </a>
  {{-- ACCOUNT --}}
  <div>
    <a class="" data-toggle="collapse" href="#account-items" aria-expanded="false" aria-controls="product-items">
      <i class="fas fa-user pr-2"></i>Account
    </a>
  </div>
  <div class="collapse" id="account-items">
    <div class="d-flex flex-column navigation-items text-white">
        <a href="{{route('rider.profile.index')}}"> Profile</a> 
        <a href="{{route('account.index')}}">Account</a>
    </div>
  </div>

  {{-- ORDER --}}
  <a href="{{route('rider.order.index')}}"> <i class="fas fa-box pr-2"></i>Order </a>

  {{-- DISCOUNT --}}
  {{-- <a href="/buyer/discount"> <i class="fa fa-tags pr-2"></i>Discount</a> --}}

  {{-- FEEDBACK --}}
  <a href="/buyer/feedback"> <i class="fas fa-thumbs-up pr-2"></i>Feedback</a>



  {{-- HISTORY --}}
  <a href="{{route('rider.history.index')}}" > <i class="fas fa-history pr-2"></i>History</a>


  {{-- CUSTOMER SERVICE --}}
  <a href="{{route('customer-service.index')}}"> <i class="fas fa-headset pr-2"></i>Customer Service</a>

  {{-- LOGOUT --}}
  <a href="{{ route('logout') }}"  class="logout ml-5 font-italic" onclick="event.preventDefault();
  document.getElementById('logout-form').submit();">
  {{ __('Logout') }}</a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
  </form>

  {{-- CLOSE BUTTON --}}
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
</div>

{{-- MENU BAR BUTTON --}}
<span style="cursor:pointer" onclick="openNav()">
  <i class="fa fa-bars fa-2x fontawesome-color"></i>
</span>
@endauth    
 
          {{-- <div class="dropdown ">
            <button  type="button" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-bell  fa-2x fontawesome-color"></i>
            </button>
            
            </div> --}}
       

        {{-- <i class="fa fa-shopping-cart  fa-2x fontawesome-color"></i> --}}


           {{-- <div>
                <a class="" data-toggle="collapse" href="#product-items" aria-expanded="false" aria-controls="product-items">
                    <i class="fas fa-shopping-cart pr-2"></i>Product
                </a>
           </div>
           <div class="collapse" id="product-items">
                <div class="d-flex flex-column navigation-items text-white">
                   <a href="/seller/product/my-product"> My product</a> 
                    <a href="/seller/product/add-new-product">Add product</a>
                </div>
            </div> --}}

{{-- 
            <div>
                <a class="" data-toggle="collapse" href="#order-items" aria-expanded="false" aria-controls="order-items">
                    <i class="fas fa-box pr-2"></i>Order
                </a>
           </div>
           <div class="collapse" id="order-items">
                <div class="d-flex flex-column navigation-items text-white">
                   <a href="{{route('rider.order.index')}}"> My orders</a> 
                    <a href="/seller/history">History</a> 
                    <a href="/seller/return">Return</a> 
                </div>
            </div> --}}