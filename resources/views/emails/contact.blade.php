<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>رسالة تواصل جديدة</title>
</head>

<body>
    <h2>📩 رسالة جديدة من صفحة تواصل معنا</h2>

    <p><strong>الاسم:</strong> {{ $data['name'] }}</p>
    <p><strong>الايميل:</strong> {{ $data['email'] }}</p>
    <p><strong>الهاتف:</strong> {{ $data['number'] ?? '---' }}</p>
    <p><strong>الرسالة:</strong></p>
    <p>{{ $data['message'] }}</p>
</body>

</html>
