@extends('customer.components.layout')
@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white ">Liên hệ</h1>
    </div>
        <div id="toast" >
    </div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="h-100 rounded">
                            {{-- <iframe class="rounded w-100"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3896.
                            271138023169!2d107.63247427453868!3d12.431646526487365!2m3!1f0!2f0!3f0!3m2!1i10
                            24!2i768!4f13.1!3m3!1m2!1s0x31724794a3d0ba1d%3A0x1e88a9a40834d582!2zTMOyIEL
                            DoW5oIE3DrCBQaG9uZyBIaeG7gW4!5e0!3m2!1svi!2s!4v1749143261361!5m2!1svi!2s"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                                <iframe class="rounded w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2264.4635
                                300108826!2d106.6786697499924!3d10.738188706973776!2m3!1f0!2f0!3f0!3m2!1i1024
                                !2i768!4f13.1!3m3!1m2!1s0x31752f62a90e5dbd%3A0x674d5126513db295!2zVHLGsOG7nW5
                                nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgU8OgaSBHw7Ju!5e0!3m2!1svi!2s!4v1754355139
                                449!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" 
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <form action="{{route('sendMail')}}" class="" method="POST">
                            @csrf
                            <input type="text" name="name" class="w-100 form-control border-0 py-3 mb-4"
                                placeholder="Nhập họ và tên ..." required>
                            <input type="email" name="email" class="w-100 form-control border-0 py-3 mb-4"
                                placeholder="Nhập email ..." required>
                            <textarea name="content" class="w-100 form-control border-0 mb-4" rows="5" cols="10"
                                placeholder="Để lại lời nhắn với chúng tôi nhé !"></textarea required>
                                        <button class="w-100 btn form-control green-color bg-warning py-3 bg-white" type="submit">Liên hệ</button>
                                    </form>
                            </div>
                            <div class="col-lg-5">
        <div class="d-flex p-4 rounded mb-4 bg-white">
                                        <i class="fas fa-map-marker-alt fa-2x green-color me-4"></i>
                                        <div>
                                            <h4>Địa chỉ cửa hàng</h4>
                                            <p class="mb-2">180 Cao Lỗ, phường 04, quận 8</p>
                                        </div>
                                    </div>
                                    <div class="d-flex p-4 rounded mb-4 bg-white">
                                        <i class="fas fa-envelope fa-2x green-color me-4"></i>
                                        <div>
                                            <h4>Email hỗ trợ</h4>
                                            <p class="mb-2">trongphung020103@gmail.com</p>
                                        </div>
                                    </div>
                                    <div class="d-flex p-4 rounded bg-white">
                                        <i class="fa fa-phone-alt fa-2x green-color me-4"></i>
                                        <div>
                                            <h4>Hotline</h4>
                                            <p class="mb-2">0338 737 003</p>
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
