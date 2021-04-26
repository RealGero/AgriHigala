<div class="container">
    <div class="modal-add-profile">
        <div class="row">
            <div class="col-12">
                <div class="modal fade" id="add-rider-pic" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Add Profile Photo</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{action('RidersController@imageUpdate')}}" method="POST" enctype="multipart/form-data" >
                          @csrf
                          <div class="modal-body">
                            <div class="card col-11 mx-auto">
                            <div class="card-body">
                              <input type="file" name="user_image">
                            </div>
                          </div>
                          
                        </div>
                        <div class="modal-footer">
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
  