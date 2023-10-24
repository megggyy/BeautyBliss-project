<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<style>
    .btn-pink {
    color: white; /* Set the text color to contrast with the button color */
    background-color: rgb(188, 123, 137); /* Set the desired pink color */
    border-color: rgb(155, 102, 111); /* Set the border color */
    padding: 6.8px 20px; /* Increase padding to adjust button size */
        font-size: 16px; /* Increase font size to adjust button text size */
    }
    .form-group {
        position: relative;
        display: flex; /* Add this to use flexbox for alignment */
        align-items: flex-start; /* Align items to the start of the flex container */
    }
    .form-control {
        flex-grow: 1; /* Allow input to grow and take available space */
    }
    #productList {
        position: absolute;
        width: 100%;
        max-height: 200px; /* Set max height for dropdown */
        overflow-y: auto; /* Enable vertical scrolling if content exceeds max height */
        background-color: rgb(255, 185, 198);
        border: 1px solid #ccc;
        border-top: none; /* Remove top border to separate from search box */
        display: none; /* Initially hide the dropdown */
        z-index: 2; /* Increase the z-index to position above other elements */
        top: 100%;
        pointer-events: auto; 
    }
    #productList ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    #productList li {
        padding: 8px 10px;
        cursor: pointer;
    }
    #productList li:hover {
        background-color: #f0f0f0;
    }
</style>
<div class="container-fluid">
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="{{('/')}}" class="text-decoration-none">
                <h3 class="m-0 display-5 font-weight-semi-bold">
                    <span>
                        <img src="img/logo.png" alt="Luminous Looks Logo" height="50">
                    </span>
                    <span class="text-primary font-weight-bold border px-6 ml-2">Beauty
                    </span>Bliss
                </h3>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <form action="{{ route('search') }}" method="GET" id="searchForm">
                @csrf <!-- Add this line to include the CSRF token -->
                <div class="form-group">
                    <input class="form-control" type="search" placeholder="Search for products" name="search" id="name" autocomplete="off">
                    <div id="productList"></div> <!-- Move this inside the form group -->
                    <button class="btn-pink my-2 my-sm-0" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="{{ url('wishlist') }}" class="btn border">
                <i class="fas fa-heart text-primary"></i> Wishlist (<livewire:frontend.wishlist-count />)
            </a>
            <a href="{{url('cart')}}" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i> Cart (<livewire:frontend.cart.cart-count />)
                {{-- <span class="badge"></span> --}}
            </a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
     
        $('#name').keyup(function(){ 
            var query = $(this).val(); 
            if(query != '')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('autocomplete.fetch') }}",
                    method:"POST",
                    data:{query:query, _token:_token},
                    success:function(data){
                    $('#productList').fadeIn();  
                        $('#productList').html(data);
                    }
                });
            }
        });
     
          // Event handler for input value changes
          $('#name').on('input', function() {
            if ($(this).val() === '') {
                $('#productList').fadeOut();
            }
        });
        $(document).on('click', '#productList li', function(){  
            var clickedText = $(this).text();
            $('#name').val(clickedText);
            $('#productList').fadeOut();
            $('#searchForm').submit(); // Submit the form to perform the search
        });
     
    });
    </script>
