@extends('customer.components.layout')
@section('content')

<div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9" id="productForm">
                <form id="form{{$sanpham->idsanpham}}">
                    <div class="row g-4">
                        <input type="text" value={{$sanpham->idsanpham}} id="productId" hidden>
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{ asset('customer/assets/img/'.$sanpham->hinh) }}" id="productImage" class="img-fluid rounded" alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 id="productName" class="fw-bold mb-3 ">{{$sanpham->tensanpham}}</h4>
                            <p class="mb-3"></p>
                            <h5 id="productPrice" class="fw-bold mb-3 ">{{number_format($sanpham->dongia,0,',','.')}} VNĐ</h5>
                            <div class="d-flex mb-4">
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p class="mb-4">{{$sanpham->motasanpham}}</p>
                            <div class="input-group quantity mb-5" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input id="productQuantity" type="text" class="form-control form-control-sm text-center border-0" value="1">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="btn border border-warning green-color rounded-pill px-4 py-2 mb-4 text-primary">
                                <i class="fa fa-shopping-bag me-2 green-color"></i> Thêm vào giỏ hàng
                            </button>
                        </div>
                    </div>
                </form>
                {{-- <div class="col-lg-12">
                    <nav>
                        <div class="nav nav-tabs mb-3">
                            <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                    id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                    aria-controls="nav-mission" aria-selected="false">Reviews</button>
                        </div>
                    </nav>
                    <div class="tab-content mb-5">
                        <div class="tab-pane active" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                            @foreach($danhgia as $d)
                                @if($d->Trangthaidg == 1)
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/img/avatar.jpg') }}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;">{{$d->Ngaydanhgia}}</p>
                                            <div class="d-flex justify-content-between">
                                                <h5>{{$d->khachhang->TenKhachhang}}</h5>
                                                <div class="d-flex mb-3">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <p>{{$d->Danhgia}}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="tab-pane" id="nav-vision" role="tabpanel">
                            <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                amet diam et eos labore. 3</p>
                            <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                Clita erat ipsum et lorem et sit</p>
                        </div>
                    </div>
                </div> --}}
                {{-- @if(Auth::check())
                    <form action="{{route('handlecreate')}}" method="POST">
                        @csrf
                        <input type="hidden" name="IDSanpham" value="{{$sanpham->IDSanpham}}"/>
                        <input type="hidden" name="IDKhachhang" value="{{Auth::user()->IDKhachhang}}"/>
                        <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="border-bottom rounded my-4">
                                    <textarea name="Danhgia" class="form-control border-0" cols="30" rows="8" placeholder="Your Review *" spellcheck="false"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between py-3 mb-5">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 me-3">Please rate:</p>
                                        <div class="d-flex align-items-center" style="font-size: 12px;">
                                            <i class="fa fa-star text-muted"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn border border-secondary text-primary rounded-pill px-4 py-3"> Post Comment</button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif --}}
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="row g-4 fruite">
                    <div class="col-lg-12">
                        <h4 class="mb-4">Sản phẩm bán chạy</h4>
                        @foreach($dssp as $sp)
                            <a href="{{route('detail',$sp->idsanpham)}}" class="text-decoration-none">
                                <div class="d-flex align-items-center justify-content-start py-1">
                                    <div class="rounded" style="width: 100px; height: 100px;">
                                        <img src="{{ asset('customer/assets/img/'.$sp->hinh) }}" class="img-fluid rounded" alt="Image">
                                    </div>
                                    <div class="mx-2">
                                        <h6 class="mb-2">{{$sp->tensanpham}}</h6>
                                        <div class="d-flex mb-2">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-black"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2 ">{{number_format($sp->dongia,0,',',',')}} VNĐ</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        <div class="d-flex justify-content-center my-4">
                            <a href="{{route('shop')}}" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Xem thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection