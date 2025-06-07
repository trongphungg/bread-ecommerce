@extends('customer.components.layout')
@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white ">Sản phẩm</h1>
    </div>
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4 text-secondary">Cửa hàng bánh mì</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3" placeholder="Nhập từ khoá tìm kiếm"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4 class="text-secondary">Danh mục sản phẩm</h4>
                                    <ul class="list-unstyled fruite-categorie">
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="#"><i class="fas fa-apple-alt me-2"></i>Apples</a>
                                                <span>(3)</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4 class="mb-2 text-secondary">Price</h4>
                                    <input type="range" class="form-range w-100 green-color" id="rangeInput"
                                        name="rangeInput" min="0" max="500" value="0"
                                        oninput="amount.value=rangeInput.value">
                                    <output id="amount" name="amount" min-velue="0" max-value="500"
                                        for="rangeInput">0</output>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                            @foreach ($dssp as $sp)
                                
                                    <div class="col-md-6 col-lg-6 col-xl-4" id="productForm">
                                        <div class="rounded position-relative fruite-item">
                                            <form>
                                            @csrf
                                            <input  type="text" value={{$sp->idsanpham}} id="productId" hidden>
                                            <div class="fruite-img">
                                                <img src="{{ asset('customer/assets/img/' . $sp->hinh) }}"
                                                    class="img-fluid w-100 rounded-top" alt="" id="productImage">
                                            </div>
                                            <div class="p-4 border border-top-0 rounded-bottom">
                                                <h4 id="productName">{{ $sp->tensanpham }}</h4>
                                                <p>{{ Str::limit($sp->motasanpham, 70) }}</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-secondary fs-6 fw-bold mb-0" id="productPrice">
                                                        {{ number_format($sp->dongia, 0, ',', '.') }} VNĐ</p>
                                                    <button type="submit"
                                                        class="btn border border-warning rounded-pill px-3 green-color"><i
                                                            class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                            <div class="col-12" id="pagination">
                                <div class=" d-flex justify-content-center mt-5">
                                    {{ $dssp->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
