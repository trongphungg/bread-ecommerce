@extends('admin.components.layout')
@section('content')
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Đơn hàng</h3>
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
            <a href="{{route('orderIndex')}}">Danh sách đơn hàng</a>
          </li>
        </ul>
      </div>
      <div class="row">
        <div class="card">
            <h3>Đơn hàng của anh/chị {{$dh->tenkhachhang}}. Bao gồm:</h3>

          <table class="mt-3 table table-hover">
            <tr>
                <td>Mã sản phẩm</td>
                <td>Tên sản phẩm</td>
                <td>Đơn giá</td>
                <td>Số lượng</td>
                <td>Đơn vị tính</td>
                <td>Ghi chú</td>
                <td>Thành tiền</td>
            </tr>
            @foreach($ctdh as $v)
                <tr>
                    <td>{{$v->idsanpham}}</td>
                    <td>
                       {{$v->sanpham->tensanpham}}
                    </td>
                    <td>{{number_format($v->sanpham->dongia,0,',','.')}} VNĐ</td>
                    <td>{{$v->soluongsp}}</td>
                    <td>
                        {{$v->sanpham->donvitinh}}
                    </td>
                    <td>{{$v->ghichu}}</td>
                    <td>{{number_format($v->sanpham->dongia *$v->soluongsp,0,',','.')}} VNĐ</td>
                </tr>
            @endforeach
            @if($dh->trangthaidh != "HT" && $dh->trangthaidh != "HD")
            <tr>
              <td >
                <form action="{{route('orderUpdate',$dh->iddonhang)}}" method="POST">
                  @csrf
                  @method('put')
                    <input
                    hidden
                    name="trangthaidh"
                    value="HD"
                    />
                    <button type="submit" class="btn btn-dark">Huỷ đơn</button>
                </form>
              </td>
              <td>
                <form action="{{route('orderUpdate',$dh->iddonhang)}}" method="POST">
                  @csrf
                  @method('put')
                    <input
                    hidden
                    name="trangthaidh"
                    value="DXN"
                    />
                    <button type="submit" class="btn btn-primary">Đã xác nhận</button>
                </form>
              </td>
              <td>
                <form action="{{route('orderUpdate',$dh->iddonhang)}}" method="POST">
                  @csrf
                  @method('put')
                    <input
                    hidden
                    name="trangthaidh"
                    value="DTT"
                    />
                    <button type="submit" class="btn btn-warning">Đã thanh toán</button>
                </form>
              </td>
              <td>
                <form action="{{route('orderUpdate',$dh->iddonhang)}}" method="POST">
                  @csrf
                  @method('put')
                    <input
                    hidden
                    name="trangthaidh"
                    value="DG"
                    />
                    <button type="submit" class="btn btn-danger">Đang giao</button>
                </form>
              </td>
              <td>
                <form action="{{route('orderUpdate',$dh->iddonhang)}}" method="POST">
                  @csrf
                  @method('put')
                    <input
                    hidden
                    name="trangthaidh"
                    value="HT"
                    />
                    <button type="submit" class="btn btn-success">Hoàn tất</button>
                </form>
              </td>
              <td></td>
            </tr>
            @endif
          </table>
         <div>

         </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection