{{-- PROFILE --}}
    
<div class="dropdown ">
  <button  type="button" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-user  fa-2x fontawesome-color"></i>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="{{route('seller.profile')}}">Profile</a>
    <a class="dropdown-item" href="{{route('seller.account')}}">Account</a>
  </div>
</div>
    {{-- <div class="col-6 right-side"> --}}
        {{-- <a href="/buyer/browse"><i class="fa fa-search  fa-2x fontawesome-color"></i></a> --}}
       
{{-- 
        <div class="dropdown ">
          <button  type="button" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user  fa-2x fontawesome-color"></i>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{route('seller.profile')}}">Profile</a>
            <a class="dropdown-item" href="{{route('seller.account')}}">Account</a> --}}
            {{-- <a class="dropdown-item"  href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form> --}}
            {{-- </div>
        </div> --}}
    {{-- </div> --}}
@auth
  {{-- NOTIFICATION --}}
  <div class="dropdown dropdown-menu-left">
    @include('admin.notification.show')
  </div>

  {{-- SIDENAV LINKS--}}
  <div id="mySidenav" class="sidenav">
    <a href="{{route('sellerdashboard')}}"> <i class="fas fa-tachometer-alt"></i> Dashboard </a>
    {{-- PRODUCT --}}
    <div>
      <a class="" data-toggle="collapse" href="#product-items" aria-expanded="false" aria-controls="product-items">
        <i class="fas fa-shopping-cart pr-2"></i>Product
      </a>
    </div>
    <div class="collapse" id="product-items">
      <div class="d-flex flex-column navigation-items text-white">
        <a href="/seller/product/my-product"> My product</a> 
        <a href="/seller/product/add-new-product">Add product</a>
      </div>
    </div>

          {{-- <div class="dropdown ">
            <button  type="button" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-bell  fa-2x fontawesome-color"></i>
            </button>
            
            </div> --}}
       

            {{-- <i class="fa fa-shopping-cart  fa-2x fontawesome-color"></i> --}}
            
           
            
              
            
       
            {{-- ORDER --}}
            <div>
              <a class="" data-toggle="collapse" href="#order-items" aria-expanded="false" aria-controls="order-items">
                <i class="fas fa-box pr-2"></i>Order
              </a>
            </div>
      <div class="collapse" id="order-items">
        <div class="d-flex flex-column navigation-items text-white">
        
                    <a href="{{route('order.request.index')}}"> My orders</a> 
          {{-- <a href="/seller/history">History</a>  --}}
          <a href="/seller/return">Return</a> 
        </div>
      </div>
      {{-- RATING --}}
      <a href="/seller/ratings"> <i class="fas fa-star pr-2"></i>Ratings</a>

      {{-- EARNINGS --}}
      {{-- <a href="/seller/earnings"> <i class="fas fa-chart-bar pr-2"></i>Earnings</a> --}}

      {{-- FEEDBACK --}}
      <a href="{{route('sellerFeedback.index')}}"> <i class="fas fa-thumbs-up pr-2"></i>Feedback</a>

      {{-- INBOX --}}
      <a href="{{route('sellerInbox.index')}}"> <i class="fa fa-envelope pr-2"></i>Inbox</a>

      {{-- RIDER --}}
      <a href="{{route('rider.index')}}"> <i class="fas fa-motorcycle pr-2"></i>Rider</a>

      {{-- CUSTOMER SERVICE --}}
      <a href="{{route('customer-service.index')}}"> <i class="fas fa-headset pr-2"></i>Customer Service </i></a>
      
      {{-- LOGOUT BUTTON --}}
      <a href="{{ route('logout') }}"  class="logout ml-5 font-italic" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
      {{ __('Logout') }}</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>

      {{-- CLOSE BUTTON --}}
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  </div>
  

  <span style="cursor:pointer" onclick="openNav()">
    <i class="fa fa-bars fa-2x fontawesome-color"></i>
  </span>
 
 @endauth
 
