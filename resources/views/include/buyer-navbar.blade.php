{{-- BROWSE --}}
<a href="/buyer/browse"><i class="fa fa-search  fa-2x fontawesome-color"></i></a>

{{-- CART --}}
<a href="{{route('cart.index')}}">
  <i class="fa fa-shopping-cart fa-2x fontawesome-color"></i>
  <span class="badge">{{Session::has('cart')>0 ? Session::get('cart')->totalQty : null}}</span>
</a>  

@auth
  {{-- NOTIFICATION --}}
  <div class="dropdown ">
    <button  type="button" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-bell  fa-2x fontawesome-color"></i>
    </button>
  </div>

  {{-- SIDENAV LINKS--}}
  <div id="mySidenav" class="sidenav">
    {{-- ACCOUNT --}}
    <div>
      <a class="" data-toggle="collapse" href="#account-items" aria-expanded="false" aria-controls="product-items">
        <i class="fas fa-user pr-2"></i>Account
      </a>
    </div>
    <div class="collapse" id="account-items">
      <div class="d-flex flex-column navigation-items text-white">
          <a href="/buyer/profile/edit"> Profile</a> 
          <a href="/buyer/user/account">Account</a>
      </div>
    </div>

    {{-- ORDER --}}
    <a href="/buyer/order/myorder"> <i class="fas fa-box pr-2"></i>Order </a>

    {{-- DISCOUNT --}}
    {{-- <a href="/buyer/discount"> <i class="fa fa-tags pr-2"></i>Discount</a> --}}

    {{-- FEEDBACK --}}
    <a href="/buyer/feedback"> <i class="fas fa-thumbs-up pr-2"></i>Feedback</a>

    {{-- INBOX --}}
    <a href="/buyer/inbox"><i class="fas fa-envelope pr-2"></i>Inbox</a>

    {{-- HISTORY --}}
    {{-- <a href="/buyer/history" > <i class="fas fa-history pr-2"></i>History</a> --}}

    {{-- ABOUT US --}}
    <a href="/about"><i class="fas fa-info-circle pr-2"></i>About Us</a>

    {{-- CONTACT US --}}
    <a href="/contact"><i class="fas fa-phone pr-2"></i>Contact Us</a>

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


