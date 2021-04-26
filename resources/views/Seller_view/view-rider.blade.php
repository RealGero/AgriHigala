@extends('layouts.seller')


@section('content')
    <div class="container">
        <div class="view-order">
          <div class="row">
              <div class="col-11 mx-auto">
                 <div class="row mb-3">
                    
                    <div class="col-12 d-flex justify-content-between">
                        <span class="h3">My Riders</span> 
                        <a href="{{route('rider.create')}}" class="btn btn-primary">Add Rider</a>
                    </div>
                </div>
                @if($riders)

                <div class="card">
                    <div class="card-body">
                        
                      <table class="table table-borderless">
                          <thead>
                            <tr>
                              <th scope="col"></th>
                              <th scope="col">Name</th>
                              <th scope="col">Mobile Number</th>
                              <th scope="col">Email</th>
                            </tr>
                          </thead>
                          @foreach ($riders as $rider)
                          <tbody>
                              
                            <tr>
                              <td><img src="/storage/user/{{$rider->user_image}}" alt=""></td>
                              <td>{{ucfirst($rider->f_name)}} {{ucfirst($rider->m_name[0])}}. {{ucfirst($rider->l_name)}}</td>
                              <td>{{$rider->mobile_number}}</td>
                              <td>{{$rider->email}}</td>
                            </tr>
                            
                          </tbody>
                          @endforeach
                      </table>
                    </div>
                </div>

                @else
                    <span class="h3">You don't have a Rider yet</span>
                @endif
                 
              </div>
          </div>
        </div>
    </div>
@endsection