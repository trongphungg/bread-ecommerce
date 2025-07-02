@extends('customer.components.layout')
@section('content')
<div class="container-fluid">
    <div class=" page-header">
        <h1 class=" display-4 text-center text-white">Chi tiết đơn hàng của bạn</h1>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center mb-3 mb-sm-0">
                        <i class="fas fa-file-invoice text-primary me-3"></i>
                        <h2 class="mb-0 fs-4">Chi tiết đơn hàng #{{ $donhang->iddonhang }}</h2>
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                </div>

                <!-- Thông tin đơn hàng -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 fs-6"><i class="fas fa-info-circle me-2"></i>Thông tin đơn hàng</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <p class="mb-2"><strong><i class="far fa-calendar-alt me-2"></i>Ngày đặt:</strong><br class="d-block d-sm-none"> 
                                    {{ date('d/m/Y', strtotime($donhang->ngaylapdh)) }}</p>
                                <p class="mb-2"><strong><i class="fas fa-map-marker-alt me-2"></i>Địa chỉ:</strong><br class="d-block d-sm-none">
                                    {{ $donhang->diachi }}</p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p class="mb-2"><strong><i class="fas fa-money-bill-wave me-2"></i>Tổng tiền:</strong><br class="d-block d-sm-none">
                                    <span class="text-primary fw-bold">{{ number_format($donhang->tongtien) }}VNĐ</span></p>
                                <p class="mb-2"><strong><i class="fas fa-info-circle me-2"></i>Trạng thái:</strong><br class="d-block d-sm-none">
                                    @switch($donhang->trangthaidh)
                                        @case('DXN')
                                            <span class="badge bg-info">Đã xác nhận</span>
                                            @break
                                        @case('HT')
                                            <span class="badge bg-success">Hoàn tất</span>
                                            @break
                                        @case('DTT')
                                            <span class="badge bg-primary">Đã thanh toán</span>
                                            @break
                                        @case('DG')
                                            <span class="badge bg-warning">Đang giao</span>
                                            @break
                                        @case('HD')
                                            <span class="badge bg-danger">Đã hủy</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">Chờ xác nhận</span>
                                    @endswitch
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chi tiết sản phẩm -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 fs-6"><i class="fas fa-shopping-cart me-2"></i>Chi tiết sản phẩm</h5>
                    </div>
                    <div class="card-body p-0 p-sm-3">
                        <div class="d-none d-md-block">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Thông tin sản phẩm</th>
                                        <th scope="col" class="text-center">Đơn giá</th>
                                        <th scope="col" class="text-center">Số lượng</th>
                                        <th scope="col" class="text-end">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dsctdh as $ct)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('customer/assets/img/' . $ct->sanpham->hinh) }}" 
                                                 alt="{{ $ct->sanpham->tensanpham }}" 
                                                 class="img-thumbnail product-img"
                                                 style="width: 80px; height: 80px; object-fit: cover;">
                                        </td>
                                        <td>
                                            <h6 class="mb-1 fs-6">{{ $ct->sanpham->tensanpham }}</h6>
                                            <p class="text-muted small mb-0">{{ Str::limit($ct->sanpham->mota, 100) }}</p>
                                            <div class="mt-2">
                                                <span class="badge bg-info text-dark">
                                                    <i class="fas fa-box me-1"></i>{{ $ct->sanpham->donvitinh }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="fw-bold">{{ number_format($ct->sanpham->dongia) }}đ</div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge bg-secondary">
                                                {{ $ct->soluongsp }}
                                            </span>
                                        </td>
                                        <td class="text-end align-middle">
                                            <span class="fw-bold text-primary">
                                                {{ number_format($ct->sanpham->dongia * $ct->soluongsp) }}đ
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="4" class="text-end">
                                            <strong>Tổng số lượng:</strong>
                                        </td>
                                        <td class="text-end">
                                            <strong>{{$tongSoLuong}} sản phẩm</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end">
                                            <strong>Tổng tiền:</strong>
                                        </td>
                                        <td class="text-end">
                                            <strong class="text-primary">{{ number_format($donhang->tongtien) }}đ</strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection