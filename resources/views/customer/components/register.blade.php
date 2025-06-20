<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('customer/assets/img/banner-fruits.jpg') }}" class="link-icon">
    <title>Đăng ký</title>
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
                        <h2 class="login-logo text-center d-flex justify-content-center align-items-center">Bánh mì
                            Phong Hiền</h2>
                        <h3 class="login-welcome text-center d-flex justify-content-center align-items-center">Chào mừng
                            bạn đến với bánh mì Phong Hiền</h3>
                        <p
                            class="text-muted mb-4 login-welcome text-center d-flex justify-content-center align-items-center">
                            Hãy nhập thông tin đăng ký tài khoản</p>
                        <form class="login-form" action="{{route('createRegister')}}" method="POST">
                            @csrf
                            <div class="login-form-group">
                                <label class="label text-start d-block">Họ và tên</label>
                                <input type="text" class="login-input form-control"
                                    name="tennguoidung" placeholder="Nhập họ tên đầy đủ ..." required />
                            </div>
                            <div class="login-form-group">
                                <label class="label text-start d-block">Ngày sinh</label>
                                <input type="date" name="ngaysinh" class="login-input form-control" required/>
                            </div>
                            <div class="login-form-group">
                                <label class="label text-start d-block">Địa chỉ</label>
                                <input type="text" class="login-input form-control"
                                    name="diachi" placeholder="Nhập số nhà, tên đường, phường ..." required/>
                                <select name="quan" id="quan" class="login-input form-control" required>
                                    <option value="" disabled selected>Vui lòng chọn quận</option>
                                    <option value="Quận 1">Quận 1</option>
                                    <option value="Quận 3">Quận 3</option>
                                    <option value="Quận 4">Quận 4</option>
                                    <option value="Quận 5">Quận 5</option>
                                    <option value="Quận 6">Quận 6</option>
                                    <option value="Quận 7">Quận 7</option>
                                    <option value="Quận 8">Quận 8</option>
                                    <option value="Quận 10">Quận 10</option>
                                    <option value="Quận 11">Quận 11</option>
                                    <option value="Quận 12">Quận 12</option>
                                    <option value="Quận Tân Bình">Quận Tân Bình</option>
                                    <option value="Quận Tân Phú">Quận Tân Phú</option>
                                    <option value="Quận Bình Tân">Quận Bình Tân</option>
                                    <option value="Quận Bình Thạnh">Quận Bình Thạnh</option>
                                    <option value="Quận Gò Vấp">Quận Gò Vấp</option>
                                    <option value="Quận Phú Nhuận">Quận Phú Nhuận</option>
                                </select>
                            </div>
                            <div class="login-form-group">
                                <label class="label text-start d-block">Giới tính</label>
                                <select name="gioitinh" id="gioitinh" class="login-input form-control" required>
                                    <option value="" disabled selected>Vui lòng chọn giới tính</option>
                                    <option value="1">Nam</option>
                                    <option value="0">Nữ</option>
                                </select>
                            </div>
                            <div class="login-form-group">
                                <label class="label text-start d-block">Số điện thoại</label>
                                <input type="text" name="sodienthoai"  class="login-input form-control" placeholder="Nhập số điện thoại ..." required/>
                            </div>
                            <div class="login-form-group">
                                <label class="label text-start d-block">Email</label>
                                <input type="text" name="email"  class="login-input form-control" placeholder="Nhập email ..." required/>
                            </div>
                            <div class="login-form-group">
                                <label class="label text-start d-block">Mật khẩu</label>
                                <input type="text" name="matkhau"  class="login-input form-control" placeholder="Nhập mật khẩu ..." required/>
                            </div>

                            <button type="submit" class="login-btn">Đăng ký</button>
                            <div class="login-links">
                                <p class="text-muted mb-2">Bạn đã có tài khoản?</p>
                                <a href="{{ route('login') }}" class="login-link d-block mb-2">Đăng nhập</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
