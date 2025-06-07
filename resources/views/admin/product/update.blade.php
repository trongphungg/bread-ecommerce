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
                    <form class="mt-3" action="{{ route('handleUpdateProduct', $sp->idsanpham) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="Masanpham">Nhập mã sản phẩm</label>
                            <input type="text" class="form-control" name ="idsanpham" readonly
                                value="{{ $sp->idsanpham }}" />
                        </div>
                        <div class="form-group">
                            <label for="Tensanpham">Nhập tên sản phẩm</label>
                            <input type="text" class="form-control" name ="tensanpham" value="{{ $sp->tensanpham }}"
                                required />
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">Mô tả</span>
                                <textarea class="form-control" name ="motasanpham" aria-label="With textarea" required>{{ $sp->motasanpham }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email2">Nhập đơn vị tính</label>
                            <input type="text" class="form-control" name ="dvt" value="{{ $sp->donvitinh }}"
                                required />
                        </div>
                        <div class="form-group">
                            @if ($sp->hinh)
                                <div style="margin-bottom: 10px;">
                                    <img src="{{ asset('customer/assets/img/'.$sp->hinh) }}" alt="Hình hiện tại"
                                        width="150">
                                </div>
                            @endif
                            <input type="hidden" name="hinh_cu" value="{{ $sp->hinh}}">
                            <label for="email2">Chọn hình</label>
                            <input type="file" class="form-control" name ="hinh_moi"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Trạng thái đơn hàng</label>
                            <select class="form-select" name="trangthai" required>
                                @if ($sp->trangthai == 1)
                                    <option value="1">Còn hàng</option>
                                @else
                                    <option value="0">Hết hàng</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text">VNĐ</span>
                                <input type="text" name="dongia" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" value="{{ $sp->dongia }}" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Loại sản phẩm</label>
                            <select class="form-select" name ="loaisanpham" required>
                                @foreach ($dslsp as $a)
                                    <option value={{ $a->idloaisanpham }}
                                        @if ($sp->idloaisanpham == $a->idloaisanpham) {{ 'selected' }} @endif>
                                        {{ $a->tenloai }}
                                    </option>
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
        @endsection
