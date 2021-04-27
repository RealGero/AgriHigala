<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar-Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin')}}">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">
      Agri-Higala
    </div>
  </a>

  <div class="sidebar-group">
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{route('admin')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
  </div>

  <div class="sidebar-group">
    <!-- Heading -->
    <div class="sidebar-heading">
        Product
    </div>

    <!-- Users -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userCollapse" aria-expanded="true" aria-controls="userCollapse">
          <i class="fas fa-sitemap"></i>
          <span>User</span>
        </a>
        <div id="userCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">User Options:</h6>
            <a class="collapse-item" href="#">Users</a>
            <a class="collapse-item" href="#">Add Admin</a>
            <a class="collapse-item" href="#">Add Seller</a>
            <a class="collapse-item" href="#">Add Rider</a>
            <a class="collapse-item" href="#">Add Buyer</a>
          </div>
        </div>
    </li>
    {{-- Products --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productCollapse" aria-expanded="true" aria-controls="productCollapse">
          <i class="fas fa-cubes"></i>
          <span>Products</span>
        </a>
        <div id="productCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Product Options:</h6>
            <a class="collapse-item" href="#">Products</a>
            <a class="collapse-item" href="#">Add Product</a>
          </div>
        </div>
    </li>
    {{-- Brands --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brandCollapse" aria-expanded="true" aria-controls="brandCollapse">
          <i class="fas fa-table"></i>
          <span>Brands</span>
        </a>
        <div id="brandCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Brand Options:</h6>
            <a class="collapse-item" href="#">Brands</a>
            <a class="collapse-item" href="#">Add Brand</a>
          </div>
        </div>
    </li>
    {{-- Shipping --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shippingCollapse" aria-expanded="true" aria-controls="shippingCollapse">
          <i class="fas fa-truck"></i>
          <span>Shipping</span>
        </a>
        <div id="shippingCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Shipping Options:</h6>
            <a class="collapse-item" href="#">Shipping</a>
            <a class="collapse-item" href="#">Add Shipping</a>
          </div>
        </div>
    </li>

    <!--Orders -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.order.index')}}">
            <i class="fas fa-hammer fa-chart-area"></i>
            <span>Orders</span>
        </a>
    </li>

    <!-- Reviews -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.review.index')}}">
            <i class="fas fa-comments"></i>
            <span>Reviews</span></a>
    </li>
  </div>
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
</ul>