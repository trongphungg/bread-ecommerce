@extends('admin.components.layout')
@section('content')
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý ý kiến</h3>
      </div>
      <div class="row">
        <div class="card">
            <div class="my-2">
                <a class="btn btn-primary" href="{{route('opinionCreate')}}">Thêm ý kiến</a>
            </div>
        <table class="mt-3 table table-hover">
            <tr>
                <td>Tên khách hàng</td>
                <td>Mô tả</td>
                <td>Nghề nghiệp</td>
                <td>Số điểm</td>
                <td></td>
                <td></td>
            </tr>
            @foreach($dsyk as $yk)
            <tr>
                <td>
                    {{$yk->tenkhachhang}}
                </td>
                <td>{{$yk->mota}}</td>
                <td>{{$yk->nghenghiep}}</td>
                <td>{{$yk->sodiem}}</td>
                <td>
                    <form action="{{route('opinionUpdate',$yk->idykien)}}" method="POST"
                        style="display: inline;">
                            @csrf
                            <button type="submit" style="background:none; border:none; cursor:pointer;">
                            <a class="far fa-edit fa-2x " style="color:black;"></a>
                            </button>
                    </form>
                </td>
                <td>
                    <form action="{{route('opinionDelete',$yk->idykien)}}" method="POST"
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
            {{$dsyk->links()}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection