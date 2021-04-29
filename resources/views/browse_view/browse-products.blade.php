
<div class="container">
  <div class="browse-prod-container"> 
      <div class="row">
        <div class="col-10 mx-auto ">
          <h2>Browse Products</h2>
          <div class="card">
              <div class="input-group rounded">
                <form method="GET" action="">
                  <span>Search for product name</span>
                  <input type="search" class="form-control rounded" name="s" placeholder="Search" style="font-family:Arial, FontAwesome" aria-label="Search"
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