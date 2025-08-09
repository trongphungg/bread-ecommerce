@extends('admin.components.layout')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Số lượng người dùng</p>
                                        <h4 class="card-title">{{ $dsnd->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-thermometer"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Tổng số sản phẩm</p>
                                        <h4 class="card-title">{{$dssp->count()}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-luggage-cart"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Tổng doanh thu</p>
                                        <h4 class="card-title">
                                            {{ number_format($dsdh->where('trangthaidh', 'HT')->sum('tongtien'), 0, ',', '.') }}
                                            VNĐ</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="far fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Tổng đơn hàng</p>
                                        <h4 class="card-title">{{ $dsdh->count() }} <span
                                                class="text-success small position-absolute"
                                                style="right: 10px; bottom: 10px;">
                                                {{ $dsdh->where('trangthaidh', 'HT')->count() }} đơn đã hoàn tất</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Biểu đồ doanh thu theo tháng </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="chartMonth"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Thống kê số lượng đã bán theo từng sản phẩm</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="doughnutChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">Top 5 sản phẩm bán chạy theo tháng</div>
                    <div class="me-0">
                        <label for="monthSelect">Chọn tháng:</label>
                        <input type="month" id="monthSelect" name="monthSelect">
                    </div>
                </div>
                <table class="mt-3 table table-hover">
                    <tr>
                        <th>
                            Hình ảnh
                        </th>
                        <th>
                            Tên sản phẩm
                        </th>
                        <th>
                            Giá bán
                        </th>
                        <th>
                            Số lượng bán
                        </th>
                        <th>
                            Thành tiền
                        </th>
                    </tr>
                    <tbody id="showKQ">
                        @foreach ($spbc as $sp)
                            <tr>
                                <td><img src="{{ asset('customer/assets/img/' . $sp->hinh) }}" alt=""
                                        class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"></td>
                                <td>{{ $sp->tensanpham }}</td>
                                <td>{{ number_format($sp->dongia, 0, ',', '.') }} VNĐ</td>
                                <td>{{ $sp->tongsoluong }}</td>
                                <td>{{ number_format($sp->dongia * $sp->tongsoluong, 0, ',', '.') }} VNĐ</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">


            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title mb-0">Đơn hàng gần đây</div>
                        <a href="{{ route('orderIndex') }}" class="me-0 btn btn-outline-primary"> Xem tất cả</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Mã đơn hàng</th>
                                    <th scope="col">Ngày đặt</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dhgd as $dh)
                                    <tr>
                                        <td>#{{ $dh->iddonhang }}</td>
                                        <td>{{ \Carbon\Carbon::parse($dh->ngaylapdh)->format('d/m/Y') }}</td>
                                        <td>{{ number_format($dh->tongtien, 0, ',', '.') }} VNĐ</td>
                                        <td> @switch($dh->trangthaidh)
                                                @case('HD')
                                                    <span class="badge bg-dark">Đã hủy</span>
                                                @break

                                                @case('CXN')
                                                    <span class="badge bg-secondary">Chờ xác nhận</span>
                                                @break

                                                @case('DTT')
                                                    <span class="badge bg-warning">Đã thanh toán</span>
                                                @break

                                                @case('DXN')
                                                    <span class="badge bg-primary">Đã xác nhận</span>
                                                @break

                                                @case('DG')
                                                    <span class="badge bg-danger">Đang giao hàng</span>
                                                @break

                                                @case('HT')
                                                    <span class="badge bg-success">Hoàn tất</span>
                                                @break
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title mb-0">Danh sách nguyên liệu cần nhập</div>
                        <a href="{{ route('warehouseCreate') }}" class="me-0 btn btn-outline-primary"> Tiến hành nhập</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Mã nguyên liệu</th>
                                    <th scope="col">Tên nguyên liệu</th>
                                    <th scope="col">Cần nhập</th>
                                    <th scope="col">Đơn vị tính</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dsnl as $nl)
                                    <tr>
                                        <td>#{{ $nl->idnguyenlieu }}</td>
                                        <td>{{ $nl->tennguyenlieu }}</td>
                                        <td>{{ abs($nl->soluongton) }}</td>
                                        <td>{{ $nl->donvitinh }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>




    <script>

        //Doanh thu theo sản phẩm
        const productLabels = @json($productLabels);
        const productData = @json($productData);
        const colors = @json($colors);

        //Doanh thu theo tháng

        const labelsMonth = @json($labelsMonth);
        const dataMonth = @json($dataMonth);




        //Doanh thu
        document.addEventListener('DOMContentLoaded', function() {
            const chartMonth = document.getElementById('chartMonth');
            new Chart(chartMonth, {
                type: 'line',
                data: {
                    labels: labelsMonth,
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: dataMonth,
                        borderColor: "#1d7af3",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#1d7af3",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: "transparent",
                        fill: true,
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return new Intl.NumberFormat('vi-VN', {
                                        style: 'currency',
                                        currency: 'VND'
                                    }).format(value);
                                }
                            }
                        }
                    }
                }
            });


            const doughnutCtx = document.getElementById('doughnutChart');

            new Chart(doughnutCtx, {
                type: 'doughnut',
                data: {
                    labels: productLabels,
                    datasets: [{
                        label: 'Tổng số lượng đã bán',
                        data: productData,
                        backgroundColor: colors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.parsed} sản phẩm`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
