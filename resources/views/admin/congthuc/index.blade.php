@extends('admin.components.layout')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Quản lý công thức</h3>
            </div>
            <div class="row">
                <div class="card">
                    <table class="mt-3 table table-hover">
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Hình ảnh</td>
                            <td>Tên sản phẩm</td>
                            <td></td>
                        </tr>
                        @foreach ($dssp as $sp)
                            <tr>
                                <td>{{ $sp->idsanpham }}</td>
                                <td><img src="{{ asset('customer/assets/img/' . $sp->hinh) }}" alt=""
                                        class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"></td>
                                <td>{{ $sp->tensanpham }}</td>
                                <td>
                                    <form action="{{ route('recipeDetail', $sp->idsanpham) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" style="background:none; border:none; cursor:pointer;">
                                            <a class="far fa-edit fa-2x " style="color:black;"></a>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div>
                        <div>
                            {{ $dssp->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
