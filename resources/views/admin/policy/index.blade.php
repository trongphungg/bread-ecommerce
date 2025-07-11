@extends('admin.components.layout')
@section('content')
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý chính sách</h3>
      </div>
      <div class="row">
        <div class="card">
            <div class="my-2">
                <a class="btn btn-primary" href="{{route('policyCreate')}}">Thêm chính sách</a>
            </div>
          <table class="mt-3 table table-hover">
            <tr>
                <td>Mã chính sách</td>
                <td>Tên chính sách</td>
                <td>Ngày tạo chính sách</td>
                <td>Mô tả</td>
                <td>Loại chính sách</td>
                <td></td>
                <td></td>
            </tr>
            @foreach($dscs as $cs)
            <tr>
                <td>{{$cs->idchinhsach}}</td>
                <td>
                  {{$cs->tenchinhsach}}
                </td>
                <td>{{\Carbon\Carbon::parse($cs->ngaytao)->format('d/m/Y')}}</td>
                <td>
                  {{$cs->mota}}
                </td>
                <td>
                  {{$cs->loaichinhsach->tenloai}}
                </td>
                <td>
                    <form action="{{route('policyUpdate',$cs->idchinhsach)}}" method="POST"
                        style="display: inline;">
                            @csrf
                            <button type="submit" style="background:none; border:none; cursor:pointer;">
                            <a class="far fa-edit fa-2x " style="color:black;"></a>
                            </button>
                    </form>
                </td>
                <td>
                    <form action="{{route('policyDelete',$cs->idchinhsach)}}" method="POST"
                    style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm {{$cs->tenchinhsach}} không?');">
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
            {{$dscs->links()}}
          </div>
         </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection