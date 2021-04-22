@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="payments">
            <div class="row">
                <div class="col-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    Bank Name: {{$seller->bank_name}}
                                </div>
                                <div class="col-6">
                                   Account Number: {{$seller->account_number}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    Seller Name: {{ucfirst($seller->account_firstname)}} {{$seller->account_middlename[0]}}. {{ucfirst($seller->account_lastname)}} 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="row mt-5">
                <div class="col-8 mx-auto">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-10 mx-auto d-flex justify-content-center">
                                    <form method="POST" action="{{route('payment.image',[$payment->payment_id])}}" enctype="multipart/form-data"  >
                                        @csrf
                                        <div class="form-group ">
                                          <label for="insertpayment" class="font-weight-bold">Upload Proof of Payment </label>
                                          <input type="file" name="payment-img" class="form-control-file @error('payment-img') is-invalid @enderror" id="exampleFormControlFile1" required>
                                          <div class="text-danger">{{$errors->first('payment-img')}}</div>

                                        </div>
                                        {{-- @method('PUT') --}}
                                        <div class="row">
                                            <button type="submit" class="btn btn-success">Submit Photo</button>
                                        </div>
                                      </form>   
                                </div>
                                <div class="col-2">
                                    <a href="{{route('buyer.order',[$payment->order_id])}}">Skip for now>></a>     
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#online-to-cod">
                                        Pay in COD
                                      </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modals.modal_cod')
@endsection