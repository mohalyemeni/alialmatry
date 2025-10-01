<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>رسالة اختبار</title>
</head>

<body>
    <h2>مرحباً {{ $data['name'] }}</h2>
    <p>{{ $data['message'] }}</p>
    <p>تحياتي، {{ config('app.name') }}</p>
</body>

</html>
