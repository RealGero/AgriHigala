@extends('layouts.app')


@section('content')
    
    <div class="container">
        <div class="feedback">
            <div class="row">
                <div class="col-4 mx-auto">
                    <span class="h4">Feedback</span>
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <span class="h6 mb-2">Please rate our App</span>
                                </div>
                            </div>
                            <form action="{{action('FeedBacksController@buyerFeedbackStore')}}" method="POST">
                                @csrf
                                <div class="row mx-2">
                                    <div class="col-12 d-flex flex-column">
                                        <div class="form-group mt-2">
                                            <select class="form-select form-select-sm form-control" aria-label=".form-select-sm example" name="rating">
                                                <option value="5">5</option>
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                                <option value="2">2</option>
                                                <option value="1">1</option>
                                              </select>
                                            <label for="exampleFormControlTextarea1">Comment:</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="comment" required></textarea>
                                            <label for="email">Email:</label>
                                            <input type="email" name="email" id="" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-success">Submit</button>
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