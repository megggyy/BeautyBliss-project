<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Beauty Bliss</title>
    <link rel="stylesheet" href="frontend/css/login.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
        <div class="front">
            <img src="frontend/images/gigilogin.webp" alt=""> 
            <div class="text">
                <span class="text-1">Your newest beauty<br>adventure</span>
                <span class="text-2">Start your journey</span>
            </div>
        </div>
        <div class="back">
            <!--<img class="backImg" src="images/backImg.jpg" alt="">-->
            <div class="text">
                <span class="text-1">Complete miles of journey <br> with one step</span>
                <span class="text-2">Let's get started</span>
            </div>
        </div>
    </div>
    <div class="forms">
        <div class="form-content">
            <div class="login-form">
                <div class="title">Register</div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-boxes">
                        <div class="input-box">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="Enter your name" name="name" value="{{ old('name') }}" required autofocus>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <input type="email" placeholder="Enter your email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Enter your password" name="password" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Confirm your password" name="password_confirmation" required>
                        </div>
                        <div class="text">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="button input-box">
                            <input type="submit">Register</button>
                        </div>
                        <div class="text sign-up-text">Already have an account? <a href="{{ route('login') }}">Login now</a></div>
                    </div>
                </form>
            </div>
            {{-- <div class="signup-form">
                <div class="title">Signup</div>
                <form action="#">
                    <!-- Your signup form content goes here -->
                </form>
            </div> --}}
        </div>
    </div>
</div>
</body>
</html>
