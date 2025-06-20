@extends('customer.components.layout')
@section('content')
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h1 class="mb-5 display-3 green-color">Tươi ngon trong từng lát bánh</h1>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="customer/assets/img/hero-img-1.png"
                                    class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Bánh mì</a>
                            </div>
                            <div class="carousel-item rounded">
                                <img src="customer/assets/img/hero-img-2.png" class="img-fluid w-100 h-100 rounded"
                                    alt="Second slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Bánh bao</a>
                            </div>
                            <div class="carousel-item rounded">
                                <img src="customer/assets/img/hero-img-3.png" class="img-fluid w-100 h-100 rounded"
                                    alt="Second slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Hamburger</a>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero end -->


    <!-- Bestsaler Product Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                <h1 class="display-4">Sản phẩm của chúng tôi</h1>
                <p>Bánh mì thơm ngon, đa dạng hương vị, được làm từ nguyên liệu tươi mới mỗi ngày. 
                    Thưởng thức sự hoàn hảo trong từng ổ bánh!</p>
            </div>
            <div class="row g-4">
                @foreach($dsbm as $bm)
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="{{asset('customer/assets/img/'.$bm->hinh)}}" class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5 text-decoration-none">{{$bm->tensanpham}}</a>
                                <p class="mb-3">Số lượng: {{$bm->soluong}}</p>
                                <h5 class="mb-3">{{ number_format($bm->dongia, 0, ',', '.') }} VNĐ</h5>
                                <a href="#" class="btn border border-secondary green-color rounded-pill px-3 text-primary"><i
                                        class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach($dsbb as $bb)
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="text-center">
                        <img src="{{asset('customer/assets/img/'.$bb->hinh)}}" class="img-fluid rounded" alt="">
                        <div class="py-4">
                            <a href="#" class="h5 text-decoration-none">{{$bb->tensanpham}}</a>
                            <p class="mb-3">Số lượng: {{$bm->soluong}}</p>
                            <h5 class="mb-3">{{ number_format($bm->dongia, 0, ',', '.')}} VNĐ</h5>
                            <a href="#" class="btn border border-secondary text-primary rounded-pill px-3"><i
                                        class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Bestsaler Product End -->

            <!-- Fact Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="bg-light p-5 rounded">
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>satisfied customers</h4>
                                <h1>1963</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>quality of service</h4>
                                <h1>99%</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>quality certificates</h4>
                                <h1>33</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>Available Products</h4>
                                <h1>789</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fact Start -->


        <!-- Start opinion -->
        <div class="container-fluid testimonial py-5">
            <div class="container py-5">
                <div class="testimonial-header text-center">
                    <h4 class="green-color">Lời chứng thực của chúng tôi</h4>
                    <h1 class="display-5 mb-5 text-dark">Khách hàng của chúng tôi nói !!</h1>
                </div>
                <div class="owl-carousel testimonial-carousel">
                    @foreach($dsyk as $yk)
                    <div class="testimonial-item img-border-radius bg-light rounded p-4">
                        <div class="position-relative">
                            <i class="fa fa-quote-right fa-2x orange-color position-absolute" style="bottom: 30px; right: 0;"></i>
                            <div class="mb-4 pb-4 border-bottom border-secondary">
                                <p class="mb-0">
                                    {{$yk->mota}}
                                </p>
                            </div>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="bg-secondary rounded">
                                    <img src="{{asset('customer/assets/img/'.$yk->hinh)}}" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                                </div>
                                <div class="ms-4 d-block">
                                    <h4 class="text-dark">{{$yk->tenkhachhang}}</h4>
                                    <p class="m-0 pb-3">{{$yk->nghenghiep}}</p>
                                    <div class="d-flex pe-5">
                                        @php
                                        for($i = 0;$i<$yk->sodiem;$i++){
                                            echo "<i class='fas fa-star green-color'></i>";
                                        }
                                        for($i= 0;$i<5-$yk->sodiem;$i++){
                                            echo " <i class='fas fa-star'></i>";
                                        }
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End opinion -->

        
@endsection
