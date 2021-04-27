    <div class="sidebar-group">
        <!-- Heading -->
        <div class="sidebar-heading">
            Boom
        </div>
        <!--Booms -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#boomCollapse" aria-expanded="true" aria-controls="boomCollapse">
            <i class="fas fa-sitemap"></i>
            <span>Boom</span>
            </a>
            <div id="boomCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Boom Options:</h6>
                <a class="collapse-item" href="#">Boom</a>
                <a class="collapse-item" href="#">Add Boom</a>
            </div>
            </div>
        </li>
        <!--Booms -->
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-hammer fa-chart-area"></i>
                <span>Booms</span>
            </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
    </div>

    
{{-- Para sa inputs --}}
          {{--  --}}
          <div class="form-group">
            <label for="boom" class="col-form-label">Boom</label>
            <input id="boom" type="text" name="boom" placeholder="Enter boom"  value="{{old('boom')}}" class="form-control">
            @error('boom')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          
                {{--  --}}
                <div class="form-group">
                    <label for="boom" class="col-form-label">Boom</label>
                    <input id="boom" type="text" name="boom" placeholder="Enter boom"  value="{{old('boom')}}" class="form-control">
                    @error('boom')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>