@extends('customer.components.layout')
@section('content')
<div>
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white ">Giới thiệu cửa hàng</h1>
        </div>
        <div class="container py-5">
            @foreach ($dstt as $content)
                    <div class="row align-items-center mb-5">
                        @if ($loop->iteration % 2 == 1)
                            <div class="col-lg-6 mb-4 mb-lg-0 animate__animated">
                                <div class="rounded-3 overflow-hidden h-100">
                                    <img src="{{ asset('customer/assets/img/' . $content->hinhanh) }}"
                                        class="img-fluid w-100 h-100 object-fit-cover" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6 animate__animated ">
                            @else
                                <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0 animate__animated">
                                    <div class="rounded-3 overflow-hidden h-100">
                                        <img src="{{ asset('customer/assets/img/' . $content->hinhanh) }}"
                                            class="img-fluid w-100 h-100 object-fit-cover" alt="About Us">
                                    </div>
                                </div>
                                <div class="col-lg-6 order-lg-1 animate__animated">
                        @endif
                        <h1 class="fw-bold mb-4">{{ $content->tieude }}</h1>
                        <div class="text-muted mb-4">{{ $content->mota }}</div>
                        <div class="row g-4 mb-4">
                            <div class="col-sm-6">
                                <div class="feature-box d-flex align-items-center p-3 border rounded-3 h-100">
                                    <i class="fas fa-shield-alt text-primary fa-2x me-3"></i>
                                    <div>
                                        <h5 class="mb-1">Sản phẩm chất lượng</h5>
                                        <span class="text-muted small">Đảm bảo uy tín</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="feature-box d-flex align-items-center p-3 border rounded-3 h-100">
                                    <i class="fas fa-shipping-fast text-primary fa-2x me-3"></i>
                                    <div>
                                        <h5 class="mb-1">Giao hàng nhanh chóng</h5>
                                        {{-- <span class="text-muted small">Trên toàn quốc</span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        @endforeach
</div>
@endsection
