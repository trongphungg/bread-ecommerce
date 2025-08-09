@extends('customer.components.layout')
@section('content')
    <div class="container">
        <div id="toast">

        </div>
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
                            @error('sodienthoai')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group my-1">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            @error('email')
                                    <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="login-form-group">
                                <label class="label text-start d-block">Mật khẩu</label>
                                <input type="password" name="password" class="login-input form-control"
                                    placeholder="Nhập mật khẩu mới" />
                            </div>
                            <div class="login-form-group">
                                <label class="label text-start d-block">Xác nhận mật khẩu</label>
                                <input type="password" name="password_confirmation" class="login-input form-control"
                                    placeholder="Xác nhận mật khẩu mới" />
                            </div>
                         @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        <div class="form-group my-1">
                            <label>Vai trò</label>
                            <input type="hidden" name="role" value="0" />
                            <input type="text" class="form-control" value="Khách hàng" readonly />
                        </div>

                        <button type="submit" class="btn btn-primary">Sửa người dùng</button>
                        <a href="{{route('profileIndex')}}" class="btn btn-danger">Hủy</a>
                    </form>
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
        showSuccessToast(errorMessage);
    }
});
</script>
@endsection
