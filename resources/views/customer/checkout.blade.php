@extends('customer.components.layout')
@section('content')
<div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Chi tiết thanh toán</h1>
                <form action="{{ route('checkout.finish')}}" method="POST">
                    @csrf
                    <div class="row g-5">
                        <div class="col-md-12 col-lg-6 col-xl-5">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Tên Khách hàng<sup>*</sup></label>
                                    <input type="text" name="tennguoidung" class="form-control" placeholder="Nhập tên khách hàng ..." value="{{Auth::user()->tennguoidung ?? ''}}" required  >
                                </div>
                            <div class="form-item">
                                <label class="form-label my-3">Địa chỉ<sup>*</sup></label>
                                <input type="text" name="diachi" class="form-control" placeholder="Nhập số nhà, tên đường, phường ..." value="{{strstr(Auth::user()->diachi,'-',true) ?? ''}}" required />
                                 <select name="quan" id="quan" class="form-control">
                                    <option value="" disabled selected>Vui lòng chọn quận</option>
                                    @php
                                    $diachi = Auth::user()->diachi;
                                    $diachiParts = explode('-', $diachi);
                                    $selectedQuan = isset($diachiParts[1]) ? trim($diachiParts[1]) : '';
                                    @endphp
                                    @foreach($dsquan as $quan)
                                        <option value="{{$quan}}" {{$selectedQuan==$quan ? 'selected':''}}>{{$quan}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Điện thoại<sup>*</sup></label>
                                <input name="sodienthoai" type="tel" class="form-control" value="{{Auth::user()->sodienthoai ?? ''}}" placeholder="Nhập số điện thoại ..." required >
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Email<sup>*</sup></label>
                                <input type="email" name="email" class="form-control" value="{{Auth::user()->email ?? ''}}" placeholder="Nhập email ..." required >
                            </div>
                            <hr>
                            @if(Auth::user())
                            <div class="form-item">
                                <label class="form-label my-3">Địa chỉ giao hàng khác<sup>*</sup>(Nếu khác địa điểm giao ở trên)</label>
                                <input type="text" name="diachigiao" class="form-control" placeholder="Nhập số nhà, tên đường, phường..." />
                                 <select name="quangiao" id="quangiao" class="form-control">
                                    <option value="" disabled selected>Vui lòng chọn quận</option>
                                    @foreach($dsquan as $quan)
                                        <option value="{{$quan}}">{{$quan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-7">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Tên sản phẩm</th>
                                            <th scope="col">Đơn giá</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Ghi chú</th>
                                            <th scope="col">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dsct as $v)
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="{{ asset('customer/assets/img/'.$v->hinh) }}" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                </div>
                                            </th>
                                            <td class="py-5">{{$v->tensanpham}}</td>
                                            <td class="py-5">{{number_format($v->dongia,0,',','.')}} VNĐ</td>
                                            <td class="py-5">{{$v->soluongsp}}</td>
                                            <td class="py-5">{{$v->ghichu}}</td>
                                            <td class="py-5">{{number_format($v->dongia*$v->soluongsp,0,',','.')}} VNĐ</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <th scope="row">
                                            </th>
                                            <td class="py-5">
                                                <p class="mb-0 text-dark text-uppercase py-3">TỔNG TIỀN: </p>
                                            </td>
                                            <td class="py-5"></td>
                                            <td class="py-5"></td>
                                            <td></td>
                                            <td class="py-5">
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0 text-dark">
                                                        @php
                                                        $tongtien = 0;
                                                            foreach($dsct as $v)
                                                            {
                                                                $tongtien += $v->dongia*$v->soluongsp;
                                                            }
                                                            echo number_format($tongtien,0,',','.').'VNĐ';
                                                        @endphp
                                                    <input type="hidden" name="Tongtien" value={{$tongtien}}>
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button type="submit" class="btn border border-secondary py-3 px-4 text-uppercase w-100 text-primary">Đặt hàng</button>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection