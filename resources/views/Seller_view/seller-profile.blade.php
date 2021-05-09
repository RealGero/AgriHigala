@extends('layouts.seller')

@section('content')

    <div class="container edit-profile">
      <div class="row">
        <div class="col-4 mx-auto">
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
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">Profile</h2>
                <form action="{{action('UsersController@updateSellerDetails')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="row">
                      <div class="col-4 ">
                        <img src="/storage/user/{{$user->user_image}}" class="rounded-circle" alt="profile-pic">
                        <a class="btn btn-primary btn-sm btn-block upload-photo-btn" data-toggle="modal" data-target="#add-seller-profile-pic" href="#" role="button">Upload photo</a>
                      </div>
                      <div class="col-8 mt-3">
                        <h4 class="font-weight-bold text-capitalize">{{$user->f_name.' '.$user->l_name}}</h4> 
                        <h6>Joined on {{date('M Y', strtotime($user->created_at))}}</h6>
                      </div>
                    </div>
                   
                    <div class="row profile-input">
                      <div class="col-12">
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" placeholder="first name" name="first_name" value="{{$user->f_name}}">
                        <div class="text-danger"> {{$errors->first('first_name')}}</div>
                      </div>
                    </div>   

                    <div class="row profile-input">
                      <div class="col-12">
                        <input type="text" class="form-control @error('middle_name') is-invalid @enderror" placeholder="Middle name" name="middle_name" value="{{$user->m_name}}">
                        <div class="text-danger"> {{$errors->first('middle_name')}}</div>
                      </div>
                    </div>

                    <div class="row profile-input">
                      <div class="col-12">
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last name" name="last_name" value="{{$user->l_name}}">
                        <div class="text-danger"> {{$errors->first('last_name')}}</div>
                      </div>
                    </div>

                    <div class="row profile-input">
                      <div class="col-12">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{$user->email}}">
                        <div class="text-danger"> {{$errors->first('email')}}</div>
                      </div>
                    </div>
                    <div class="row profile-input">
                      <div class="col-12">
                        <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" placeholder="Mobile number" name="mobile_number" value="{{$user->mobile_number}}">
                        <div class="text-danger"> {{$errors->first('mobile_number')}}</div>
                      </div>
                    </div>
                    <div class="row profile-input">
                        <div class="col-12">
                            <input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Address" name="address" value="{{$user->seller->org->address}}">
                            <div class="text-danger"> {{$errors->first('address')}}</div>
                          </div>
                    </div>

                    {{-- <div class="row profile-input">
                        <div class="col-12">
                        <input type="text" class="form-control" placeholder="Barangay" name = "barangay" value="{{$user->seller->org->brgy->brgy_name}}">
                        </div>
                    </div> --}}
                    <div class="d-flex flex-row mb-3 form-group">
                      <label for="barangays" class="col-md-4 col-form-label text-md-right">{{__('Choose a Barangay:')}}</label>
                      <select name="brgy" id="brgy" class="form-control  @error('brgy') is-invalid @enderror" required>
               
                          @foreach($brgys as $brgy)
                              
                              <option value="{{$brgy->brgy_id}}" {{$seller->brgy_id ==$brgy->brgy_id ? 'sellected':'' }} > {{$brgy->brgy_name}}</option>
                          @endforeach
                      </select>
                      <div class="text-danger"> {{$errors->first('brgy')}}</div>
                  </div>

                    <div class="row profile-input">
                        <div class="col-12">
                          <input type="text" class="form-control @error('schedule') is-invalid @enderror" placeholder="Scheduled online time" name = "schedule" value="{{$user->seller->schedule_online_time}}">
                          <div class="text-danger"> {{$errors->first('schedule')}}</div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Description" id="exampleFormControlTextarea1" rows="5" name="description">{{$user->seller->seller_description}}</textarea>
                        <div class="text-danger"> {{$errors->first('description')}}</div>
                      </div>
                   
                      @method('PUT')
                    <div class="row profile-input">
                        <div class="col-12 d-flex flex-column">
                            <button type="submit" class="btn btn-success">Save</button>
                            
                        </div>
                    </div>   
                  </form>
                  @include('modals.modals')
            </div>     
          </div>   
        </div>
      </div>
    </div>
    
@endsection