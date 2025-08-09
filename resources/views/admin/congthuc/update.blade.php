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
                        <a href="{{ route('recipeDetail',$congthuc->idcongthuc) }}">Danh sách công thức</a>
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
                    <form class="mt-3" action="{{ route('handleUpdateRecipe',$congthuc->idcongthuc) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="Tensanpham">Tên nguyên liệu</label>
                            <input type="text" class="form-control" name ="tennguyenlieu"
                                value="{{$congthuc->nguyenlieu->tennguyenlieu}}" readonly required />
                        </div>
                        <div class="form-group">
                            <label>Đơn vị tính</label>
                            <input type="text" class="form-control" name ="donvitinh"
                                value="{{$congthuc->nguyenlieu->donvitinh}}" readonly required />
                        </div>
                        <div class="form-group">
                            <label>Số lượng</label>
                            <input type="text" class="form-control" name ="soluong"
                                value="{{$congthuc->soluong}}" required />
                        </div>
                        <div class="card-action">
                            <input type="submit" value="Submit" class="btn btn-success"></input>
                            <a href=""class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection