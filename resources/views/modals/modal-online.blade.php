
<div class="modal fade" id="online-img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Payment Photo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{action('OrdersController@uploadImageInViewOrder',[$order->payment_id])}}" method="POST" enctype="multipart/form-data">
          @if($order->payment_image)
             <div class="d-flex justify-content-center flex-column">
                <img class="payment-online" src="/storage/payment/{{$order->payment_image}}" alt="">
            </div>
            <div class="form-group">
              <label for="exampleFormControlFile1">Upload Photo</label>
              <input type="file" class="form-control-file" id="" name="online-payment-img">
             </div>
          @else
         
                <div class="form-group">
                  <label for="exampleFormControlFile1">Upload Photo</label>
                  <input type="file" class="form-control-file" id="" name="online-payment-img">
                 </div>
              
          @endif
        </div>
        <div class="modal-footer">
          @method('PUT')
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
          </form> 
        </div>
      </div>
    </div>
</div>