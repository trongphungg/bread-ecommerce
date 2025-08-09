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
                        <a href="{{ route('newsIndex') }}">Danh sách tin tức</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('newsCreate') }}">Thêm tin tức</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 card">
                <div class="col-6 ">
                    <form class="mt-3" action="{{ route('handleUpdateNews', $tintuc->idtintuc) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="Tensanpham">Nhập tiêu đề tin tức</label>
                            <input type="text" class="form-control" name ="tieude" value="{{ $tintuc->tieude }}"
                                required />
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">Mô tả</span>
                                <textarea class="form-control" name ="mota" style="height: 200px !important;" aria-label="With textarea" required>{{$tintuc->mota}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email2">Ngày tạo</label>
                            <input type="date" class="form-control" name ="ngaytao" value="{{ \Carbon\Carbon::parse($tintuc->ngaytao)->format('Y-m-d') }}"
                                required />
                        </div>
                        <div class="form-group">
                            @if ($tintuc->hinhanh)
                                <div style="margin-bottom: 10px;">
                                    <img src="{{ asset('customer/assets/img/'.$tintuc->hinhanh) }}" alt="Hình hiện tại"
                                        width="150">
                                </div>
                            @endif
                            <input type="hidden" name="hinh_cu" value="{{ $tintuc->hinhanh}}">
                            <label for="email2">Chọn hình</label>
                            <input type="file" class="form-control" name ="hinh_moi"
                                 />
                        </div>
                        <div class="form-group">
                            <label for="Tensanpham">Tác giả</label>
                            <input type="text" class="form-control" name ="tacgia" value="{{ $tintuc->tacgia }}"
                               />
                        </div>
                        <div class="form-group">
                            <label for="Tensanpham">Đường dẫn tin tức</label>
                            <input type="text" class="form-control" name ="link" value="{{ $tintuc->link }}"
                             />
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Loại tin tức</label>
                            <select class="form-select" name ="loaitintuc" required>
                                @foreach ($dsltt as $ltt)
                                    <option value={{ $ltt->idloaitintuc }}
                                        @if ($tintuc->idloaitintuc == $ltt->idloaitintuc) {{ 'selected' }} @endif>
                                        {{ $ltt->tenloai }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-action">
                            <input type="submit" value="Submit" class="btn btn-success"></input>
                            <a href="{{ route('newsIndex') }}"class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
