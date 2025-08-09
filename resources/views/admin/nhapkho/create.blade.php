@extends('admin.components.layout')
@section('content')
    <div class="container">
        <div class="page-inner">
            @if($dsnl->count()>0)
            <div class="page-header">
                <h3 class="fw-bold mb-3">Danh sách nguyên liệu đã hết</h3>
            </div>
            <div class="row">
                <table>
                    <thead>
                        <tr>
                            <th>Số thứ tự</th>
                            <th>Tên nguyên liệu</th>
                            <th>Số lượng cần nhập thêm</th>
                            <th>Đơn vị tính</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dsnl as $nl)
                            <tr>
                                <td>#{{ $loop->iteration }}</td>
                                <td>{{ $nl->tennguyenlieu }}</td>
                                <td>{{ abs($nl->soluongton) }}</td>
                                <td>{{ $nl->donvitinh }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            <div class="page-header">
                <h3 class="fw-bold mb-3">Quản lý nhập kho</h3>
            </div>
            <div class="row">
                <div class="card">
                    <form id="warehouseForm" action="{{ route('handleCreateWarehouse') }}" method="POST">
                        @csrf
                        <div class="row py-4">
                            <div class="col-md-6">
                                <label for="ghichu" class="form-label fw-semibold">Ghi chú về đơn hàng</label>
                                <input type="text" class="form-control" name="ghichu" id="ghichu"
                                    value="Phiếu nhập ngày {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}"></input>
                            </div>
                            <div class="col-md-6">
                                <label for="total" class="form-label fw-semibold">Tổng tiền</label>
                                <input type="text" class="form-control" name="total" id="total" placeholder="0 VNĐ"
                                    readonly />
                            </div>
                            <table class="table table-bordered" id="nguyenlieuTable">
                                <thead>
                                    <tr>
                                        <th>Tên nguyên liệu</th>
                                        <th>Số lượng</th>
                                        <th>Đơn vị</th>
                                        <th>Tổng tiền</th>
                                        <th><button type="button" onclick="addRow()"
                                                class="btn btn-success btn-sm">+</button></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            <button type="submit" class="btn btn-primary">Nhập kho</button>
                            <div>
                                @error('idnguyenlieu')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                @error('soluong')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                @error('donvitinh')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                @error('total')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>

                    </form>
                    <div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
