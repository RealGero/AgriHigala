
<div class="container">
  <div class="browse-dropdowns mt-3">
    <div class="row">
      <div class="col-10 mx-auto">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-12 d-flex justify-content-around">
                  <select class="form-select" aria-label="Default select example" name="category">
                      <option hidden>Category</option>
                      @foreach($categories as $category)
                        <option value="{{$category->product_type_id}}">{{$category->product_type_name}}</option>
                      @endforeach
                  </select>
                    <select class="form-select" aria-label="Default select example">
                      <option selected>Price</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                    <select class="form-select" aria-label="Default select example">
                      <option hidden>Barangay</option>
                      @foreach($brgys as $brgy)
                        <option value="{{$brgy->brgy_id}}">{{$brgy->brgy_name}}</option>
                      @endforeach
                    </select>
          
                    <div class="form-check" style="display:inline">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                       Discount
                      </label>
                  </div>
                </div>
           </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>