@extends('customer.components.layout')
@section('content')
<div class="container">
    <div class="container-fluid page-header py-5">
        <h1 class=" display-4 text-center text-white position-relative">Chỉnh sửa thông tin cá nhân</h1>
    </div>
    <div class="row col-md-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('handleUpdateProfile')}}" method="POST">
                            @csrf
                            <div class="form-group my-1">
                                <label>Tên người dùng</label>
                                <input type="text" class="form-control" name="tennguoidung"
                                    value="{{ $user->tennguoidung }}">
                            </div>
                            <div class="form-group my-1">
                                <label>Ngày sinh</label>
                                <input type="date" class="form-control" name="ngaysinh" value="{{$user->ngaysinh}}">
                            </div>
                            <div class="form-group my-1">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" name="diachi" class="form-control" placeholder="Nhập số nhà, tên đường, phường ..." value="{{strstr(Auth::user()->diachi,'-',true) ?? ''}}" required />
                                 <select name="quan" id="quan" class="form-control">
                                    <option value="" disabled selected>Vui lòng chọn quận</option>
                                    @php
                                    $diachi = Auth::user()->diachi;
                                    $diachiParts = explode('-', $diachi);
                                    $selectedQuan = isset($diachiParts[1]) ? trim($diachiParts[1]) : '';
                                    @endphp
                                    @foreach($dsquan as $quan)
                                        <option value="{{$quan}}" {{$selectedQuan==$quan ? 'selected':''}}>{{$quan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group my-1">
                                <label>Giới tính</label>
                                <select class="form-control" name="gioitinh">
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
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                    required>
                            </div>

                            <div class="form-group my-1">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" name="password" value="{{$user->password}}">
                            </div>

                            <div class="form-group my-1">
                                <label>Vai trò</label>
                                <select class="form-control" name="role">
                                    <option value="0" selected>Khách hàng</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Sửa người dùng</button>
                            <a href="" class="btn btn-danger">Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
</div>
@endsection