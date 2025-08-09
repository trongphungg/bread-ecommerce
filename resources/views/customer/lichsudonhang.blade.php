@extends('customer.components.layout')
@section('content')
<div class="container-fluid">
    <div class=" page-header py-5">
        <h1 class=" display-4 text-center text-white">Lịch sử mua hàng của bạn</h1>
    </div>
    <div class="container">
        <div class="row g-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center animate__animated animate__fadeInLeft">
                        <i class="fas fa-history text-primary me-3"></i>
                        <h1 class="display-6 fw-bold mb-0">Lịch sử mua hàng</h1>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('shop') }}" class="btn btn-outline-primary">
                            <i class="fas fa-shopping-cart me-2"></i>Mua hàng
                        </a>
                        <a href="{{ route('orderUserIndex') }}" class="btn btn-outline-primary">
                            <i class="fas fa-shopping-bag me-2"></i>Đơn hàng hiện tại
                        </a>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <h5 class="text-muted">Tổng đơn hàng</h5>
                                <h3 class="text-primary">{{ $dsdh->total() }}</h3>
                            </div>
                            <div class="col-md-3">
                                <h5 class="text-muted">Đã hoàn tất</h5>
                                <h3 class="text-success">{{ $dsdh->where('trangthaidh', 'HT')->count() }}</h3>
                            </div>
                            <div class="col-md-3">
                                <h5 class="text-muted">Đã hủy</h5>
                                <h3 class="text-danger">{{ $dsdh->where('trangthaidh', 'HD')->count() }}</h3>
                            </div>
                            <div class="col-md-3">
                                <h5 class="text-muted">Tổng chi tiêu</h5>
                                <h3 class="text-primary">{{ number_format($dsdh->where('trangthaidh','HT')->sum('tongtien')) }}đ</h3>
                            </div>
                        </div>
                    </div>
                </div>

                @if($dsdh->isEmpty())
                    <div class="text-center py-5 animate__animated animate__fadeIn">
                        <img src="{{ asset('customer/assets/img/empty-cart.png') }}" alt="Empty History" class="img-fluid mb-4" style="max-width: 200px">
                        <h4 class="text-muted mb-4">Chưa có lịch sử đơn hàng</h4>
                        <p class="text-muted mb-4">Hãy mua sắm và quay lại sau nhé!</p>
                        <a href="{{ route('shop') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-cart me-2"></i>Mua sắm ngay
                        </a>
                    </div>
                @else
                    <div class="animate__animated animate__fadeInUp">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-hashtag me-2"></i>Mã đơn hàng</th>
                                        <th><i class="far fa-calendar-alt me-2"></i>Ngày đặt</th>
                                        <th><i class="fas fa-money-bill-wave me-2"></i>Tổng tiền</th>
                                        <th><i class="fas fa-map-marker-alt me-2"></i>Địa chỉ</th>
                                        <th><i class="fas fa-info-circle me-2"></i>Trạng thái</th>
                                        <th><i class="fas fa-cogs me-2"></i>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-6">
                                    @foreach($dsdh as $dh)
                                    <tr class="animate__animated animate__fadeIn">
                                        <td class="fw-bold">#{{ $dh->iddonhang }}</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($dh->ngaylapdh)) }}</td>
                                        <td class="fw-bold text-primary">{{ number_format($dh->tongtien) }}đ</td>
                                        <td>{{ Str::limit($dh->diachi, 30) }}</td>
                                        <td>
                                            @if($dh->trangthaidh == 'HT')
                                                <span class="badge bg-success animate__animated animate__pulse animate__infinite">
                                                    <i class="fas fa-check-circle me-1"></i>Hoàn tất
                                                </span>
                                            @else
                                                <span class="badge bg-dark animate__animated animate__headShake animate__infinite">
                                                    <i class="fas fa-times-circle me-1"></i>Đã hủy
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('orderUserDetail', $dh->iddonhang) }}" method="POST">
                                                @csrf
                                                <button 
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-eye me-2"></i>Chi tiết
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="d-flex justify-content-center">
                            {{ $dsdh->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection