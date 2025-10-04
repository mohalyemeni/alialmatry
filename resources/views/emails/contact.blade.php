<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>📩 رسالة تواصل جديدة</title>
    <style>
        body {
            font-family: 'Tahoma', 'Arial', sans-serif;
            background-color: #f7f9fb;
            color: #333;
            margin: 0;
            padding: 30px;
            direction: rtl;
            text-align: right;
        }

        .email-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 25px;
            max-width: 600px;
            margin: 0 auto;
        }

        .email-header {
            border-bottom: 2px solid #28a745;
            margin-bottom: 15px;
            padding-bottom: 10px;
        }

        h2 {
            color: #28a745;
            margin: 0;
        }

        p {
            font-size: 15px;
            line-height: 1.6;
            margin: 8px 0;
        }

        .info strong {
            color: #000;
            display: inline-block;
            width: 80px;
        }

        .footer {
            border-top: 1px solid #ddd;
            margin-top: 20px;
            padding-top: 10px;
            font-size: 13px;
            color: #777;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h2>📩 رسالة جديدة من صفحة تواصل معنا</h2>
        </div>

        <div class="info">
            <p><strong>الاسم:</strong> {{ $data['name'] }}</p>
            <p><strong>الإيميل:</strong> {{ $data['email'] }}</p>
            <p><strong>الهاتف:</strong> {{ $data['number'] ?? '---' }}</p>
        </div>

        <hr>

        <p><strong>الرسالة:</strong></p>
        <p>{{ $data['message'] }}</p>

        <div class="footer">
            <p>تم إرسال هذه الرسالة من موقعك الرسمي.</p>
        </div>
    </div>
</body>

</html>
