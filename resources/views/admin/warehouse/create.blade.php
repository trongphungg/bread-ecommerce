@extends('admin.components.layout')
@section('content')

<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý nhập kho</h3>
      </div>
      <div class="row">
        <div class="card">
            
            <form id="warehouseForm" action="{{route('handleCreateWarehouse')}}" method="POST">
        @csrf
        <div class="row py-4">
        <div class="col-md-6">
            <label for="ghichu" class="form-label fw-semibold">Ghi chú về đơn hàng</label>
            <input type="text"
                   class="form-control"
                   name="ghichu"
                   id="ghichu"
                  value="Phiếu nhập ngày {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}"></input>
        </div>
        <div class="col-md-6">
            <label for="total" class="form-label fw-semibold">Tổng tiền</label>
            <input type="text"
                   class="form-control"
                   name="total"
                   id="total"
                   placeholder="0 VNĐ"
                   readonly />
        </div>
        <table class="table table-bordered" id="nguyenlieuTable">
            <thead>
                <tr>
                    <th>Tên nguyên liệu</th>
                    <th>Số lượng</th>
                    <th>Đơn vị</th>
                    <th>Tổng tiền</th>
                    <th><button type="button" onclick="addRow()" class="btn btn-success btn-sm">+</button></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Nhập kho</button>
    </form>
         <div>
          <div>
          </div>
         </div>
        </div>
      </div>
      </div>
    </div>
</div>

<script>
  function fillPlaceholderIfEmpty() {
    let input = document.getElementById('ghichu');
    if (input.value.trim() === '') {
      input.value = input.placeholder;
    }
    return true; 
  }
</script>
@endsection
