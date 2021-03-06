@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="buyer-ratings">
            <div class="row">
                <div class="col-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <span class="h5 font-weight-bold">Please Rate:</span>
                           
                            <form action="{{action('RatingsController@buyerStore')}}" method="POST">
                                <div class="form-group">
                                    @csrf
                                    <select class="form-select form-select-sm form-control my-3" name="rating" aria-label=".form-select-sm example" required>
                                        <option value="5" selected>5</option>                      
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                        <option value="5">5</option>
                                    </select>
                                    <label for="exampleFormControlTextarea1">Provide a comment please!</label>
                                    <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" id="exampleFormControlTextarea1" rows="6">
                                       
                                    </textarea>
                                    <div class="text-danger">{{$errors->first('comment                                                             ')}}</div> 
                                    </textarea>
                                   
                                    <input type="hidden" name="order" value="{{$id}}">
                                    </div> 
                                <div class="row">
                                    <div class="col-6">
                                        <input type="submit" value="Submit" class="btn btn-success">
                                     
                                    </div>
                                    <div class="col-6">
                                        <span class="d-flex justify-content-end"> <a href="{{route('buyer.order')}}" class="btn btn-info">Back to Order</a></span>   
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

