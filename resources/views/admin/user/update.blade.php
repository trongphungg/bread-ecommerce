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
                        <form action="{{ route('handleUpdateUser',$user->idkhachhang) }}" method="POST">
                            @csrf
                            <div class="form-group col-md-6">
                                <label>Tên người dùng</label>
                                <input type="text" class="form-control" name="tennguoidung"
                                    value="{{ $user->tenkhachhang }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Ngày sinh</label>
                                <input type="date" class="form-control" name="ngaysinh" value="{{$user->ngaysinh}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" name="diachi" readonly value="{{$user->diachi ?? ''}}" />
                                <label for="">Địa chỉ mới</label>
                                <input type="text" name="duong" id="duong" class="form-control" placeholder="Nhập số nhà, tên đường, phường ..."  />
                                 <div class="select-group d-flex gap-2 mt-1">
                                <select class="form-select" id="quan" name="quan"></select>
                                <select class="form-select" id="phuong" name="phuong"></select>
                                <input type="hidden" name="diachimoi" id="full_address" />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Giới tính</label>
                                <select class="form-control form-select" name="gioitinh">
                                    <option value="1" {{ $user->gioitinh == '1' ? 'selected' : '' }}>Nam</option>
                                    <option value="0" {{ $user->gioitinh == '0' ? 'selected' : '' }}>Nữ</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Số điện thoại</label>
                                <input type="text" class="form-control" name="sodienthoai" value="{{ $user->sodienthoai }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                    required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" name="password" value="{{$user->password}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Vai trò</label>
                                <select class="form-control form-select" name="role" >
                                    <option value="0" {{ $user->role == '0' ? 'selected' : '' }}>Khách hàng</option>
                                    <option value="1" {{ $user->role == '1' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Sửa người dùng</button>
                            <a href="{{ route('userIndex') }}" class="btn btn-danger">Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
