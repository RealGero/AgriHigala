<div class="container">
    <div class="modal-add-id">
        <div class="row">
            <div class="col-12">
                <div class="modal fade" id="online" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Upload Payment <span class="font-weight-bold"> Cash on Delivery</span>?</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                     
                        <form action="{{action ('OrdersController@changeToCod')}}" method="POST"  >
                          @csrf
                          <input type="hidden" value="{{$payment->payment_method}}" name="payment">

                        <div class ="modal-footer">
                          @method('PUT')
                          <button type="submit" class="btn btn-primary">Save</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                          
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
  </div>