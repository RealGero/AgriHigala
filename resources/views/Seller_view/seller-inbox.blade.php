@extends('layouts.seller')


@section('content')
    
    <div class="container">
        <div class="inbox-container">
            <div class="row">
                <div class="col-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            {{-- {{dd($buyers)}} --}}
                           
                            @foreach($buyers as $buyer) 
                     
                                @php
                                    $messages = \App\Inbox::sellerInbox($buyer->inbox_id);  
                                    $lastMessage = \App\Inbox::getCreatedAt($buyer->inbox_id);
                                    // $user =\App\User::find(Auth::id())->buyer->buyer_id;
                                @endphp
                              <div class="row ">
                                    <div class="col">
                                       <img src="/storage/user/{{$buyer->user_image}}" class="" alt="profile-pic">
                                    </div>
                                    <div class="col">
                                        <span>{{ucfirst($buyer->f_name)}} {{ucfirst($buyer->m_name[0])}}. {{ucfirst($buyer->l_name)}} </span>
                                        <small>({{$buyer->username}})</small>
                                    </div>
                                    <div class="col">
                                        <br><small class="ml-2">{{\Carbon\Carbon::parse($lastMessage)->diffForHumans()}}</small>
                                    </div>
                                    <div class="col">
                                       <a href="/seller/message/{{$buyer->inbox_id}}" role="button" class="btn btn-primary  btn-sm">View Message</a>
                                    </div>
                              </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection