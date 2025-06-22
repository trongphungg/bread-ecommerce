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
                        <a href="{{ route('ingredientIndex') }}">Danh sách nguyên liệu</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ingredientCreate') }}">Thêm nguyên liệu</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 card">
                <div class="col-6 ">
                    <form class="mt-3" action="{{ route('handleUpdateIngredient',$nguyenlieu->idnguyenlieu) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="Tensanpham">Nhập tên nguyên liệu</label>
                            <input type="text" class="form-control" name ="tennguyenlieu"
                                value="{{$nguyenlieu->tennguyenlieu}}" required />
                        </div>
                        <div class="form-group">
                            <label for="email2">Nhập đơn vị tính</label>
                            <input type="text" class="form-control" name ="donvitinh"
                                value="{{$nguyenlieu->donvitinh}}" required />
                        </div>
                        <div class="card-action">
                            <input type="submit" value="Submit" class="btn btn-success"></input>
                            <a href="{{ route('ingredientIndex') }}"class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection