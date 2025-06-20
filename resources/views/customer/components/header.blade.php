<div class="container-fluid fixed-top">
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a class="navbar-brand" href="">
                <h1 class="text-primary display-6">Bánh mì Phong Hiền</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                    <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Trang chủ</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Giới thiệu</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="{{ route('content')}}" class="dropdown-item">Về cửa hàng</a>
                            <a href="{{ route('news')}}" class="dropdown-item">Thông tin khác</a>
                        </div>
                    </div>
                    <a href="{{ route('shop') }}" class="nav-item nav-link {{ request()->routeIs('shop') ? 'active' : '' }}">Sản phẩm</a>
                    <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Liên hệ</a>
                    <a href="" class="nav-item nav-link">Chính sách</a>
                </div>
                <div class="d-flex m-3 me-0 position-relative" onmouseover="loadCart()">
                    <a href="" class="position-relative me-4 my-auto cart-icon">
                        <i class="fa fa-shopping-bag fa-2x green-color"></i>
                        <span id="slsp"
                            class="quantity-cart position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-dark px-1">0</span>
                    </a>
                    <div class="position-absolute cart-content shadow p-3 bg-white">
                        <div id="cart-item">
                            <div class="cart-item d-flex align-item-center mb-3">

                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between" id="total">

                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{route('showCart')}}" class="btn btn-primary btn-sm px-4 rounded-pill">
                                Xem giỏ hàng
                            </a>
                            <a href="{{route('checkout')}}" class="btn btn-secondary btn-sm px-4 rounded-pill">
                                Thanh toán
                            </a>
                        </div>
                    </div>
                    <a href="#" class="position-relative my-auto user-icon">
                        <i class="fas fa-user fa-2x green-color"></i>
                    </a>
                    <div class="position-absolute user-content shadow bg-white">
                        @if(Auth::check())
                        <div class="container card" style="width:200px;">
                            <h5>Xin chào {{Auth::user()->tennguoidung}}</h5>
                            <div>
                                <a href="{{route('logout')}}">Đăng xuất</a>
                            </div>
                        </div>
                        @else
                        <div class="user-item">
                            <a href="{{route('login')}}" class="btn d-block text-decoration-none green-color ">Đăng&nbsp;nhập</a>
                            <a href="" class="btn d-block green-color text-decoration-none">Đăng&nbsp;ký</a>
                        </div>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
