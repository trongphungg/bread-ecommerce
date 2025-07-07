<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('customer/assets/img/banner-fruits.jpg') }}" class="link-icon">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{ asset('customer/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/bootstrap.min.css') }}">
</head>
<body class="login-page">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="login-box">
                    <div class="text-center">
                        <h2 class="login-logo text-center d-flex justify-content-center align-items-center">Bánh mì Phong Hiền</h2>
                        <h3 class="login-welcome text-center d-flex justify-content-center align-items-center">Chào mừng bạn đến với bánh mì Phong Hiền</h3>
                        <p class="text-muted mb-4 login-welcome text-center d-flex justify-content-center align-items-center">Hãy nhập thông tin đăng nhập</p>
                        <form class="login-form" role="form" 
                        action="{{route('handleLogin')}}" 
                        method="POST">
                            @csrf
                            <div class="login-form-group">
                                <input type="text" 
                                class="login-input form-control" 
                                placeholder="Nhập email ..." 
                                name="email" 
                                value="{{ old('email') }}">
                            </div>
                            @if($errors->has('email'))
                                <span class="login-alert fs-6">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif

                            <div class="login-form-group">
                                <input type="password" 
                                class="login-input form-control" 
                                placeholder="Nhập mật khẩu ..." 
                                name="password">
                            </div>

                            @if($errors->has('password'))
                                <span class="login-alert fs-6">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                            <button type="submit" class="login-btn">Đăng nhập</button>
                            @if($errors->has('google_login'))
                                <span class="login-alert fs-6">
                                    {{ $errors->first('google_login') }}
                                </span>
                            @endif
                            <div class="login-links">
                                <p class="text-muted mb-2">Bạn chưa có tài khoản?</p>
                                <a href="{{route('register')}}" class=" login-link d-block mb-2">Đăng ký</a>
                                <a href="{{route('google.login')}}" class="login-link inline-block px-3 py-2 ">
                                    <img src="{{ asset('customer/assets/img/google.png') }}" style="width:20px;" />
                                    Đăng nhập với Google
                                </a>
                                <a href="" class="mb-2 login-link inline-block px-3 py-2 ">
                                    <img src="{{ asset('customer/assets/img/facebook.png') }}" style="width:20px;"/>
                                    Đăng nhập với Facebook(Coming soon)
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>