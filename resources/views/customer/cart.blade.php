     @extends('customer.components.layout')
     @section('content')
     <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th class="text-center" data-intro="Bạn có thể viết chú thích về bánh mì tại đây để bọn mình làm phù hợp với sở thích của bạn nhé !!!(Ví dụ: Ít ớt, nhiều rau, ... Mặc định sẽ là đầy đủ nhé !!)&#10145;"  scope="col" >Ghi chú</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody id="listCart">
                        </tbody>
                    </table>
                </div>
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1><span class="fw-normal">Tổng tiền giỏ hàng</span></h1>
                                <div class="d-flex justify-content-between mb-4" id="subTotal">
                                </div>
                            </div>
                            <div id="loaibanh" class="py-4 mb-4 border-top d-flex justify-content-between" ></div>
                            <div id="quantity" class="py-4 mb-4 border-top d-flex justify-content-between" ></div>
                            <div id="lastTotal" class="py-4 mb-4 border-top border-bottom d-flex justify-content-between" >
                                
                            </div>
                            
                            <a href="{{route('checkout')}}">
                                <button 
                                class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" 
                                type="button">Đồng ý thanh toán
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection