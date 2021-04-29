<div id="notifications">
    <a class="nav-link" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if (Auth::user()->user_type == '1')
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter">
                @if(count(Auth::user()->unreadNotifications) >10 )
                    <span data-count="10" class="count">10+</span>
                @else 
                    <span class="count" data-count="{{count(Auth::user()->unreadNotifications)}}">{{count(Auth::user()->unreadNotifications)}}</span>
                @endif
            </span>
        @else
            <i class="fa fa-bell  fa-2x fontawesome-color"></i>
            <!-- Counter - Alerts -->
            @if (count(Auth::user()->unreadNotifications) > 0 )
                <span class="badge badge-danger badge-counter user">
                    @if(count(Auth::user()->unreadNotifications) >10 )
                        <span data-count="10" class="count">10+</span>
                    @else 
                        <span class="count" data-count="{{count(Auth::user()->unreadNotifications)}}">{{count(Auth::user()->unreadNotifications)}}</span>
                    @endif
                </span>
            @endif
        @endif
      </a>
      <!-- Dropdown - Alerts -->
      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        @if (Auth::user()->user_type == '1')
            <h6 class="dropdown-header">Notifications Center</h6>
        @endif
        
        @php
            $unreadNotifications = Auth::user()->unreadNotifications
        @endphp
        {{-- NOTIFICATION --}}
        @if (count($unreadNotifications)>0)
            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Notifications</a>
            @foreach ($unreadNotifications as $notification)
                <form action="{{route('notifications.read', [$notification->id])}}" method="POST">
                    @csrf
                    <input type="hidden" name="action_url" value='{{$notification->data['announcement']['action_url']}}'>
                    <div class="dropdown-item w-100">
                        <button name="read_{{$notification->id}}" id="read_{{$notification->id}}" type="submit" class="btn btn-block btn-sm btn-link text-left shadow-none" role="link"> 
                            <span>
                                {{$notification->data['announcement']['title']}}
                                {{$notification->data['announcement']['table_id']}}
                                {{$notification->data['announcement']['subtitle']}}
                            </span>
                            <div class="small text-gray-500">{{$notification->created_at->format('F d, Y h:i A')}}</div>
                        </button>
                    </div>
                </form>

                {{-- ONLY RECENT 10 NOTIFICATIONS --}}
                @if($loop->index+1==10)
                    @php 
                        break;
                    @endphp
                @endif
            @endforeach

            {{-- MARK ALL AS READ --}}
            <form action="{{route('notifications.read.all')}}" method="POST">
                @csrf
                <div class="dropdown-item w-100">
                    <button name="read_all" id="read_all" type="submit" class="btn btn-block btn-sm btn-link small text-left shadow-none text-gray-500" role="link"> 
                        <span>Mark all as read</span>
                    </button>
                </div>
            </form>
        @else
            {{-- NO NOTIFICATIONS --}}
            <div class="dropdown-item d-flex align-items-center">
                <span class="text-muted font-italic">No new notifications</span>
            </div>
            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Notifications</a>
        @endif

        
      </div>
</div>