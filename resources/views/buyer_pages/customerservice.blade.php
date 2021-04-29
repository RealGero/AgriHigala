@extends('layouts.app')


@section('content')
    
    <div class="container">
        <div class="inbox-container customer-service">
            <div class="row">
                <div class="col-6 mx-auto">
                    <span class="h4">Customer Service</span>
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-success">
                        {{ session()->get('error') }}
                    </div>
                    @endif
                    <div class="card mt-2">
                        <div class="card-body card-size overflow-auto">
                            <div class="row mb-4">
                               <div class="col-12 d-flex justify-content-center">
                                   {{-- @if($user_type == 'buyer') --}}
                                        <form action="{{route('customer-service.store')}}" method="POST">
                                            @csrf
                                            <div class="d-flex justify-content-between align-items-center">
                                                <input class="form-control mr-3" type="text" placeholder="Type here. . " name="message"> 
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </div>
                                        </form>
                                </div> 
                            </div>
                            {{-- {{dd($inbox->inbox_id)}}   --}}
                          
                            @foreach($messages as $message)

                                @php
                                        
                                if($message->sender == 'user' )  
                                {
                                    $owner_class = 'owned';
                                    $ownerName = Auth::user()->username;
                                    
                                }else{
                                    $owner_class = 'not-owned';
                                    $ownerName = 'Admin';
                                    }

                                    // if($user_type == $message->sender){
                                    //     $username = $ownerName;
                                       
                                    // }else{
                                    //     $username = $inbox->username;
                                       
                                    // }
                                @endphp
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="{{$owner_class}}">
                                                <span class="ml-2">{{$ownerName}}</span>
                                                <br> 
                                                <span class="ml-2"> {{$message->message}}</span>
                                                <br> 
                                                <small class="ml-2">{{\Carbon\Carbon::parse($message->announcement_created_at)->diffForHumans()}}</small>              
                                            </div>
                                        </div>
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
{{-- 
@elseif($user_type == 'seller')
<form action="{{action('MessagesController@sellerMessageStore',[$inbox->inbox_id])}}" method="POST">
    @csrf
    <div class="d-flex justify-content-between align-items-center">
        <input class="form-control mr-3" type="text" placeholder="Type here. . " name="input-message"> 
        <button type="submit" class="btn btn-primary">Send</button>
    </div>
</form>
@endif --}}