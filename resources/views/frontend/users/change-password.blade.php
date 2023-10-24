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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="frontend/css/style.css" rel="stylesheet">
</head>

<body>
@include('frontend.topbar')
<div style="display: flex; justify-content: center;">
<nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
    <a href="" class="text-decoration-none d-block d-lg-none">
        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav mr-auto py-0">
            <a href="{{ url('/')}}" class="nav-item nav-link active">Home</a>
            <a href="{{ url('/')}}" class="nav-item nav-link">Shop</a>
            <a href="{{ url('/collections')}}" class="nav-item nav-link">Categories</a>
            <a href="{{ url('/new-arrivals')}}" class="nav-item nav-link">New Arrivals</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                    <a href="checkout.html" class="dropdown-item">Checkout</a>
                </div>
            </div>
            <a href="contact.html" class="nav-item nav-link">Contact</a>
        </div>
        {{-- <div class="navbar-nav ml-auto py-0">
            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
            <a href="" class="nav-item nav-link">Register</a>
        </div> --}}
    </div>
</nav>
</div>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                @if (session('message'))
                    <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
                @endif

                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h4 class="mb-0 text-white">Change Password
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('change-password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Current Password</label>
                                <input type="password" name="current_password" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <hr>
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                            <div class="mb-3 text-end">
                                <hr>
                                <a href="{{url('profile')}}" class="btn btn-danger float-end">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('frontend.footer')

@section('script')
<script>
    $('.trending-product').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>
@endsection

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="frontend/lib/easing/easing.min.js"></script>
    <script src="frontend/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="frontend/mail/jqBootstrapValidation.min.js"></script>
    <script src="frontend/mail/contact.js"></script>

    <!-- Owl Carousel -->
    <script src="admin/assets/js/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="frontend/js/main.js"></script>
    @yield('script')
</body>
</html>
