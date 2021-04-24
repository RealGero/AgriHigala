@extends('layouts.seller')


@section('content')
    
    <div class="container">
        <div class="inbox-container">
            <div class="row">
                <div class="col-4 mx-auto">
                    <span class="h3">Message</span>
                    <div class="card mt-2">
                        <div class="card-body card-size overflow-auto">
                            <div class="row mb-4">
                               <div class="col-12 d-flex justify-content-center">
                                    <form action="{{action('MessagesController@buyerMessageStore',[$inbox->inbox_id])}}" method="POST">
                                        @csrf
                                        <div class="d-flex justify-content-between align-items-center">
                                            <input class="form-control mr-3" type="text" placeholder="Type here. . " name="input-message"> 
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div>
                                    </form>
                                </div> 
                            </div>
                            {{-- {{dd($inbox->inbox_id)}}   --}}
                            @php
                                 $messages = \App\Message::getMessage($inbox->inbox_id);  
                                $user =\App\User::find(Auth::id())->buyer->buyer_id;
                                // dd($user);
                            @endphp
                          
                            @foreach($messages as $message)

                           
                                {{-- <div class="col-4 text-center overflow-auto border-right">
                                    <h3 class="mb-4">Name</h3> 
                                    <img src="/images/lansones.jpg" alt="" class="mb-3"> 
                                   <h5 class="d-inline p-2">John Doe</h5> <br>
                                   <img src="/images/lansones.jpg" alt=""> 
                                   <h5 class="d-inline p-2">John Doe</h5>
                                </div>   --}}
                             @if( $user == $message->buyer_id && $message->sender == 'buyer')
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="owned ">
                                            <span class=" ml-2">{{$inbox->buyername}}</span>
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
                                               <br> <span class="ml-2"> {{$message->message}}</span>
                                               <br> <small class="ml-2">{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</small>              

                                            </div>
                                        </div>
                                    </div>
                                </div>  
                              @endif
                            @endforeach    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection