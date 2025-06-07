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
            <a href="#">Sản phẩm</a>
          </li>
          <li class="separator">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item">
            <a href="{{route('productIndex')}}">Danh mục sản phẩm</a>
          </li>
        </ul>
      </div>
      <div class="row">
        <div class="card">

            <div class="my-2">
                <a class="btn btn-primary" href="{{route('productCreate')}}">Thêm sản phẩm</a>
            </div>
          <table class="mt-3 table table-hover">
            <tr>
                <td>Mã sản phẩm</td>
                <td>Tên sản phẩm</td>
                <td>Mô tả</td>
                <td>Đơn vị tính</td>
                <td>Trạng thái</td>
                <td>Đơn giá</td>
                <td>Số lượng</td>
                <td></td>
                <td></td>
            </tr>
            @foreach($dssp as $sp)
            <tr>
                <td>{{$sp->idsanpham}}</td>
                <td>{{$sp->tensanpham}}</td>
                <td>{{Str::limit($sp->motasanpham,50)}}</td>
                <td>{{$sp->donvitinh}}</td>
                <td>{{$sp->trangthai}}</td>
                <td>{{number_format($sp->dongia,0,',',',').'VNĐ'}}</td>
                <td>{{$sp->soluong}}</td>
                <td>
                    <form action="{{route('productUpdate',$sp->idsanpham)}}" method="POST"
                        style="display: inline;">
                            @csrf
                            <button type="submit" style="background:none; border:none; cursor:pointer;">
                            <a class="far fa-edit fa-2x " style="color:black;"></a>
                            </button>
                    </form>
                </td>
                <td>
                    <form action="{{route('productDelete',$sp->idsanpham)}}" method="POST"
                    style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm {{$sp->tensanpham}} không?');">
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
            {{$dssp->links()}}
          </div>
         </div>
        </div>
      </div>
      </div>
    </div>
  </div>
  @endsection