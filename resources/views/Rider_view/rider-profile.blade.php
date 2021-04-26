@extends('layouts.rider')

@section('content')
    <div class="container rider-profile">
        <div class="row">
            <div class="col-7 mx-auto">
                <div class="card mb-3">
                    <div class="card-body">
                      <div class="row d-flex justify-content-around">
                          <div class="col-6">
                             <p> <span class="font-weight-bold">Seller Name:</span> <span class="text-capitalize"> {{$seller->f_name}} {{$seller->m_name[0]}}. {{$seller->l_name}}   </span> </p>
                             <p> <span  class="font-weight-bold">Email: </span> <span> {{$seller->email}}</span></p>
                             <p> <span  class="font-weight-bold">Mobile #: </span> <span> {{$seller->mobile_number}}</span></p>
                            </div>
                            <div class="col-6">
                            <p> <span  class="font-weight-bold">Org Name: </span> <span> {{$seller->org_name}}</span></p>
                            <p> <span  class="font-weight-bold">Org Address: </span> <span> {{$seller->address}}</span></p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      <div class="row">
        <div class="col-6 mx-auto">
          @if(session()->has('image'))
              <div class="alert alert-success">
                  {{ session()->get('image') }}
              </div>
          @endif
          @if(session()->has('details'))
              <div class="alert alert-success">
                  {{ session()->get('details') }}
              </div>
          @endif
          @if(session()->has('password'))
          <div class="alert alert-success">
              {{ session()->get('password') }}
          </div>
         @endif
         @if(session()->has('error'))
         <div class="alert alert-danger">
             {{ session()->get('error') }}
         </div>
         @endif
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">Profile</h2>
                <form action="{{action('RidersController@profileUpdate')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="row">
                      <div class="col-4 ">
                        <img src="/storage/user/{{$rider->user_image}}" class="rounded-circle" alt="profile-pic">
                        <a class="btn btn-primary btn-sm btn-block upload-photo-btn" data-toggle="modal" data-target="#add-rider-pic" href="#" role="button">Upload photo</a>
                      </div>
                      <div class="col-8 mt-3">
                        <h4 class="font-weight-bold text-capitalize">{{$rider->f_name.' '.$rider->l_name}}</h4> 
                        <h6>Joined   {{ \Carbon\Carbon::parse($rider->created_at)->diffForhumans() }}</h6>
                      </div>
                    </div>
                   
                    <div class="row profile-input">
                        <div class="col-12">
                          <input type="text" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" name="first_name" value="{{$rider->f_name}}">
                          <div class="text-danger"> {{$errors->first('first_name')}}</div>
                        </div>
                      </div>

                      <div class="row profile-input">
                        <div class="col-12">
                          <input type="text" class="form-control @error('middle_name') is-invalid @enderror" placeholder="Middle Name" name="middle_name" value="{{$rider->m_name}}">
                          <div class="text-danger"> {{$errors->first('middle_name')}}</div>
                        </div>
                      </div>

                      <div class="row profile-input">
                        <div class="col-12">
                          <input type="text" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last_name" name="last_name" value="{{$rider->l_name}}">
                          <div class="text-danger"> {{$errors->first('last_name')}}</div>
                        </div>
                      </div>
                    <div class="row profile-input">
                      <div class="col-12">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{$rider->email}}">
                        <div class="text-danger"> {{$errors->first('email')}}</div>
                      </div>
                    </div>
                    <div class="row profile-input">
                      <div class="col-12">
                        <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" placeholder="Mobile number" name="mobile_number" value="{{$rider->mobile_number}}">
                        <div class="text-danger"> {{$errors->first('mobile_number')}}</div>
                      </div>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Description" id="exampleFormControlTextarea1" rows="5" name="description">{{$rider->rider_description}}</textarea>
                        <div class="text-danger"> {{$errors->first('description')}}</div>
                    </div>

                    <div class="row profile-input">
                        <div class="col-12">
                            <label for="username" class="font-weight-bold"> Update Username</label>
                          <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" value="{{$rider->username}}">
                          <div class="text-danger"> {{$errors->first('username')}}</div>
                        </div>
                      </div>
                     
                    {{-- <div class="d-flex flex-row mb-3 form-group">
                      <label for="barangays" class="col-md-4 col-form-label text-md-right">{{__('Choose a Barangay:')}}</label>
                      <select name="brgy" id="brgy" class="form-control  @error('brgy') is-invalid @enderror">
                          @foreach($brgys as $brgy)
                              <option value="{{$brgy->brgy_name}}" {{$brgy->brgy_id=='1' ? 'selected' : ''}}> {{$brgy->brgy_name}}</option>
                          @endforeach
                      </select>
                      <div class="text-danger"> {{$errors->first('brgy')}}</div>
                  </div> --}}

                      @method('PUT')
                    <div class="row profile-input">
                        <div class="col-12 d-flex flex-column">
                            <button type="submit" class="btn btn-success">Save</button>
                            
                        </div>
                    </div>   
                  </form>
                  {{-- @include('modals.modals') --}}
            </div>     
          </div> 
        
       
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{action('RidersController@passwordUpdate')}}" method="POST">
                        @csrf
                    <div class="row profile-input">
                        <div class="col-12">
                            <label for="old password" class="font-weight-bold"> Old Password</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Password" name="current_password" value="">
                        <div class="text-danger"> {{$errors->first('current_password')}}</div>
                        </div>
                    </div>
                    <div class="row profile-input">
                        <div class="col-12">
                            <label for="new password" class="font-weight-bold"> New Password</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password" name="new_password" value="">
                        <div class="text-danger"> {{$errors->first('new_password')}}</div>
                     </div>
                    </div>
                    <div class="row profile-input">
                        <div class="col-12">
                            <label for="confirm password" class="font-weight-bold"> Confirm Password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" name="password_confirmation" value="">
                        <div class="text-danger"> {{$errors->first('password_confirmation')}}</div>
                        </div>
                    </div>
                    @method('PUT')
                    <div class="row profile-input">
                        <div class="col-12 d-flex flex-column">
                            <button type="submit" class="btn btn-success">Save</button>
                            
                        </div>
                    </div> 
                </form>  
                </div>
            </div>
          </div>
      </div>

    </div>
    @include('modals.rider-modal-profile')
@endsection