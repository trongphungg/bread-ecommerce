@extends('admin.components.layout')
@section('content')
<div class="container">
    <div class="page-inner">
      <div id="toast">

      </div>
      <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý nguyên liệu</h3>
      </div>
      <div class="row">
        <div class="card">
            <div class="my-2">
                <a class="btn btn-primary" href="{{route('ingredientCreate')}}">Thêm nguyên liệu</a>
            </div>
          <table class="mt-3 table table-hover">
            <tr>
                <td>Số thứ tự</td>
                <td>Tên nguyên liệu</td>
                <td>Đơn giá</td>
                <td>Số lượng tồn</td>
                <td>Đơn vị tính</td>
                <td>Ngày nhập</td>
                <td></td>
                <td></td>
            </tr>
            @foreach($dsnl as $nl)
            <tr>
                <td>{{$dsnl->firstItem() + $loop->index}}</td>
                <td>{{$nl->tennguyenlieu}}</td>
                <td>{{number_format($nl->dongia,0,',','.').'VNĐ'}}</td>
                <td>{{$nl->soluongton }}</td>
                <td>{{$nl->donvitinh}}</td>
                <td>{{\Carbon\Carbon::parse($nl->ngaynhap)->format('d/m/Y')}}</td>
                <td>
                    <form action="{{route('ingredientUpdate',$nl->idnguyenlieu)}}" method="POST"
                        style="display: inline;">
                            @csrf
                            <button type="submit" style="background:none; border:none; cursor:pointer;">
                            <a class="far fa-edit fa-2x " style="color:black;"></a>
                            </button>
                    </form>
                </td>
                <td>
                                        <form action="{{ route('ingredientDelete', $nl->idnguyenlieu) }}" method="POST"
                                            class="form-delete" data-product="{{ $nl->tennguyenlieu }}">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn-delete"
                                                style="background:none; border:none; cursor:pointer;">
                                                <i class="fa fa-ban fa-2x" style="color:red;"></i>
                                            </button>
                                        </form>
                                    </td>
            </tr>
            @endforeach
          </table>
         <div>
          <div>
            {{$dsnl->links()}}
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
    let errorMessage = @json(session('error'));
    if (errorMessage) {
        showErrorToast(errorMessage);
    }
});

document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.form-delete');
                const productName = form.getAttribute('data-product');

                Swal.fire({
                    title: 'Bạn chắc chắn?',
                    html: `Bạn có muốn xóa nguyên liệu ${productName} không?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
</script>
@endsection