@extends('admin.components.layout')
@section('content')
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý công thức</h3>
      </div>
      <div class="row">
        <div class="card">
            <div class="my-2">
                <a class="btn btn-primary" href="{{route('recipeCreate',$sanpham->idsanpham)}}">Thêm công thức</a>
            </div>
          <table class="mt-3 table table-hover">
            <tr>
                <td>Số thứ tự</td>
                <td>Tên nguyên liệu</td>
                <td>Số lượng</td>
                <td>Đơn vị tính</td>
                <td>Số lượng tồn</td>
                <td></td>
                <td></td>
            </tr>
            @foreach($dsct as $ct)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$ct->nguyenlieu->tennguyenlieu}}</td>
                <td>{{$ct->soluong}}</td>
                <td>{{$ct->nguyenlieu->donvitinh}}</td>
                <td>{{$ct->nguyenlieu->soluongton}}</td>
                <td>
                    <form action="{{route('recipeUpdate',$ct->idcongthuc)}}" method="POST"
                        style="display: inline;">
                            @csrf
                            <button type="submit" style="background:none; border:none; cursor:pointer;">
                            <a class="far fa-edit fa-2x " style="color:black;"></a>
                            </button>
                    </form>
                </td>
                <td>
                    <form action="{{route('recipeDelete',$ct->idcongthuc)}}" method="POST"
                    style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa nguyên liệu {{$ct->nguyenlieu->tennguyenlieu}} khỏi công thức không?');">
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
          <div>
          </div>
         </div>
        </div>
      </div>
      </div>
    </div>
</div>
@endsection