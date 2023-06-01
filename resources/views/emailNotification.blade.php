{{--@component('mail::message')--}}
{{--# Introduction--}}

{{--The body of your message.--}}

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

{{--Thanks,<br>--}}
{{--{{ config('app.name') }}--}}
{{--Thanks,--}}
{{--@endcomponent--}}

        <!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <title>{{$data['subject']}}</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 14px; line-height: 1.5; color: #333;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td style="background-color: #f7f7f7; padding: 30px 0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tr>
                    <td style="padding: 20px; background-color: #fff;">
                        <h2 style="font-size: 18px; margin: 0 0 20px; color: #0088cc;">{{$data['subject']}}</h2>
                        <p style="margin: 0 0 20px;">Good Day,</p>
                        <p style="margin: 0 0 20px;">{{$data['body']}}</p>

                        <p style="margin: 0 0 20px; font-size: 14px">
{{--                            Mall:{{$data['body']}}<br>--}}
                            Project title: <b>{{$data['title']}}</b> <br>
                            Proposal target date: <b>{{$data['targetDate']}}</b> <br>
                            Project status : <b>{{$data['status']}}</b>
                        </p>



{{--                        <table border="0" cellpadding="0" cellspacing="0" width="100%">--}}
{{--                            <tr>--}}
{{--                                <td align="center" style="padding: 20px 0;">--}}
{{--                                    <table border="0" cellpadding="0" cellspacing="0">--}}
{{--                                        <tr>--}}
{{--                                            <td align="center" style="border-radius: 3px;" bgcolor="#007bff">--}}
{{--                                                <a href="https://pm.philcom.com" target="_blank" style="padding: 12px 20px; font-size: 16px; color: #fff; text-decoration: none; display: inline-block;">--}}
{{--                                                    View--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    </table>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        </table>--}}
{{--                        @component('mail::button', ['url' => ''])--}}
{{--                        View--}}
{{--                        @endcomponent--}}

                        <a href="https://pm.philcom.com">Click here to view</a>

{{--                        <p></p>--}}
                        <p style="margin: 40px 0 0;">Thanks,</p>
                        <p style="margin: 0;">Project Management System</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
{{--        <!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <title>Email Notification</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--<table cellpadding="0" cellspacing="0" width="100%" style="background-color: #f4f4f4; color: #555555; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.4; margin: 0; padding: 0;">--}}
{{--    <tr>--}}
{{--        <td align="center" style="padding: 20px;">--}}
{{--            <table cellpadding="0" cellspacing="0" width="100%" style="max-width: 580px;">--}}
{{--                <tr>--}}
{{--                    <td align="center" style="background-color: #ffffff; padding: 40px; border-radius: 4px;">--}}
{{--                        <h2 style="color: #0088cc;">Subject: New Request Created</h2>--}}
{{--                        <p>Dear PM Supervisors,</p>--}}
{{--                        <p>A new request has been created in the project management system. Please log in to the system to review the request and take necessary action.</p>--}}
{{--                        <table cellpadding="0" cellspacing="0" style="margin-top: 20px;">--}}
{{--                            <tr>--}}
{{--                                <td align="center">--}}
{{--                                    <a href="systemlink.com" style="display: inline-block; background-color: #0088cc; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 4px;">Click here to log in and take action</a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        </table>--}}
{{--                        <p>Thank you,</p>--}}
{{--                        <p>[Your Name]</p>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            </table>--}}
{{--        </td>--}}
{{--    </tr>--}}
{{--</table>--}}
{{--</body>--}}
{{--</html>--}}




