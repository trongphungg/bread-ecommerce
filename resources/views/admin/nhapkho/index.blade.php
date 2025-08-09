@extends('admin.components.layout')
@section('content')
<div class="container">
    <div class="page-inner">
    <div id="toast">

    </div>
      <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Số lần nhập hàng</p>
                                        <h4 class="card-title">{{ $dskho->total() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Nguyên liệu đang thiếu</p>
                                        <h4 class="card-title">{{$dsnl->count()}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-luggage-cart"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Tổng chi</p>
                                        <h4 class="card-title">
                                            {{ number_format($tongtien, 0, ',', '.') }}
                                            VNĐ</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
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
                <td>Số thứ tự</td>
                <td>Ghi chú</td>
                <td>Ngày nhập</td>
                <td>Tổng tiền</td>
                <td></td>
                <td></td>
            </tr>
            @foreach($dskho as $kho)
            <tr>
                <td>{{ $dskho->firstItem() + $loop->index }}</td>
                <td>{{$kho->ghichu}}</td>
                <td>{{\Carbon\Carbon::parse($kho->ngaynhap)->format('d/m/Y')}}</td>
                <td>{{number_format($kho->tongtien,0,',','.').'VNĐ'}}</td>
                <td>
                    <form action="{{route('details',$kho->idkho)}}" method="POST"
                        style="display: inline;">
                            @csrf
                            <button type="submit" style="background:none; border:none; cursor:pointer;">
                            <a class="far fa-edit fa-2x " style="color:black;"></a>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
    let successMessage = @json(session('success'));
    if (successMessage) {
        showSuccessToast(successMessage);
    }
});
</script>
@endsection