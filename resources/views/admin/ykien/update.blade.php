@extends('admin.components.layout')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Tables</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('opinionIndex') }}">Danh sách ý kiến</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('opinionCreate') }}">Thêm ý kiến</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 card">
                <div class="col-6 ">
                    <form class="mt-3" action="{{ route('handleUpdateOpinion',$ykien->idykien) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="Tensanpham">Nhập tên khách hàng</label>
                            <input type="text" class="form-control" name ="tenkhachhang" value="{{ $ykien->tenkhachhang }}"
                                required />
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">Mô tả</span>
                                <textarea class="form-control" name ="mota" aria-label="With textarea" required>{{ $ykien->mota }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Tensanpham">Nghề nghiệp</label>
                            <input type="text" class="form-control" name ="nghenghiep" value="{{ $ykien->nghenghiep }}"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Số điểm</label>
                            <select class="form-select" name="sodiem" required>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ $ykien->sodiem == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            @if ($ykien->hinh)
                                <div style="margin-bottom: 10px;">
                                    <img src="{{ asset('customer/assets/img/'.$ykien->hinh) }}" alt="Hình hiện tại"
                                        width="150">
                                </div>
                            @endif
                            <input type="hidden" name="hinh_cu" value="{{ $ykien->hinh}}">
                            <label for="email2">Chọn hình</label>
                            <input type="file" class="form-control" name ="hinh_moi"
                                 />
                        </div>
                        <div class="card-action">
                            <input type="submit" value="Submit" class="btn btn-success"></input>
                            <a href="{{ route('opinionIndex') }}"class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
