@extends('admin.components.layout')
@section('content')
    <div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý tin tức</h3>
      </div>
      <div class="row">
        <div class="card">
            <div class="my-2">
                <a class="btn btn-primary" href="{{route('newsCreate')}}">Thêm tin tức</a>
            </div>
        <table class="mt-3 table table-hover">
            <tr>
                <td>Mã tin tức</td>
                <td>Tiêu đề</td>
                <td>Ngày tạo</td>
                <td>Mô tả</td>
                <td>Loại tin tức</td>
                <td></td>
                <td></td>
            </tr>
            @foreach($dstt as $tt)
            <tr>
                <td>
                    {{$tt->idtintuc}}
                </td>
                <td>{{$tt->tieude}}</td>
                <td>{{$tt->tieude}}</td>
                <td>{{$tt->mota}}</td>
                <td>{{$tt->loaitintuc->tenloai}}</td>
                <td>
                    <form action="{{route('newsUpdate',$tt->idtintuc)}}" method="POST"
                        style="display: inline;">
                            @csrf
                            <button type="submit" style="background:none; border:none; cursor:pointer;">
                            <a class="far fa-edit fa-2x " style="color:black;"></a>
                            </button>
                    </form>
                </td>
                <td>
                    <form action="{{route('newsDelete',$tt->idtintuc)}}" method="POST"
                    style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tin tức {{$tt->tieude}}  không?');">
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
            {{$dstt->links()}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection