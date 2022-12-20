<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng Nhập</title>

    <link rel="stylesheet" href="/css/login/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="/css/login/css/style.css">
</head>
<body>

    <div class="main">
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="/master/img/gallery/gallery-4.jpg" alt="sing up image"></figure>
                        <a href="#signup" class="signup-image-link">Tạo tài khoản mới</a>
                        <a href="{{route("shop.homepage")}}" class="signup-image-link">-> Quay Về Trang Chủ</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Đăng Nhập</h2>
                        <form action="{{URL::to('/checkout/signin')}}" method="POST" class="register-form" id="login-form">
                            @csrf
                            <div class="form-group">
                                <label for="your_email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="your_email" id="your_email" placeholder="Email"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="your_pass" id="your_pass" placeholder="Mật Khẩu"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Ghi Nhớ Đăng Nhập</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Đăng Nhập"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Hoặc đăng nhập với</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="{{url('/checkout/login-google')}}"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Đăng Ký</h2>
                        <form action="{{URL::to('/checkout/signup')}}" method="POST" class="register-form" id="register-form">
                            @csrf
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Họ Tên" value="{{old('name')}}"/>
                                @error('name')
                                <span style="color: red;">{{$message}}</span>
                                 @enderror
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="cus_email" id="cus_email" placeholder="Email" value="{{old('cus_email')}}"/>
                                @error('cus_email')
                                <span style="color: red;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                                <input type="phone" name="phone" id="phone" placeholder="Số Điện Thoại" value="{{old('phone')}}"/>
                                @error('phone')
                                <span style="color: red;">{{$message}}</span>
                             @enderror
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Mật Khẩu" autocomplete="current-password"/>
                                @error('password')
                                <span style="color: red;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="confirm password"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" id="password" name="password_confirmation" placeholder="Lặp Lại Mật Khẩu">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>Tôi đồng ý với <a href="#" class="term-service">các điều khoản </a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Đăng ký"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="/master/img/gallery/gallery-3.jpg" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link">Tôi đã là thành viên!</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sing in  Form -->
        
    </div>

    <script src="/css/login/vendor/jquery/jquery.min.js"></script>
    <script src="/css/login/js/main.js"></script>
</body>
</html>