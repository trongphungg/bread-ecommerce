@extends('customer.components.layout')
@section('content')
    <div class="container">
        <div class="container-fluid page-header py-5">
            <h1 class=" display-4 text-center text-white position-relative">Chỉnh sửa thông tin cá nhân</h1>
        </div>
        <div class="row col-md-6 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('handleUpdateProfile') }}" method="POST">
                        @csrf
                        <div class="form-group my-1">
                            <label>Tên người dùng</label>
                            <input type="text" class="form-control" name="tennguoidung" value="{{ $user->tenkhachhang }}">
                        </div>
                        <div class="form-group my-1">
                            <label>Ngày sinh</label>
                            <input type="date" class="form-control" name="ngaysinh" 
       value="{{ \Carbon\Carbon::parse($user->ngaysinh)->format('Y-m-d') }}">
                        </div>
                        @php
                            $diachiParts = explode('-', Auth::user()->diachi);
                            $duong = trim($diachiParts[0] ?? '');
                            $quanName = trim($diachiParts[1] ?? '');
                            $phuongName = trim($diachiParts[2] ?? '');
                        @endphp
                        <div class="form-group my-1">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" name="diachi"
                                placeholder="Nhập số nhà, tên đường, phường ..." value="{{ Auth::user()->diachi ?? '' }}"
                                readonly />
                            <label for="">Địa chỉ mới</label>
                            <input type="text" name="duong" id="duong" class="form-control"
                                placeholder="Nhập số nhà, tên đường, phường ..." />
                            <div class="select-group d-flex gap-2 mt-1">
                                <select class="form-select" id="quan" name="quan"></select>
                                <select class="form-select" id="phuong" name="phuong"></select>
                                <input type="hidden" name="diachimoi" id="full_address" />
                            </div>
                        </div>
                        <div class="form-group my-1">
                            <label>Giới tính</label>
                            <select class="form-select" name="gioitinh">
                                <option value="1" {{ $user->gioitinh == '1' ? 'selected' : '' }}>Nam</option>
                                <option value="0" {{ $user->gioitinh == '0' ? 'selected' : '' }}>Nữ</option>
                            </select>
                        </div>
                        <div class="form-group my-1">
                            <label>Số điện thoại</label>
                            <input type="text" class="form-control" name="sodienthoai" value="{{ $user->sodienthoai }}">
                        </div>
                        <div class="form-group my-1">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="form-group my-1">
                            <label>Mật khẩu</label>
                            <input type="password" class="form-control" name="password" value="{{ $user->password }}">
                        </div>

                        <div class="form-group my-1">
                            <label>Vai trò</label>
                            <input class="form-control" name="role" readonly value="Khách hàng">
                            </input>
                        </div>

                        <button type="submit" class="btn btn-primary">Sửa người dùng</button>
                        <a href="" class="btn btn-danger">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
