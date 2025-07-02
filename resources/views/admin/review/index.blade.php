@extends('admin.components.layout')
@section('content')
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý đánh giá</h3>
      </div>
      <div class="row">
        <div class="card">
          <table class="mt-3 table table-hover">
            <tr>
                <td>Mã đánh giá</td>
                <td>Tên khách hàng</td>
                <td>Tên sản phẩm</td>
                <td>Đánh giá</td>
                <td>Số điểm</td>
                <td>Ngày thực hiện đánh giá</td>
                <td>Trạng thái đánh giá</td>
                <td></td>
            </tr>
            @foreach($dsdg as $v)
            <tr>
                <td>{{$v->iddanhgia}}</td>
                <td>
                  {{$v->nguoidung->tennguoidung}}
                </td>
                <td>
                  {{$v->sanpham->tensanpham}}
                </td>
                <td>{{$v->danhgia}}</td>
                <td>{{$v->sodiem}}</td>
                <td>{{$v->ngaydanhgia}}</td>
                <td>
                  @switch($v->trangthaidg)
                  @case("1")
                  <span class="badge bg-success">Hiển thị</span>
                  @break
                  @case("0")
                  <span class="badge bg-danger">Không hiển thị</span>
                  @break
                  @endswitch
                </td>
                <td>
                    <a href="{{route('reviewUpdate',$v->iddanhgia)}}" class="btn btn-primary">Cập nhật trạng thái</a>
                </td>
            </tr>
            @endforeach
          </table>
         <div>
          <div>
            {{$dsdg->links()}}
          </div>
         </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection