@extends('admin.components.layout')
@section('content')
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý nhập kho</h3>
      </div>
      <div class="row">
        <div class="card">
            <div class="my-2">
                <a class="btn btn-primary" href="{{route('warehouseCreate')}}">Thêm phiếu nhập</a>
            </div>
          <table class="mt-3 table table-hover">
            <tr>
                <td>Mã nhập kho</td>
                <td>Tên nguyên liệu</td>
                <td>Số lượng</td>
                <td>Đơn vị tính</td>
                <td>Tổng tiền</td>
                <td>Ngày nhập</td>
                <td></td>
                <td></td>
            </tr>
            @foreach($dskho as $kho)
            <tr>
                <td>{{$kho->idkho}}</td>
                <td>{{$kho->nguyenlieu->tennguyenlieu}}</td>
                <td>{{$kho->soluong}}</td>
                <td>{{$kho->donvitinh}}</td>
                <td>{{number_format($kho->tongtien,0,',','.').'VNĐ'}}</td>
                <td>{{\Carbon\Carbon::parse($kho->ngaynhap)->format('d/m/Y')}}</td>
                <td>
                    <form action="" method="POST"
                        style="display: inline;">
                            @csrf
                            <button type="submit" style="background:none; border:none; cursor:pointer;">
                            <a class="far fa-edit fa-2x " style="color:black;"></a>
                            </button>
                    </form>
                </td>
                <td>
                    <form action="" method="POST"
                    style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm không?');">
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
            {{$dskho->links()}}
          </div>
         </div>
        </div>
      </div>
      </div>
    </div>
</div>
@endsection