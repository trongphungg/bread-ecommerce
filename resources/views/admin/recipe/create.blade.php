@extends('admin.components.layout')
@section('content')

<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý công thức</h3>
      </div>
      <div class="row">
        <div class="card">
            <form action="{{route('handleCreateRecipe',$sanpham->idsanpham)}}" method="POST">
        @csrf
        <table class="table table-bordered" id="nguyenlieuTable">
            <thead>
                <tr>
                    <th>Tên nguyên liệu</th>
                    <th>Số lượng</th>
                    <th>Đơn vị</th>
                    <th><button type="button" onclick="addRow()" class="btn btn-success btn-sm">+</button></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Thêm công thức</button>
    </form>
         <div>
          <div>
          </div>
         </div>
        </div>
      </div>
      </div>
    </div>
</div>
@endsection
