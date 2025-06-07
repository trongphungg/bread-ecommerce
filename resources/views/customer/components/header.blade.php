<div class="container-fluid fixed-top">
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a class="navbar-brand" href="">
                <h1 class="green-color display-6">Bánh mì Phong Hiền</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars green-color"></span>
            </button>
            <div class="collapse navbar-collapse bg-white">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('home') }}" class="nav-item nav-link">Trang chủ</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Giới thiệu</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="{{ route('content') }}" class="dropdown-item">Về cửa hàng</a>
                            <a href="chackout.html" class="dropdown-item">Thông tin khác</a>
                        </div>
                    </div>
                    <a href="{{ route('shop') }}" class="nav-item nav-link">Sản phẩm</a>
                    <a href="{{ route('contact') }}" class="nav-item nav-link">Liên hệ</a>
                    <a href="" class="nav-item nav-link">Chính sách</a>
                </div>
                <div class="d-flex m-3 me-0 " onmouseover="loadCart()">
                    <a href="" class="position-relative me-4 my-auto cart-icon">
                        <i class="fa fa-shopping-bag fa-2x green-color"></i>
                        <span id="slsp"
                            class="quantity-cart position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-dark px-1">3</span>
                    </a>
                    <div class="position-absolute cart-content shadow p-3 bg-white">
                        <div id="cart-item">
                            <div class="cart-item d-flex align-item-center mb-3">

                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between" id="total">

                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="btn border-warning green-color rounded-pill">
                                Xem giỏ hàng
                            </div>
                            <div class="btn border-success orange-color rounded-pill">
                                Thanh toán
                            </div>
                        </div>
                    </div>
                    <a href="#" class="my-auto position-relative user-icon">
                        <i class="fas fa-user fa-2x green-color"></i>
                    </a>
                    <div class="position-absolute user-content shadow bg-white">
                        <div class="user-item">
                            <a href="" class="btn text-decoration-none green-color ">Đăng&nbsp;nhập</a>
                            <br>
                            <a href="" class="btn d-flex alig-items-center green-color text-decoration-none">Đăng&nbsp;ký</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
