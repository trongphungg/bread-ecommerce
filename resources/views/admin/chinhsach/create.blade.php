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
                        <a href="{{ route('policyIndex') }}">Danh mục chính sách</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('policyCreate') }}">Thêm chính sách</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 card">
                <div class="col-6 ">
                    <form class="mt-3" action="{{ route('handleCreatePolicy') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="Tensanpham">Nhập tên chính sách</label>
                            <input type="text" class="form-control" name ="tenchinhsach"
                                placeholder="Nhập tên chính sách..." required />
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">Mô tả</span>
                                <textarea class="form-control" name ="mota" aria-label="With textarea" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email2">Ngày tạo</label>
                            <input type="date" class="form-control" name ="ngaytao"
                                 required />
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Loại chính sách</label>
                            <select class="form-select" name="loaichinhsach" required>
                                @foreach($dslcs as $cs)
                                <option value="{{$cs->idloaichinhsach}}">{{$cs->tenloai}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="card-action">
                            <input type="submit" value="Submit" class="btn btn-success"></input>
                            <a href="{{ route('policyIndex') }}"class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection