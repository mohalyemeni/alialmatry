<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>رسالة تواصل جديدة</title>
</head>

<body style="background:#f7f9fb;font-family:Tahoma, Arial, sans-serif;direction:rtl;text-align:right;">
    <!-- wrapper table for email clients -->
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#f7f9fb;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="background:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,0.08);direction:rtl;">
                    <tr>
                        <td style="border-bottom:2px solid #5e625f;text-align:right;direction:rtl;">
                            <!-- Optional: logo -->
                            {{-- <img src="{{ asset('path/to/logo.png') }}" alt="Logo" style="max-height:40px;display:block;margin-bottom:10px;"> --}}
                            <h5 style="color:#28a745;font-weight:700;">📩 رسالة جديدة من صفحة
                                تواصل معنا</h5>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:right;direction:rtl;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="direction:rtl;text-align:right;">
                                <tr>
                                    <td style=>
                                        <strong style="display:inline-block;color:#000;">الاسم:</strong>
                                        <span style="color:#333;">{{ $data['name'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style=>
                                        <strong style="display:inline-block;width:90px;color:#000;">الإيميل:</strong>
                                        <span style="color:#333;">{{ $data['email'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong style="display:inline-block;width:90px;color:#000;">الهاتف:</strong>
                                        <span style="color:#333;">{{ $data['number'] ?? '---' }}</span>
                                    </td>
                                </tr>
                            </table>

                            <hr style="border:none;border-top:1px solid #eee;margin:16px 0;">

                            <p style="font-weight:700;color:#000;">الرسالة:</p>
                            <p style="color:#444;line-height:1.6;white-space:pre-wrap;">{{ $data['message'] }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background:#fafafa;border-top:1px solid #eee;text-align:right;direction:rtl;">
                            <p style="margin:0;font-size:12px;color:#888;">تم إرسال هذه الرسالة من موقعك الرسمي.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
