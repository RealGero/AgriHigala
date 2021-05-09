
<div class="container">
  <div class="browse-dropdowns mt-3">
    <div class="row">
      <div class="col-12 mx-auto mb-3">
        <h3>Browse products</h3>
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-4 d-flex justify-content-around">
                  <select class="form-select form-control mr-2" aria-label="Default select example" name="category">
                    <option hidden>Category</option>
                      @foreach($categories as $category)
                        <option value="{{$category->product_type_id}}">{{$category->product_type_name}}</option>
                      @endforeach
                  </select>
              </div>  
              <div class="col-4">
                <select class="form-select form-control" aria-label="Default select example" name="brgy">
                  <option hidden>Select barangay</option>
                  @foreach($brgys as $brgy)
                    <option value="{{$brgy->brgy_id}}">{{$brgy->brgy_name}}</option>
                  @endforeach
                </select>
              </div> 
                <div class="col-4">
                  <form method="GET" action="">
                    {{-- <span>Search for product name</span> --}}
                    <input type="search" class="form-control" name="s" placeholder="Search for product name" style="font-family:Arial, FontAwesome" aria-label="Search"
                      aria-describedby="search-addon" value="<?= isset($_GET['s']) ? $_GET['s']: ''; ?>"/>
                    <span class="input-group-text border-0" id="search-addon" type="submit">
                      <i class="fa fa-search"></i>
                    </span>
                  </form>

                </div> 

           </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- <div class="row">
  <div class="col-4">
    <div class="input-group rounded">
    
    </div>
  </div>
</div> --}}