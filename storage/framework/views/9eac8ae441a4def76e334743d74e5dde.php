<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>رسالة اختبار</title>
</head>

<body>
    <h2>مرحباً <?php echo e($data['name']); ?></h2>
    <p><?php echo e($data['message']); ?></p>
    <p>تحياتي، <?php echo e(config('app.name')); ?></p>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\new_alialmatry\alialmatry\resources\views/emails/test.blade.php ENDPATH**/ ?>