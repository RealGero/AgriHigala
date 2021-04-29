@extends('layouts.app')


@section('content')
    
    <div class="container">
        <div class="inbox-container">
            <div class="row">
                <div class="col-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            {{-- {{dd($buyers)}} --}}
                            @if ($sellers)
                                @foreach($sellers as $seller) 
                                    @php
                                        $messages = \App\Inbox::sellerInbox($seller->inbox_id);  
                                        $lastMessage = \App\Inbox::getCreatedAt($seller->inbox_id);
                                        // $user =\App\User::find(Auth::id())->buyer->buyer_id;
                                    @endphp
                                    <div class="row ">
                                        <div class="col">
                                        <img src="/storage/user/{{$seller->user_image}}" class="" alt="profile-pic">
                                        </div>
                                        <div class="col">
                                            <span>{{ucfirst($seller->f_name)}} {{ucfirst($seller->m_name[0])}}. {{ucfirst($seller->l_name)}} </span>
                                            <small>({{$seller->username}})</small>
                                        </div>
                                        <div class="col">
                                            @if ($lastMessage)
                                                <br><small class="ml-2">{{\Carbon\Carbon::parse($lastMessage->created_at)->diffForHumans()}}</small>
                                            @else
                                                <small>No message</small>
                                            @endif
                                        </div>
                                        <div class="col">
                                        <a href="/buyer/chat/{{$seller->inbox_id}}" role="button" class="btn btn-primary  btn-sm">View Message</a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                Ew
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection