@extends('layouts.seller')


@section('content')
    <div class="container">
        <div class="account-profile">
            <div class="row">
                <div class="col-4 mx-auto">
                    <h3>User>Account</h3>
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{session('error')}}
                        </div>
                    @endif

                    @if(session()->has('password'))
                            <div class="alert alert-success">
                                {{session()->get('password')}}
                            </div>      
                    @endif

                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{session()->get('success')}}
                        </div>      
                     @endif
                    <div class="row my-3">
                        <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <span class="h4"> Change Username:</span>
                                        <form action="{{action('UsersController@sellerUpdateUsername')}}" method="POST">
                                            @csrf
                                            <div class="row mb-3 mt-2">
                                                <div class="col-12">
                                                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{$seller->username}}">
                                                    <div class="text-danger">{{$errors->first('username')}}</div>
                                                </div>
                                                
                                            </div>
                                            @method('PUT')
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary"> Save </button>
                                                </div>
                                            </div> 
                                      </form>    
                                        <form action="{{action('UsersController@sellerAccountUpdate')}}" method="POST">    
                                        <span class="h4 mb-2">Change Password</span>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">   
                                                    <label for="current password">Current Password:</label>    
                                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="inputPassword" placeholder="Old password" name="current_password" autocomplete="current_password">
                                                    <div class="text-danger">{{$errors->first('current_password')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">       
                                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="inputPassword" placeholder="New password" name="new_password">
                                                    <div class="text-danger">{{$errors->first('new_password')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">       
                                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputPassword" placeholder="Confirm password" name="password_confirmation">
                                                    <div class="text-danger">{{$errors->first('password_confirmation')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary"> Save </button>
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection