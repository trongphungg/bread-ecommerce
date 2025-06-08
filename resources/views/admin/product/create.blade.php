@extends('admin.components.layout')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Tables</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('productIndex') }}">Danh mục sản phẩm</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('productCreate') }}">Thêm sản phẩm</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 card">
                <div class="col-6 ">
                    <form class="mt-3" action="{{ route('handleCreateProduct') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="Tensanpham">Nhập tên sản phẩm</label>
                            <input type="text" class="form-control" name ="tensanpham"
                                placeholder="Nhập tên sản phẩm ..." required />
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">Mô tả</span>
                                <textarea class="form-control" name ="motasanpham" aria-label="With textarea" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email2">Nhập đơn vị tính</label>
                            <input type="text" class="form-control" name ="dvt"
                                placeholder="Nhập đơn vị tính sản phẩm ..." required />
                        </div>
                        <div class="form-group">
                            <label for="email2">Chọn hình</label>
                            <input type="file" class="form-control" name ="hinh" required />
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Trạng thái đơn hàng</label>
                            <select class="form-select" name="trangthai" required>
                                <option value="1">Còn hàng</option>
                                <option value="0">Hết hàng</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text">VNĐ</span>
                                <input type="text" name="dongia" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Loại sản phẩm</label>
                            <select class="form-select" name ="loaisanpham" required>
                                @foreach ($loaisp as $lsp)
                                    <option value="{{ $lsp->idloaisanpham }}">{{ $lsp->tenloai }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-action">
                            <input type="submit" value="Submit" class="btn btn-success"></input>
                            <a href="{{ route('productIndex') }}"class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
