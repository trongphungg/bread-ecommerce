<div class="container-fluid fixed-top">
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a class="navbar-brand" href="">
                <h1 class="green-color display-6">Bánh mì Phong Hiền</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars green-color"></span>
                    </button>
            <div class="collapse navbar-collapse bg-white">
                <div class="navbar-nav mx-auto">
                    <a href="{{route('home')}}" class="nav-item nav-link">Trang chủ</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Giới thiệu</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="cart.html" class="dropdown-item">Về cửa hàng</a>
                            <a href="chackout.html" class="dropdown-item">Thông tin khác</a>
                        </div>
                    </div>
                    <a href="{{route('shop')}}" class="nav-item nav-link">Sản phẩm</a>
                    <a href="{{route('contact')}}" class="nav-item nav-link">Liên hệ</a>
                    <a href="" class="nav-item nav-link">Chính sách</a>
                </div>
                <div class="d-flex m-3 me-0 ">
                        <a href="" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x green-color"></i>
                            <span class="quantity-cart position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-dark px-1">3</span>
                        </a>
                        <a href="#" class="my-auto">
                            <i class="fas fa-user fa-2x green-color"></i>
                        </a>
                    </div>
            </div>
        </nav>
    </div>
</div>
