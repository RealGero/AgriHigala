@extends('layouts.app')


@section('content')
    
    <div class="container">
        <div class="inbox-container">
            <div class="row">
                <div class="col-4 mx-auto">
                    <span class="h3">Message</span>
                
                    @php
                        $messages = \App\Message::getMessage($inbox->inbox_id);
                        if(Auth::user()->user_type == 2 )  
                        {
                            $user_type = 'seller';
                            // $user =\App\User::find(Auth::id())->seller->seller_id;
                        }elseif(Auth::user()->user_type == 4 ) {
                        $user_type = 'buyer';
                            // $user =\App\User::find(Auth::id())->buyer->buyer_id;
                        }

                        if($user_type == 'seller' )  
                        {
                            $ownerName =\App\User::find(Auth::id())->username;
                        }else{
                            $ownerName =\App\User::find(Auth::id())->username;
                        }
                        // dd($user);
                    @endphp
                    <div class="card mt-2">
                        <div class="card-body card-size overflow-auto">
                            <div class="row mb-4">
                               <div class="col-12 d-flex justify-content-center">
                                   @if($user_type == 'buyer')
                                        <form action="{{action('MessagesController@buyerMessageStore',[$inbox->inbox_id])}}" method="POST">
                                            @csrf
                                            <div class="d-flex justify-content-between align-items-center">
                                                <input class="form-control mr-3" type="text" placeholder="Type here. . " name="input-message" required> 
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </div>
                                        </form>
                                    @elseif($user_type == 'seller')
                                        <form action="{{action('MessagesController@sellerMessageStore',[$inbox->inbox_id])}}" method="POST">
                                            @csrf
                                            <div class="d-flex justify-content-between align-items-center">
                                                <input class="form-control mr-3" type="text" placeholder="Type here. . " name="input-message" required> 
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </div>
                                        </form>
                                    @endif
                                </div> 
                            </div>
                            {{-- {{dd($inbox->inbox_id)}}   --}}
                          
                            @foreach($messages as $message)

                                @php
                                    if($user_type == $message->sender){
                                        $username = $ownerName;
                                        $owner_class = 'owned';
                                    }else{
                                        $username = $inbox->username;
                                        $owner_class = 'not-owned';
                                    }
                                @endphp
                                {{-- <div class="col-4 text-center overflow-auto border-right">
                                    <h3 class="mb-4">Name</h3> 
                                    <img src="/images/lansones.jpg" alt="" class="mb-3"> 
                                   <h5 class="d-inline p-2">John Doe</h5> <br>
                                   <img src="/images/lansones.jpg" alt=""> 
                                   <h5 class="d-inline p-2">John Doe</h5>
                                </div>   --}}
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="{{$owner_class}}">
                                                <span class="ml-2">{{$username}}</span>
                                                <br> 
                                                <span class="ml-2"> {{$message->message}}</span>
                                                <br> 
                                                <small class="ml-2">{{\Carbon\Carbon::parse($message->message_created_at)->diffForHumans()}}</small>              
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                {{-- @if( $user == $message->buyer_id && $message->sender == 'buyer')
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="owned">
                                                <span class="owned-name ml-2">{{$inbox->buyername}}</span>
                                            <br>  <span class="ml-2">  {{$message->message}} </span>
                                                <br><small class="ml-2">{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</small>
                                            </div>
                                        </div>
                                    </div>
                                @elseif( $user == $message->seller_id && $message->sender == 'seller') 
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="owned">
                                                <span class="owned-name ml-2">{{$inbox->sellername}}</span>
                                            <br>  <span class="ml-2">  {{$message->message}} </span>
                                                <br><small class="ml-2">{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</small>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="">
                                                <div class="not-owned">
                                                    <span class="ml-2">{{$inbox->sellername}}</span>
                                                    <br> 
                                                    <span class="ml-2"> {{$message->message}}</span>
                                                    <br> 
                                                    <small class="ml-2">{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</small>              
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                @endif --}}
                            @endforeach    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection