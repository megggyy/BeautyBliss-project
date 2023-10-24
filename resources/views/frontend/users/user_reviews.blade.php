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
    <div class="container">
        <h1>Your Reviews</h1>
        @if($reviews->isEmpty())
            <p>You have no reviews yet.</p>
        @else
            <div class="row">
                @foreach($reviews as $review)
                    <div class="col-md-6">
                        <div class="comment-section">
                        <div class="card-body">
                            <div class="card2 p-3">
                                <div class="review">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="user d-flex flex-row align-items-center">
                                                    @php
                                                    try {
                                                        $customerImages = Auth::user()->customer->images ?? [];
                                                        $firstImage = isset($customerImages[0]) ? $customerImages[0] : '';
                                                        $imagePath = $firstImage ? asset('storage/' . $firstImage) : null;
                                                    } catch (\Exception $e) {
                                                        $imagePath = null;
                                                    }
                                                @endphp
                                                @if ($imagePath)
                                                    <br>
                                                    <img src="{{ $imagePath }}" alt="Customer Image" class="user-img rounded-circle mr-2" width="50px">
                                                @else
                                                    <p>No customer image available.</p>
                                                @endif
                                            <span>
                                                <small
                                                    class="font-weight-bold text-primary">{{ $review->user->name }}</small>
                                            </span>
                                        </div>
                                        @if (Auth::check() && Auth::user()->id)
                                            <div class="review-actions">
                                                <a href="{{ route('review.edit', ['id' => $review->user->id]) }}"
                                                    data-toggle="modal"
                                                    data-target="#editModal{{ $review->id }}"
                                                    class="edit-review">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form id="delete-form-{{ $review->review_id }}"
                                                    action="{{ route('review.destroy', ['id' => $review->review_id]) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-link text-danger delete-review-button"
                                                        onclick="return confirm('Are you sure you want to delete this review?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            {{-- modal --}}
                                            <div class="modal fade" id="editModal{{ $review->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="editModalLabel{{ $review->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $review->id }}">Edit Review</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('review.update', ['id' => $review->product_id, 'product_id' => $review->review_id]) }}"
                                                                method="POST" autocomplete="off">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="rating">Rating</label>
                                                                    <br>
                                                                    <div class="col">
                                                                        <div class="rate">
                                                                            <input type="radio" id="star5-{{ $review->id }}" class="rate"
                                                                                name="rating" value="5" />
                                                                            <label for="star5-{{ $review->id }}" title="Excellent">☆☆☆☆☆</label>
                                        
                                                                            <input type="radio" id="star4-{{ $review->id }}" class="rate"
                                                                                name="rating" value="4" />
                                                                            <label for="star4-{{ $review->id }}" title="Good">☆☆☆☆</label>
                                        
                                                                            <input type="radio" id="star3-{{ $review->id }}" class="rate"
                                                                                name="rating" value="3" />
                                                                            <label for="star3-{{ $review->id }}" title="Average">☆☆☆</label>
                                        
                                                                            <input type="radio" id="star2-{{ $review->id }}" class="rate"
                                                                                name="rating" value="2" />
                                                                            <label for="star2-{{ $review->id }}" title="Below Average">☆☆</label>
                                        
                                                                            <input type="radio" id="star1-{{ $review->id }}" class="rate"
                                                                                name="rating" value="1" />
                                                                            <label for="star1-{{ $review->id }}" title="Poor">☆</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="form-group">
                                                                    <br>
                                                                    <label for="comment">Comment</label>
                                                                    <br>
                                                                    <textarea class="form-control" id="comment" name="comment" rows="4">{{ $review->comment }}</textarea>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- end modal --}}
                                        @endif
                                    </div>

                                    <span>
                                        @foreach ($review->product_images as $image)
                                            <img src="{{ $image->image }}" width="30"
                                                class="user-img rounded-circle mr-2">
                                        @endforeach
                                        <small
                                            class="font-weight-bold text-primary">{{ $review->product->name }}</small>
                                    </span>
                                    <div class="review-details">
                                        <div class="star-rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rate)
                                                    <i class="fas fa-star filled"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <p class="review-comment">{{ $review->comment }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@include('frontend.footer')

@section('script')
    <script>
        $('.trending-product').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
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

