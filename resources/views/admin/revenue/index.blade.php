@extends('admin.components.layout')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Biểu đồ doanh thu </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="myChart"></canvas>
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
            <div class="col-md-6">
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Top 5 sản phẩm bán chạy</h3>
                        <h5 class="">Filter</h5>
                        {{-- <select name="monthSelect" id="monthSelect">
                            <option value="6">Tháng 6</option>
                            <option value="7">Tháng 7</option>
                            <option value="8">Tháng 8</option>
                        </select> --}}

                        <div>
    <!-- Bộ lọc chọn tháng -->
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
                                Số lượng bán
                            </th>
                        </tr>
                        <tbody id="showKQ">
                                @foreach ($spbc as $sp)
                                <tr>
                                    <td><img src="{{ asset('customer/assets/img/' . $sp->hinh) }}" alt=""
                                            class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"></td>
                                    <td>{{ $sp->tensanpham }}</td>
                                    <td>{{ $sp->tongsoluong }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        // Doanh thu theo ngày
        const chartLabels = @json($labels);
        const chartData = @json($data);

        //Doanh thu theo sản phẩm
        const productLabels = @json($productLabels);
        const productData = @json($productData);
        const colors = @json($colors);

        //Doanh thu theo tháng

        const labelsMonth = @json($labelsMonth);
        const dataMonth = @json($dataMonth);
    </script>
@endsection
