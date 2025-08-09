@extends('customer.components.layout')
@section('content')

<div id="toast">

</div>
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white ">Chi tiết sản phẩm</h1>
    </div>
        <div id="toast" >
    </div>
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
                <div id="productForm">
                    <form id="form{{ $sanpham->idsanpham }}">
                        <div class="row g-4">
                            <input type="hidden" value="{{ $sanpham->idsanpham }}" id="productId">
                            <div class="col-lg-6">
                                <div class="border rounded">
                                    <a href="#">
                                        <img src="{{ asset('customer/assets/img/' . $sanpham->hinh) }}" id="productImage"
                                            class="img-fluid rounded" alt="Image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="fw-bold mb-3" id="productName">{{ $sanpham->tensanpham }}</h4>
                                <h5 class="fw-bold mb-3" id="productPrice">
                                    {{ number_format($sanpham->dongia, 0, ',', '.') }}
                                    VNĐ</h5>
                                <div class="d-flex mb-4">
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                {{-- <p class="mb-3">Số lượng: {{ $sanpham->soluong }}</p> --}}
                                <p class="mb-4">{{ $sanpham->motasanpham }}</p>
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input id="productQuantity" type="text"
                                        class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                {{-- Nút thêm vào giỏ --}}
                                    <button type="submit"
                                        class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ hàng
                                    </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Tabs đánh giá --}}
                <div class="col-lg-12 mt-5">
                    <nav>
                        <div class="nav nav-tabs mb-3">
                            <button class="nav-link active border-white border-bottom-0" type="button" role="tab">Đánh
                                giá</button>
                        </div>
                    </nav>
                    {{-- Đánh giá --}}
                    <div class="tab-content mb-5">
                        <div class="tab-pane active" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                            <!-- mở tab-pane -->
                            @foreach ($dsdg as $d)
                                @if ($d->trangthaidg == 1)
                                    <div class="d-flex mb-4 border-bottom pb-3">
                                        <img src="{{ asset('customer/assets/img/avatar.jpg') }}"
                                            class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;"
                                            alt="">
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="mb-0">{{ $d->khachhang->tenkhachhang }}</h5>
                                                <div>
                                                    @for ($i = 0; $i < $d->sodiem; $i++)
                                                        <i class="fas fa-star text-warning me-1"></i>
                                                    @endfor
                                                    @for ($i = 0; $i < 5 - $d->sodiem; $i++)
                                                        <i class="fas fa-star text-secondary me-1"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="mb-0" style="font-size: 15px;">{{ $d->danhgia }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    {{-- Kết thúc đánh --}}

                </div>
                @if (Auth::check())
                    <form id="reviewForm" action="{{ route('createReview') }}" method="POST">
                        @csrf
                        <input type="hidden" name="idsanpham" value="{{ $sanpham->idsanpham }}" />
                        <input type="hidden" name="idnguoidung" value="{{ Auth::user()->idkhachhang }}" />

                        <h4 class="mb-4 fw-bold">Để lại đánh giá về sản phẩm của bạn</h4>

                        <div class="border-bottom rounded my-4">
                            <textarea name="danhgia" class="form-control border-0" rows="6" placeholder="Viết đánh giá ..." required></textarea>
                        </div>

                        <div class="d-flex justify-content-between align-items-center py-3 mb-5">
                            <div class="d-flex align-items-center">
                                <p class="mb-0 me-3">Cho điểm</p>
                                <input type="hidden" name="sodiem" id="sodiem" value="0" />
                                <div class="d-flex align-items-center" style="font-size: 20px;" id="star-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star text-muted star" data-value="{{ $i }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <button type="submit"
                                class="btn border border-secondary text-primary rounded-pill px-4 py-3">
                                Đánh giá
                            </button>
                        </div>
                    </form>
                @endif
            </div>

            <div class="col-lg-4 col-xl-3">
                <div class="row g-4 fruite">
                    <div class="col-lg-12">
                        <h4 class="mb-4">Sản phẩm bán chạy</h4>
                        @foreach ($dssp as $sp)
                            <a href="{{ route('detail', $sp->idsanpham) }}" class="text-decoration-none">
                                <div class="d-flex align-items-center justify-content-start py-1">
                                    <div class="rounded" style="width: 100px; height: 100px;">
                                        <img src="{{ asset('customer/assets/img/' . $sp->hinh) }}"
                                            class="img-fluid rounded" alt="Image">
                                    </div>
                                    <div class="mx-2">
                                        <h6 class="mb-2">{{ $sp->tensanpham }}</h6>
                                        <div class="d-flex mb-2">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-black"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">{{ number_format($sp->dongia, 0, ',', ',') }} VNĐ
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                        <div class="d-flex justify-content-center my-4">
                            <a href="{{ route('shop') }}"
                                class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">
                                Xem thêm
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    let successMessage = @json(session('success'));
    if (successMessage) {
        showSuccessToast(successMessage);
    }
    let errorMessage = @json(session('error'));
    if (errorMessage) {
        showErrorToast(errorMessage);
    }
});
</script>      
@endsection
