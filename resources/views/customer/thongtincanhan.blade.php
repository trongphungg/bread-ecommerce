@extends('customer.components.layout')
@section('content')
        <div id="toast" >
    </div>
<div class="container-fluid">
    <div class=" page-header py-5">
        <h1 class=" display-4 text-center text-white">Thông tin cá nhân</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden wow fadeInUp" data-wow-delay="0.2s">
                <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-address-card me-2"></i>Thông tin chi tiết</h4>
                    <a href="{{route('profileUpdate')}}" class="btn btn-light">
                        <i class="fas fa-edit me-1"></i>Sửa thông tin
                    </a>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center border-start border-primary border-3 ps-3">
                                <i class="fas fa-user text-primary me-3 fa-lg"></i>
                                <div>
                                    <p class="text-muted mb-0">Họ và tên</p>
                                    <h5 class="mb-0">{{ $khachhang->tenkhachhang }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center border-start border-primary border-3 ps-3">
                                <i class="fas fa-venus-mars text-primary me-3 fa-lg"></i>
                                <div>
                                    <p class="text-muted mb-0">Giới tính</p>
                                    <h5 class="mb-0">{{ $khachhang->gioitinh == 1 ? 'Nam' : 'Nữ' }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center border-start border-primary border-3 ps-3">
                                <i class="fas fa-birthday-cake text-primary me-3 fa-lg"></i>
                                <div>
                                    <p class="text-muted mb-0">Ngày sinh</p>
                                    <h5 class="mb-0">{{\Carbon\Carbon::parse($khachhang->ngaysinh)->format('d/m/Y')}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center border-start border-primary border-3 ps-3">
                                <i class="fas fa-phone text-primary me-3 fa-lg"></i>
                                <div>
                                    <p class="text-muted mb-0">Số điện thoại</p>
                                    <h5 class="mb-0">{{ $khachhang->sodienthoai }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center border-start border-primary border-3 ps-3">
                                <i class="fas fa-map-marker-alt text-primary me-3 fa-lg"></i>
                                <div>
                                    <p class="text-muted mb-0">Địa chỉ</p>
                                    <h5 class="mb-0">{{ $khachhang->diachi }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center border-start border-primary border-3 ps-3">
                                <i class="fas fa-map-marker-alt text-primary me-3 fa-lg"></i>
                                <div>
                                    <p class="text-muted mb-0">Vai trò</p>
                                    <h5 class="mb-0">{{ $khachhang->role == 1 ? 'Quản trị viên' : 'Khách hàng' }}</h5>
                                </div>
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
    let errorMessage = @json(session('error'));
    if (errorMessage) {
        showErrorToast(errorMessage);
    }
});
</script>   
@endsection