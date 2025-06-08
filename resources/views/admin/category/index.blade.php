@extends('admin.components.layout')
@section('content')
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý loại sản phẩm</h3>
      </div>
      <div class="row">
        <div class="card">
            <div class="my-2">
                <a class="btn btn-primary" href="{{route('categoryCreate')}}">Thêm loại sản phẩm</a>
            </div>
        <table class="mt-3 table table-hover">
            <tr>
                <td>Mã loại sản phẩm</td>
                <td>Tên loại sản phẩm</td>
                <td></td>
                <td></td>
            </tr>
            @foreach($dslsp as $lsp)
            <tr>
                <td>
                    {{$lsp->idloaisanpham}}
                </td>
                <td>{{$lsp->tenloai}}</td>
                <td>
                    <form action="{{route('categoryUpdate',$lsp->idloaisanpham)}}" method="POST"
                        style="display: inline;">
                            @csrf
                            <button type="submit" style="background:none; border:none; cursor:pointer;">
                            <a class="far fa-edit fa-2x " style="color:black;"></a>
                            </button>
                    </form>
                </td>
                <td>
                    <form action="{{route('categoryDelete',$lsp->idloaisanpham)}}" method="POST"
                    style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa loại sản phẩm {{$lsp->tenloai}} không?');">
                        @csrf
                        @method('delete')
                        <button type="submit" style="background:none; border:none; cursor:pointer;">
                            <a class="fa fa-ban fa-2x" style="color:red;"></a>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
          </table>
          <div>
            {{$dslsp->links()}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection