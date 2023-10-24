<!DOCTYPE html>
<html>
  <head>
    <title>Product Details</title>
    <style>
      * {
        box-sizing: border-box;
      }

      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
      }

      .product-details {
        display: flex;
        flex-direction: row;
        margin: 50px;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(148, 0, 30, 0.1);
      }

      .product-image {
        width: 50%;
        padding: 50px;
      }

      .product-image img {
        display: block;
        max-width: 100%;
        height: auto;
      }

      .product-info {
        width: 50%;
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }

      .product-name {
        font-size: 36px;
        font-weight: bold;
        margin: 0;
        color: #333;
      }

      .product-description {
        font-size: 18px;
        color: #777;
        margin: 20px 0;
      }

      .product-price {
        font-size: 24px;
        font-weight: bold;
        margin: 0;
        color: #333;
      }

      .product-discounted-price {
        font-size: 20px;
        color: #777;
        margin: 0;
        text-decoration: line-through;
      }

      .product-category {
        font-size: 18px;
        color: #777;
        margin: 20px 0;
      }

      label {
        font-size: 18px;
        color: #333;
        margin-right: 10px;
      }

      input[type="number"] {
        width: 50px;
        font-size: 18px;
        color: #333;
        text-align: center;
      }

      button {
        background-color: #d8858d;
        color: #fff;
        font-size: 24px;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
      }

      button:hover {
        background-color: #a66f6f;
      }
    </style>
    <base href="/public">

 <!-- Favicon -->
 <link href="img/logo.png" rel="icon">

 <!-- Google Web Fonts -->
 <link rel="preconnect" href="https://fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

 <!-- Font Awesome -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

 <!-- Libraries Stylesheet -->
 <link href="home/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

 <!-- Customized Bootstrap Stylesheet -->
 <link href="home/css/style.css" rel="stylesheet">
</head>
  <br><br>
  <body>
        <!-- Topbar Start -->
        @include('home.topbar')
        <!-- Topbar End -->
    
	<div class="product-details">
		<div class="product-image">
			<img src="product/{{$product->image}}" width="65%" alt="Product Image">
		</div>
		<div class="product-info">
			<h1 class="product-name">{{$product->title}}</h1>
			<p class="product-desc">{{$product->description}}</p>
            {{-- @if($product->discount_price!=null)

            <p class="product-price">Discounted Price:{{$product->discount_price}}</p>

             @endif
			
			<p class="product-discounted-price">Original Price:{{$product->price}}</p> --}}
            <div class="d-flex justify-content">
                <h6>₱{{$product->price}}</h6><h6 class="text-muted ml-2">
                 @if($product->discount_price!=null)

                 <del>₱{{$product->discount_price}}</del>

                  @endif
             </h6>
            </div>
			<p class="product-category">Category: {{$product->category}}</p>
			<label for="quantity">Stock: {{$product->quantity}}</label>
			{{-- <input type="number" id="quantity" name="quantity" min="1" max="10"><br> --}}
			<div class="product-buttons">
        <form action="{{url('add_cart',$product->id)}}" method="Post">
          @csrf
          <p>Quantity: <input type="number" name="quantity" value="1" style="width: 40px; font-size: 18px; padding: 3px;"></p>
          <button class="add-to-cart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
         {{-- <input type="number" name="quantity" value="1" min="1" style="width: 50px"> --}}
         <button class="add-to-wishlist"><i class="far fa-heart"></i> Add to Wishlist</button>
         </form>
				
				
			</div>
      
		</div>
	</div>
</body>
</html>