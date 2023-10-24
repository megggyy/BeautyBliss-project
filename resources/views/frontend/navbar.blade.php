<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown">Face <i class="fa fa-angle-down float-right mt-1"></i></a>
                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            <a href="{{ url('collections/foundation')}}" class="dropdown-item">Foundation</a>
                            <a href="{{ url('collections/blushes')}}" class="dropdown-item">Blushes</a>
                            <a href="{{ url('collections/highlighter')}}" class="dropdown-item">Highlighter</a>
                        </div>
                    </div>
                    <a href="{{ url('collections/eyeshadow')}}" class="nav-item nav-link">Eyeshadow</a>
                    <a href="{{ url('collections/liptint')}}" class="nav-item nav-link">Liptint</a>
                    <a href="{{ url('collections/mascara')}}" class="nav-item nav-link">Mascara</a>
                    <a href="{{ url('collections/eyeliner')}}" class="nav-item nav-link">Eyeliner</a>
                    <a href="{{ url('collections/face-powder')}}" class="nav-item nav-link">Powder</a>
                    <a href="{{ url('collections/bronzer')}}" class="nav-item nav-link">Contour</a>
                    <a href="{{ url('collections/eyebrow-pencil')}}" class="nav-item nav-link">Brow</a>
                    <a href="{{ url('collections/lipstick')}}" class="nav-item nav-link">Lipstick</a>
                    <a href="{{ url('collections/lip-liner')}}" class="nav-item nav-link">Lipgloss</a>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Beauty</span>Bliss</h1>
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
            <div id="header-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="height: 410px;">
                        <img class="img-fluid" src="img/maybellinebanner.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">Beauty</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Bliss</h3>
                                <a href="{{ url('/collections')}}" class="btn btn-light py-2 px-3">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="height: 410px;">
                        <img class="img-fluid" src="img/fentybeauty.webp" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">Beauty Products</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                                <a href="{{ url('/collections')}}" class="btn btn-light py-2 px-3">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="height: 410px;">
                     <img class="img-fluid" src="img/nars.jpg" alt="Image">
                     <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                         <div class="p-3" style="max-width: 700px;">
                             <h4 class="text-light text-uppercase font-weight-medium mb-3">Shop for a</h4>
                             <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                             <a href="{{ url('/collections')}}" class="btn btn-light py-2 px-3">Shop Now</a>
                         </div>
                     </div>
                 </div>
                    <div class="carousel-item" style="height: 410px;">
                     <img class="img-fluid" src="img/benefit.jpg" alt="Image">
                     <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                         <div class="p-3" style="max-width: 700px;">
                             <h4 class="text-light text-uppercase font-weight-medium mb-3">Take a look</h4>
                             <h3 class="display-4 text-white font-weight-semi-bold mb-4">NOW!</h3>
                             <a href="{{ url('/collections')}}" class="btn btn-light py-2 px-3">Shop Now</a>
                         </div>
                     </div>
                 </div>
                </div>
                
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-prev-icon mb-n2"></span>
                    </div>
                </a>
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                 <div class="btn btn-dark" style="width: 45px; height: 45px;">
                     <span class="carousel-control-prev-icon mb-n2"></span>
                 </div>
             </a>
             <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                 <div class="btn btn-dark" style="width: 45px; height: 45px;">
                     <span class="carousel-control-prev-icon mb-n2"></span>
                 </div>
             </a>
                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-next-icon mb-n2"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
 </div>
 