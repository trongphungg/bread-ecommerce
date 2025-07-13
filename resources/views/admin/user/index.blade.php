@extends('admin.components.layout')
@section('content')
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lí tài khoản</h3>
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
            <a href="">Danh sách tài khoản</a>
          </li>
        </ul>
      </div>
      <div class="row">
        <div class="card">
            <div class="my-2">
                <a class="btn btn-primary" href="{{route('userCreate')}}">Thêm người dùng</a>
            </div>
        <table class="mt-3 table table-hover">
            <tr>
                <td>ID Người dùng</td>
                <td>Tên người dùng</td>
                <td>Ngày sinh</td>
                <td>Địa chỉ</td>
                <td>Giới tính</td>
                <td>Số điện thoại</td>
                <td>Email</td>
                <td>Vai trò</td>
                <td></td>
                <td></td>
            </tr>
            @foreach($dsuser as $user)
            <tr>
                <td>
                    {{$user->idkhachhang}}
                </td>
                <td>{{$user->tenkhachhang}}</td>
                <td>{{\Carbon\Carbon::parse($user->ngaysinh)->format('d/m/Y')}}</td>
                <td>{{$user->diachi}}</td>
                <td>{{ $user->gioitinh == 1 ? 'Nam' : 'Nữ' }}</td>
                <td>{{$user->sodienthoai}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role ==1 ?'Quản trị viên':'Khách hàng'}}</td>
                <td>
                    <form action="{{route('userUpdate',$user->idkhachhang)}}" method="POST"
                        style="display: inline;">
                            @csrf
                            <button type="submit" style="background:none; border:none; cursor:pointer;">
                            <a class="far fa-edit fa-2x " style="color:black;"></a>
                            </button>
                    </form>
                </td>
                <td>
                    <form action="{{route('userDelete',$user->idkhachhang)}}" method="POST"
                    style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm  không?');">
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
            {{$dsuser->links()}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection