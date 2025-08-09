@extends('customer.components.layout')
@section('content')
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div id="toast">
            </div>
            <h1 class="mb-4">Chi tiết thanh toán</h1>
            <form action="" id="paymentForm" method="POST">
                @csrf
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="form-item w-100">
                            <input type="text" name="iddonhang" id="iddonhang"
                                value="{{ Auth::check() ? $iddonhang : '' }}" hidden />
                            <label class="form-label my-3">Tên Khách hàng<sup>*</sup></label>
                            <input type="text" name="tennguoidung" class="form-control"
                                placeholder="Nhập tên khách hàng ..." value="{{ Auth::user()->tenkhachhang ?? '' }}"
                                required />
                        </div>
                        @if (Auth::check())
                            <div class="form-item">
                                <label class="form-label my-3">Địa chỉ<sup>*</sup></label>
                                <input type="text" name="diachi" id="diachi" class="form-control"
                                    value="{{ Auth::user()->diachi ?? '' }}" readonly />
                            </div>
                        @else
                            <div class="form-item">
                                <label class="form-label my-3">Địa chỉ<sup>*</sup></label>
                                <input type="text" id="duong" name="duong" class="form-control"
                                    placeholder="Nhập số nhà, tên đường, phường ..." required />
                                <div class="select-group d-flex gap-2 mt-1">
                                    <select class="form-select" id="quan" name="quan" required></select>
                                    <select class="form-select" id="phuong" name="phuong" required></select>
                                    <input type="hidden" name="diachigiao" id="full_address" />
                                </div>
                            </div>
                        @endif
                        <div class="form-item">
                            <label class="form-label my-3">Điện thoại<sup>*</sup></label>
                            <input name="sodienthoai" type="tel" class="form-control"
                                value="{{ Auth::user()->sodienthoai ?? '' }}" placeholder="Nhập số điện thoại ..."
                                required />
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email<sup>*</sup></label>
                            <input type="email" name="email" class="form-control"
                                value="{{ Auth::user()->email ?? '' }}" placeholder="Nhập email ..." required />
                        </div>
                        <hr>
                        @if (Auth::user())
                            <div class="form-item">
                                <label class="form-label my-3">Địa chỉ giao hàng khác (Nếu khác địa điểm ở trên
                                    )<sup>*</sup></label>
                                <input type="text" id="duong" name="duong" class="form-control"
                                    placeholder="Nhập số nhà, tên đường" />
                                <div class="select-group d-flex gap-2 mt-1">
                                    <select class="form-select" id="quan" name="quan"></select>
                                    <select class="form-select" id="phuong" name="phuong"></select>
                                    <input type="hidden" name="diachigiao" id="full_address" />
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Đơn giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Ghi chú</th>
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dsct as $v)
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="{{ asset('customer/assets/img/' . $v->hinh) }}"
                                                        class="img-fluid rounded-circle" style="width: 90px; height: 90px;"
                                                        alt="">
                                                </div>
                                            </th>
                                            <td class="py-5">{{ $v->tensanpham }}</td>
                                            <td class="py-5">{{ number_format($v->dongia, 0, ',', '.') }} VNĐ</td>
                                            <td class="py-5">{{ $v->soluongsp }}</td>
                                            <td class="py-5">{{ $v->ghichu }}</td>
                                            <td class="py-5">{{ number_format($v->dongia * $v->soluongsp, 0, ',', '.') }}
                                                VNĐ
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">
                                            <p>Phương thức vận chuyển</p>
                                        </td>

                                        <td colspan="2">
                                            <div id="vanchuyen">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input bg-primary border-0"
                                                        name="deliver_option" value="none">
                                                    <label class="form-check-label" for="Shipping-2">Vận chuyển tiêu
                                                        chuẩn</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input bg-primary border-0"
                                                        name="deliver_option" value="xteam">
                                                    <label class="form-check-label" for="Shipping-3">Vận chuyển hoả
                                                        tốc</label>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <div class="py-3">
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                        <!-- Tổng đơn hàng -->
                                                        <tr>
                                                            <td class="text-end text-uppercase fw-bold">Tổng đơn hàng:</td>
                                                            <td class="text-end">
                                                                <span id="tongdonhang">
                                                                    @php
                                                                        $soluong = 0;
                                                                        $tongtien = 0;
                                                                        foreach ($dsct as $v) {
                                                                            $tongtien += $v->dongia * $v->soluongsp;
                                                                            $soluong += $v->soluongsp;
                                                                        }
                                                                        echo number_format($tongtien, 0, ',', '.') .
                                                                            'VNĐ';
                                                                    @endphp
                                                                </span>
                                                                <input type="hidden" name="soluongsp" id="soluongsp"
                                                                    value="{{ $soluong }}" />
                                                            </td>
                                                        </tr>

                                                        <!-- Phí vận chuyển -->
                                                        <tr>
                                                            <td class="text-end text-uppercase fw-bold">Phí vận chuyển:
                                                            </td>
                                                            <td class="text-end">
                                                                <span id="phiship">0 VNĐ</span>
                                                            </td>
                                                        </tr>

                                                        <!-- Tổng cộng -->
                                                        <tr>
                                                            <td class="text-end text-uppercase fw-bold">Tổng cộng:</td>
                                                            <td class="text-end">
                                                                <span id="tongcongHT">
                                                                    {{ number_format($tongtien, 0, ',', '.') }} VNĐ
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <!-- Hidden input dùng để tính toán bằng JavaScript -->
                                                <input type="hidden" name="Tongtien" id="Tongtien"
                                                    value="{{ $tongtien }}">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            @if($soluong<50)
                            <button class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary"
                                type="submit"
                                onclick="document.getElementById('paymentForm').action='{{ route('checkout.finish') }}'; ">
                                Đặt hàng
                            </button>
                            @endif
                            <button class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary"
                                type="submit"
                                onclick="document.getElementById('paymentForm').action='{{ route('vnpay_payment') }}'; ">
                                Thanh toán VNPAY
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
