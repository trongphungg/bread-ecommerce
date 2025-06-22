@extends('admin.components.layout')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Thêm người dùng mới</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{ route('userIndex') }}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('userIndex') }}"> Danh sách người dùng</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Thêm người dùng</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('handleCreateUser') }}" method="POST">
                            @csrf
                            <div class="form-group col-md-6">
                                <label>Tên người dùng</label>
                                <input type="text" class="form-control" name="tennguoidung"
                                    value="{{ old('tennguoidung') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Ngày sinh</label>
                                <input type="date" class="form-control" name="ngaysinh" value="{{ old('ngaysinh') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="label text-start d-block">Địa chỉ</label>
                                <input type="text" class="login-input form-control"
                                    name="diachi" placeholder="Nhập số nhà, tên đường, phường ..." required/>
                                <select name="quan" id="quan" class="form-control" required>
                                    <option value="" disabled selected>Vui lòng chọn quận</option>
                                    <option value="Quận 1">Quận 1</option>
                                    <option value="Quận 3">Quận 3</option>
                                    <option value="Quận 4">Quận 4</option>
                                    <option value="Quận 5">Quận 5</option>
                                    <option value="Quận 6">Quận 6</option>
                                    <option value="Quận 7">Quận 7</option>
                                    <option value="Quận 8">Quận 8</option>
                                    <option value="Quận 10">Quận 10</option>
                                    <option value="Quận 11">Quận 11</option>
                                    <option value="Quận 12">Quận 12</option>
                                    <option value="Quận Tân Bình">Quận Tân Bình</option>
                                    <option value="Quận Tân Phú">Quận Tân Phú</option>
                                    <option value="Quận Bình Tân">Quận Bình Tân</option>
                                    <option value="Quận Bình Thạnh">Quận Bình Thạnh</option>
                                    <option value="Quận Gò Vấp">Quận Gò Vấp</option>
                                    <option value="Quận Phú Nhuận">Quận Phú Nhuận</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Giới tính</label>
                                <select class="form-control" name="gioitinh">
                                    <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Nam</option>
                                    <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>Nữ</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Số điện thoại</label>
                                <input type="text" class="form-control" name="sodienthoai" value="{{ old('sodienthoai') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Vai trò</label>
                                <select class="form-control" name="role">
                                    <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>Khách hàng</option>
                                    <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Thêm người dùng</button>
                            <a href="{{ route('userIndex') }}" class="btn btn-danger">Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
