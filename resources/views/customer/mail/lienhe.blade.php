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
        .footer {
            background: #f7941d;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }
        .highlight {
            font-weight: bold;
            color: #f7941d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Cảm ơn bạn đã liên hệ với Bánh mì Phong Hiền</h1>
        </div>
        <div class="content">
            <p>Xin chào {{$name}},</p>
            <p>Quý khách hàng đã có gửi mail liên hệ với chúng tôi về vấn đề :</p>
            <p>{{$content}}</p>
            <hr/>
            <p>Chúng tôi đã nhận được email của bạn về vấn đề mà bạn đã phản ánh. Cảm ơn bạn đã tin tưởng và liên hệ với chúng tôi. Chúng tôi xin thông báo rằng chúng tôi đã nhận được yêu cầu của bạn và sẽ nhanh chóng kiểm tra và phản hồi trong thời gian sớm nhất có thể.</p>
            <p>Vui lòng chờ đợi phản hồi từ chúng tôi. Nếu có gì cần giải đáp thêm hoặc nếu bạn có bất kỳ câu hỏi nào khác, đừng ngần ngại liên hệ lại với chúng tôi qua số điện thoại <strong>0338 737 003</strong> hoặc qua <a href="https://www.facebook.com/TrongPhungg" target="_blank">Facebook</a>.</p>
            <p>Cảm ơn bạn một lần nữa vì đã dành thời gian để liên hệ với chúng tôi. Chúng tôi rất trân trọng sự quan tâm của bạn.</p>
        </div>
        <div class="footer">
            <p>Trân trọng,</p>
            <p>Đội ngũ hỗ trợ Bánh mì Phong Hiền</p>
        </div>
    </div>
</body>
</html>
