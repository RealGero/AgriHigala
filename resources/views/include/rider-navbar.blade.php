<div class="dropdown ">

  {{-- PROFILE --}}
  <button  type="button" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-user  fa-2x fontawesome-color"></i>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="{{route('rider.profile.index')}}">Profile</a>
    <a class="dropdown-item" href="">Account</a>
  </div>
</div>

@auth
  {{-- NOTIFICATION --}}
  <div class="dropdown dropdown-menu-left">
    @include('admin.notification.show')
  </div>

  {{-- SIDENAV LINKS--}}
  <div id="mySidenav" class="sidenav">
    {{-- ORDER --}}
    <div>
      <a class="" data-toggle="collapse" href="#order-items" aria-expanded="false" aria-controls="order-items">
        <i class="fas fa-box pr-2"></i>Order
      </a>
    </div>
    <div class="collapse" id="order-items">
      <div class="d-flex flex-column navigation-items text-white">
        <a href="{{route('rider.order.index')}}"> My orders</a> 
        <a href="{{route('rider.history.index')}}">History</a> 
        {{-- <a href="/seller/return">Return</a>  --}}
      </div>
    </div>

    {{-- PROFILE --}}
    <a href="{{route('rider.profile.index')}}"> <i class="fas fa-user pr-2"></i>Profile</a>

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
  
  {{-- MENU BAR BUTTON --}}
  <span style="cursor:pointer" onclick="openNav()">
    <i class="fa fa-bars fa-2x fontawesome-color"></i>
  </span>
@endauth
 
    
 