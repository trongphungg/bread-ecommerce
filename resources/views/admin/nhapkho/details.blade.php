@extends('admin.components.layout')
@section('content')
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Chi tiết phiếu nhập</h3>
      </div>
      <div class="row">
        <div class="card">
          <table class="mt-3 table table-hover">
            <tr>
                <td>Số thứ tự</td>
                <td>Tên nguyên liệu</td>
                <td>Số lượng</td>
                <td>Đơn vị tính</td>
                <td>Giá tiền</td>
            </tr>
            @foreach($dschitiet as $ct)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$ct->nguyenlieu->tennguyenlieu}}</td>
                <td>{{$ct->soluong}}</td>
                <td>{{$ct->nguyenlieu->donvitinh}}</td>
                <td>{{number_format($ct->giatien,0,',','.')}} VNĐ</td>
            </tr>
            @endforeach
          </table>
         <div>
         </div>
        </div>
      </div>
      </div>
    </div>
</div>
@endsection