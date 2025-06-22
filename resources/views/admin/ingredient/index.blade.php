@extends('admin.components.layout')
@section('content')
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý nguyên liệu</h3>
      </div>
      <div class="row">
        <div class="card">
            <div class="my-2">
                <a class="btn btn-primary" href="{{route('ingredientCreate')}}">Thêm nguyên liệu</a>
            </div>
          <table class="mt-3 table table-hover">
            <tr>
                <td>Mã nguyên liệu</td>
                <td>Tên nguyên liệu</td>
                <td>Đơn vị tính</td>
                <td>Đơn giá</td>
                <td>Số lượng tồn</td>
                <td></td>
                <td></td>
            </tr>
            @foreach($dsnl as $nl)
            <tr>
                <td>{{$nl->idnguyenlieu}}</td>
                <td>{{$nl->tennguyenlieu}}</td>
                <td>{{$nl->donvitinh}}</td>
                <td>{{$nl->dongia}}</td>
                <td>{{$nl->soluongton}}</td>
                <td>
                    <form action="{{route('ingredientUpdate',$nl->idnguyenlieu)}}" method="POST"
                        style="display: inline;">
                            @csrf
                            <button type="submit" style="background:none; border:none; cursor:pointer;">
                            <a class="far fa-edit fa-2x " style="color:black;"></a>
                            </button>
                    </form>
                </td>
                <td>
                    <form action="{{route('ingredientDelete',$nl->idnguyenlieu)}}" method="POST"
                    style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa nguyên liệu {{$nl->tennguyenlieu}} không?');">
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
            {{$dsnl->links()}}
          </div>
         </div>
        </div>
      </div>
      </div>
    </div>
</div>
@endsection