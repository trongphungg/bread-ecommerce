@extends('customer.components.layout')
@section('content')
<h2>Thanh toán thành công</h2>
<p>Mã đơn hàng: {{ $maDonHang }}</p>
<p>Số tiền: {{ number_format($soTien) }} VNĐ</p>
@endsection