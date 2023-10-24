<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <li class="nav-item">
      <a class="nav-link" href="{{ url('admin/dashboard')}}">
        <i class="mdi mdi-chart-histogram menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-equal-box menu-icon"></i>
        <span class="menu-title">Category</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ url('admin/category/create')}}">Add Category</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ url('admin/category')}}">View Category</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
        <i class="mdi mdi-loupe menu-icon"></i>
        <span class="menu-title">Products</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="products">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products/create')}}">Add Products</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products')}}">View Products</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('admin/brands')}}">
        <i class="mdi mdi-wallet-giftcard menu-icon"></i>
        <span class="menu-title">Brands</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('admin/colors')}}">
        <i class="mdi mdi-view-module menu-icon"></i>
        <span class="menu-title">Shades</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('admin/orders')}}">
        <i class="mdi mdi-chart-pie menu-icon"></i>
        <span class="menu-title">Orders</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="products">
        <i class="mdi mdi-loupe menu-icon"></i>
        <span class="menu-title">Users</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="users">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ url('admin/users/create')}}">Add Users</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ url('admin/users')}}">View Users</a></li>
        </ul>
      </div>      
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#customers" aria-expanded="false" aria-controls="products">
        <i class="mdi mdi-loupe menu-icon"></i>
        <span class="menu-title">Customers</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="customers">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ url('admin/customers/create')}}">Add Customers</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ url('admin/customers')}}">View Customers</a></li>
        </ul>
      </div>  
    </li>

  </ul>
</nav>
<!-- partial -->


