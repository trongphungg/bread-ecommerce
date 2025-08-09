@extends('customer.components.layout')
@section('content')
    <div class="container-fluid">
        <div class=" page-header py-5">
            <h1 class=" display-4 text-center text-white">Đơn hàng của bạn</h1>
        </div>
        <div class="row g-4 py-5">
            <div class="col-12">
                @if ($dsdh->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Bạn chưa có đơn hàng nào</p>
                        <a href="{{ route('shop') }}" class="btn btn-primary">Mua sắm ngay</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Mã đơn hàng</th>
                                    <th scope="col">Ngày đặt</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Địa chỉ</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dsdh as $dh)
                                    <tr>
                                        <td>#{{ $dh->iddonhang }}</td>
                                        <td>{{ date('d/m/Y', strtotime($dh->ngaylapdh)) }}</td>
                                        <td>{{ number_format($dh->tongtien) }}VNĐ</td>
                                        <td>{{ $dh->diachi }}</td>
                                        <td>
                                            @switch($dh->trangthaidh)
                                                @case('DXN')
                                                    <span class="badge" style="background-color: #1572e8;">Đã xác nhận</span>
                                                @break
                                                @case('DTT')
                                                    <span class="badge bg-warning">Đã thanh toán</span>
                                                @break
                                                @case('DG')
                                                    <span class="badge bg-danger">Đang giao</span>
                                                @break
                                                @case('CXN')
                                                    <span class="badge" style="background-color: #6861ce;">Chờ xác nhận</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <form action="{{ route('orderUserDetail', $dh->iddonhang) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i> Chi tiết
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $dsdh->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
