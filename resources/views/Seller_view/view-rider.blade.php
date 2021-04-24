@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="view-order">
          <div class="row">
              <div class="col-8 mx-auto">
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
                            <tbody>
                                @foreach ($riders as $rider)
                              <tr>
                                <td><img src="/storage/user/{{$rider->user_image}}" alt=""></td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                              </tr>
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    </div>
@endsection