<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            background: #f7941d;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background: #f7941d;
            color: #fff;
        }
        table tr:last-child td {
            border-bottom: none;
        }
        .footer {
            background: #f7941d;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }
        .total {
            font-weight: bold;
            font-size: 18px;
        }
        .contact a {
            color: #f7941d;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bánh mì Phong Hiền</h1>
            <p>Kính chào quý khách <strong>{{$ten}}</strong></p>
        </div>
        <div class="content">
            <h3>Thông tin đơn hàng của bạn:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php $tonghoadon = 0; @endphp
                    @foreach($ctdh as $dh)
                    <tr>
                        <td>{{$dh->sanpham->tensanpham}}</td>
                        <td>{{number_format($dh->sanpham->dongia, 0, ',', '.').' VNĐ'}}</td>
                        <td>{{$dh->soluongsp}}</td>
                        <td>{{number_format($dh->sanpham->dongia * $dh->soluongsp, 0, ',', '.').' VNĐ'}}</td>
                    </tr>
                    @php $tonghoadon += $dh->sanpham->dongia * $dh->soluongsp; @endphp
                    @endforeach
                    <tr>
                        <td colspan="3">Phí vận chuyển</td>
                        <td >{{number_format($tongtien-$tonghoadon, 0, ',', '.').' VNĐ'}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="total">Tổng tiền thanh toán</td>
                        <td class="total">{{number_format($tongtien, 0, ',', '.').' VNĐ'}}</td>
                    </tr>
                </tbody>
            </table>
            <p><strong>Địa chỉ giao hàng:</strong> {{$diachi}}</p>
            <p class="contact">Quý khách vui lòng kiểm tra lại hóa đơn cũng như địa chỉ giao hàng. Nếu có thay đổi, vui lòng liên hệ qua số điện thoại: <strong>0338 737 003</strong> hoặc qua <a href="https://www.facebook.com/TrongPhungg" target="_blank">Facebook</a>.</p>
        </div>
        <div class="footer">
            <p>Cảm ơn quý khách đã lựa chọn Bánh mì Phong Hiền!</p>
            <p>Trân trọng,</p>
            <p>Đội ngũ Bánh mì Phong Hiền</p>
        </div>
    </div>
</body>
</html>
