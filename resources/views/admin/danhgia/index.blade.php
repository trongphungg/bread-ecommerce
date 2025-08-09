@extends('admin.components.layout')
@section('content')
<div class="container">
  <div class="page-inner">
      <div class="row">
        <div class="col-sm-6 col-md-6">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="bi bi-eye"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Số đánh giá hiển thị</p>
                                            <h4 class="card-title">{{ $dgHT->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="bi bi-eye-slash"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Số đánh giá bị ẩn</p>
                                            <h4 class="card-title">{{$dgAn->count()}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
      </div>
      <div id="toast">

      </div>
      <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý đánh giá</h3>
      </div>
      <div class="row">
        <div class="card">
          <table class="mt-3 table table-hover">
            <tr>
                <td>Số thứ tự</td>
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
                <td>{{$dsdg->firstItem()+$loop->index}}</td>
                <td>
                  {{$v->khachhang->tenkhachhang}}
                </td>
                <td>
                  {{$v->sanpham->tensanpham}}
                </td>
                <td>{{$v->danhgia}}</td>
                <td>{{$v->sodiem}}</td>
                <td>{{\Carbon\Carbon::parse($v->ngaydanhgia)->format('d/m/Y')}}</td>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
    let successMessage = @json(session('success'));
    if (successMessage) {
        showSuccessToast(successMessage);
    }
});
</script>
@endsection