<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>رسالة تواصل جديدة</title>
</head>

<body>
    <h2>📩 رسالة جديدة من صفحة تواصل معنا</h2>

    <p><strong>الاسم:</strong> <?php echo e($data['name']); ?></p>
    <p><strong>الايميل:</strong> <?php echo e($data['email']); ?></p>
    <p><strong>الهاتف:</strong> <?php echo e($data['number'] ?? '---'); ?></p>
    <p><strong>الرسالة:</strong></p>
    <p><?php echo e($data['message']); ?></p>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\new_alialmatry\alialmatry\resources\views/emails/contact.blade.php ENDPATH**/ ?>