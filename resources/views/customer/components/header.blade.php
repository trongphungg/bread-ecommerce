<div class="container-fluid fixed-top">
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a class="navbar-brand" href="{{ route('home') }}">
                <h1 class="text-primary display-6">Bánh mì Phong Hiền</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('home') }}"
                        class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Trang chủ</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Giới thiệu</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="{{ route('content') }}" class="dropdown-item">Về cửa hàng</a>
                            <a href="{{ route('news') }}" class="dropdown-item">Thông tin khác</a>
                        </div>
                    </div>
                    <a href="{{ route('shop') }}"
                        class="nav-item nav-link {{ request()->routeIs('shop') ? 'active' : '' }}">Sản phẩm</a>
                    <a href="{{ route('contact') }}"
                        class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Liên hệ</a>
                    <a href="{{route('policyView')}}" class="nav-item nav-link">Chính sách</a>
                </div>
                <div class="d-flex m-3 me-0 position-relative">
                    <a href="" class="position-relative me-4 my-auto cart-icon">
                        <i class="fa fa-shopping-bag fa-2x green-color" onmouseover="loadCart()"></i>
                        <span id="slsp"
                            class="quantity-cart position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-dark px-1">0</span>
                    </a>
                    <div class="position-absolute cart-content cart-hover-content shadow p-3 bg-white">
                        <div id="cart-item">
                            <div class="cart-item d-flex align-item-center mb-3">

                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between" id="total">

                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('showCart') }}" class="btn btn-primary btn-sm px-4 rounded-pill">
                                Xem giỏ hàng
                            </a>
                            <a href="{{ route('checkout') }}" class="btn btn-secondary btn-sm px-4 rounded-pill">
                                Thanh toán
                            </a>
                        </div>
                    </div>

                    {{-- Test --}}
                    <a href="" class="position-relative me-4 my-auto cart-icon">
                         <i class="fas fa-user fa-2x text-primary" style="transition: transform 0.2s; transform-origin: center;"></i>
                    </a>
                    <div class="position-absolute user-content cart-hover-content shadow p-3 bg-white">
                        @if(Auth::user())
                                <div class="px-3 py-3 text-muted small text-center border-bottom bg-light">
                                    Xin chào! {{ Auth::user()->tenkhachhang }}
                                </div>
                                <a class="dropdown-item py-3 px-4 d-flex align-items-center hover-bg-light" href="{{route('profileIndex')}}">
                                    <i class="fas fa-user-circle me-3 text-primary"></i>Thông tin</a>
                                <a class="dropdown-item py-3 px-4 d-flex align-items-center hover-bg-light" href="{{route('orderUserIndex')}}">
                                    <i class="fas fa-shopping-bag me-3 text-primary"></i>Đơn hàng</a>
                                <a class="dropdown-item py-3 px-4 d-flex align-items-center hover-bg-light" href="{{route('orderUserHistory')}}">
                                    <i class="fas fa-history me-3 text-primary"></i>Lịch sử mua hàng</a>
                                <a class="dropdown-item py-3 px-4 d-flex align-items-center text-danger hover-bg-danger-light" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt me-3"></i>Đăng xuất</a>
                                @else
                                <a class="dropdown-item py-3 px-4 d-flex align-items-center hover-bg-light" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-3 text-primary"></i>Đăng nhập</a>
                                <a class="dropdown-item py-3 px-4 d-flex align-items-center hover-bg-light" href="{{ route('register') }}">
                                    <i class="fas fa-sign-in-alt me-3 text-primary"></i>Đăng ký</a>
                                @endif
                    </div>
                    {{-- Endtest --}}

                    {{-- <div>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle user-dropdown-toggle d-flex align-items-center" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user fa-2x text-primary" style="transition: transform 0.2s; transform-origin: center;"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow-lg border-0" aria-labelledby="userDropdown" style="min-width: 250px; margin-top: 0.5rem; border-radius: 12px; overflow: hidden;">
                                @if(Auth::user())
                                <div class="px-3 py-3 text-muted small text-center border-bottom bg-light">
                                    Xin chào! {{ Auth::user()->tenkhachhang }}
                                </div>
                                <a class="dropdown-item py-3 px-4 d-flex align-items-center hover-bg-light" href="{{route('profileIndex')}}">
                                    <i class="fas fa-user-circle me-3 text-primary"></i>Thông tin</a>
                                <a class="dropdown-item py-3 px-4 d-flex align-items-center hover-bg-light" href="{{route('orderUserIndex')}}">
                                    <i class="fas fa-shopping-bag me-3 text-primary"></i>Đơn hàng</a>
                                <a class="dropdown-item py-3 px-4 d-flex align-items-center hover-bg-light" href="{{route('orderUserHistory')}}">
                                    <i class="fas fa-history me-3 text-primary"></i>Lịch sử mua hàng</a>
                                <a class="dropdown-item py-3 px-4 d-flex align-items-center text-danger hover-bg-danger-light" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt me-3"></i>Đăng xuất</a>
                                @else
                                <a class="dropdown-item py-3 px-4 d-flex align-items-center hover-bg-light" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-3 text-primary"></i>Đăng nhập</a>
                                <a class="dropdown-item py-3 px-4 d-flex align-items-center hover-bg-light" href="{{ route('register') }}">
                                    <i class="fas fa-sign-in-alt me-3 text-primary"></i>Đăng ký</a>
                                @endif
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
    </div>
    </nav>
</div>
</div>
