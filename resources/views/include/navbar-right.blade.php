
<div class="col-6 right-side">
  
  {{-- User Type --}}
  <div class="dropdown ">
    <button  type="button" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      @guest
        <span class="text-white fa-2x mr-1">Guest | </span>
      @else
        @if (Auth::user()->user_type == '2')
          <span class="text-white fa-2x mr-1">Seller |</span>
        @elseif (Auth::user()->user_type == '3')
          <span class="text-white fa-2x mr-1">Rider |</span>
        @elseif (Auth::user()->user_type == '4')
          <span class="text-white fa-2x mr-1">Buyer |</span>
        @endif
      @endguest
    </button>
  </div>
  
  @guest
    @include('include.buyer-navbar')
  @else
    @if (Auth::user()->user_type == '2')
      @include('include.seller-navbar')
    @elseif (Auth::user()->user_type == '3')
      @include('include.rider-navbar')
    @else
      @include('include.buyer-navbar')
    @endif
  @endguest
</div> 


