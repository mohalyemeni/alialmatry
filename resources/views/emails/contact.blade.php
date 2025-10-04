<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>رسالة تواصل جديدة</title>
</head>

<body
    style="margin:0;padding:0;background:#f7f9fb;font-family:Tahoma, Arial, sans-serif;direction:rtl;text-align:right;">
    <!-- outer wrapper -->
    <table cellpadding="0" cellspacing="0" border="0" width="100%"
        style="background:#f7f9fb;padding:20px 0;box-sizing:border-box;">
        <tr>
            <td align="center">
                <!-- inner card (responsive) -->
                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="width:600px;max-width:100%;background:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,0.06);box-sizing:border-box;border-collapse:collapse;">
                    <tr>
                        <td
                            style="padding:18px 20px;border-bottom:2px solid #5e625f;text-align:right;direction:rtl;box-sizing:border-box;">
                            <h2 style="margin:0;color:#28a745;font-size:18px;font-weight:700;line-height:1.2;">📩 رسالة
                                جديدة من صفحة تواصل معنا</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:14px 20px;text-align:right;direction:rtl;box-sizing:border-box;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="border-collapse:collapse;box-sizing:border-box;">
                                <!-- use two-column rows for label + value (more robust in RTL and small widths) -->
                                <tr>
                                    <td
                                        style="width:110px;vertical-align:top;padding:6px 8px 6px 0;box-sizing:border-box;">
                                        <strong style="display:block;color:#000;font-size:14px;">الاسم:</strong>
                                    </td>
                                    <td style="vertical-align:top;padding:6px 0;box-sizing:border-box;">
                                        <div
                                            style="color:#333;font-size:14px;line-height:1.4;word-break:break-word;overflow-wrap:break-word;white-space:pre-wrap;">
                                            {{ $data['name'] }}
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td
                                        style="width:110px;vertical-align:top;padding:6px 8px 6px 0;box-sizing:border-box;">
                                        <strong style="display:block;color:#000;font-size:14px;">الإيميل:</strong>
                                    </td>
                                    <td style="vertical-align:top;padding:6px 0;box-sizing:border-box;">
                                        <div
                                            style="color:#333;font-size:14px;line-height:1.4;word-break:break-word;overflow-wrap:break-word;white-space:pre-wrap;">
                                            {{ $data['email'] }}
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td
                                        style="width:110px;vertical-align:top;padding:6px 8px 6px 0;box-sizing:border-box;">
                                        <strong style="display:block;color:#000;font-size:14px;">الهاتف:</strong>
                                    </td>
                                    <td style="vertical-align:top;padding:6px 0;box-sizing:border-box;">
                                        <div
                                            style="color:#333;font-size:14px;line-height:1.4;word-break:break-word;overflow-wrap:break-word;white-space:pre-wrap;">
                                            {{ $data['number'] ?? '---' }}
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <hr style="border:none;border-top:1px solid #eee;margin:14px 0;">

                            <p style="margin:0 0 8px 0;font-weight:700;color:#000;font-size:14px;">الرسالة:</p>
                            <div
                                style="margin:0;color:#444;line-height:1.6;font-size:14px;word-break:break-word;overflow-wrap:break-word;white-space:pre-wrap;">
                                {{ $data['message'] }}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="padding:12px 20px;background:#fafafa;border-top:1px solid #eee;text-align:center;direction:rtl;box-sizing:border-box;">
                            <p style="margin:0;font-size:12px;color:#888;">تم إرسال هذه الرسالة من موقعك الرسمي.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
