@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="buyer-ratings">
            <div class="row">
                <div class="col-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <span> Ratings</span>
                            <form action="{{action('RatingsController@buyerStore')}}" method="POST">
                                <select class="form-select form-select-sm form-control" aria-label=".form-select-sm example">
                                    <option selected>Open this select menu</option>
                                    <option data-content= "<i class='fas fa-star'</i>" value="1"></option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="4">Three</option>
                                    <option value="5">Three</option>
                                  </select>
                                

                            </form>
                        </div>
                     </div>
                    
                </div>
            </div>
        </div>
    </div>
    
  


@endsection

