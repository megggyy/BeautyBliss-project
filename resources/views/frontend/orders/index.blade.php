<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Beauty Bliss</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/logo.png" rel="icon">

    <!-- Owl Carousel -->
    <link href="admin/assets/css/owl.carousel.min.css" rel="stylesheet">
    <link href="admin/assets/css/owl.theme.default.min.css" rel="stylesheet">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="frontend/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.min.css') }}">

</head>
<style>
    ul {
    list-style: none;
    padding-left: 0; /* Remove default left padding */
}

</style>
<body>
    @include('frontend.topbar')
    <div style="display: flex; justify-content: center;">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
            <a href="" class="text-decoration-none d-block d-lg-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                        class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="{{ url('/')}}" class="nav-item nav-link active">Home</a>
                    <a href="{{ url('/collections')}}" class="nav-item nav-link">Shop</a>
                    <a href="{{ url('/collections')}}" class="nav-item nav-link">Categories</a>
                    <a href="{{ url('/new-arrivals')}}" class="nav-item nav-link">New Arrivals</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="{{url('cart')}}" class="dropdown-item">Shopping Cart</a>
                            <a href="{{url('/checkout')}}" class="dropdown-item">Checkout</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">ORDERS</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="{{url('/orders')}}" class="dropdown-item">My Orders</a>
                            <a href="{{url('/user-reviews')}}" class="dropdown-item">My Reviews</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="navbar-nav ml-auto py-0">
                    <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                    <a href="" class="nav-item nav-link">Register</a>
                </div> --}}

                @if (Route::has('login'))
                @auth

                <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                 @csrf
                 </form>
                <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                 <div class="dropdown-menu rounded-0 m-0">
                     <a href="{{ url('/orders') }}" class="dropdown-item">Orders</a>
                     <a href="{{ url('profile') }}" class="dropdown-item">Profile</a>
                     <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                 </div>

                @else
                <div class="navbar-nav ml-auto py-0">
                 <a id="logincss" href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                 <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
             </div>
                @endauth
                @endif
            </div>
        </nav>
    </div>
    <div class="py-3 pyt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                    
                    <h4 class="mb-4"> My Orders</h4>
                  
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Tracking No</th>
                                <th>Username</th>
                                <th>Payment Mode</th>
                                <th>Ordered Date</th>
                                <th>Status Message</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $item)
                                    <tr>
                                        <td>{{ $item->id}}</td>
                                        <td>{{ $item->tracking_no}}</td>
                                        <td>{{ $item->fullname}}</td>
                                        <td>{{ $item->payment_mode}}</td>
                                        <td>{{ $item->created_at->format('d-m-Y')}}</td>
                                        <td>{{ $item->status_message}}</td>
                                        <td><a href="{{ url('orders/'.$item->id)}}" class="btn btn-primary btn-sm">View</a></td>   
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Orders Available</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <div>
                            {{ $orders->links() }}
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>     
     </div>
      
     @push('script')
     <script>
          $(document).ready(function() {
                 $('#ordersTable').DataTable();
             });

     </script>
     @endpush
    @include('frontend.footer')

    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

@include('layouts.include.scripts')