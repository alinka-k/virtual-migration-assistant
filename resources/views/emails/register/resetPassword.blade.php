<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="color-scheme" content="light">
  <meta name="supported-color-schemes" content="light">
</head>
<body style="margin:0; padding:0;" bgcolor="#f4f6fa" link="#fff">
<style>
  body{
    -ms-text-size-adjust: none;
    -webkit-text-size-adjust: none;
  }
  .ExternalClass {
    width: 100% !important;
  }
  a {
    color: #007bff;
    text-decoration: underline;
  }
  #email a:hover, a:hover {
    text-decoration: underline !important
  }
</style>

<table width="100%" cellspacing="0" cellpadding="20" bgcolor="#f4f6fa">
  <tr>
    <td>
      <table width="500" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="box-shadow: 0 0 5px rgba(0,0,0,0.05);">
        <tr>
          <td height="30" style="font-size:0; line-height:0;"></td>
        </tr>
        <tr>
          <td align="center" style="font-size:0; line-height:0;">
            <a target="_blank" href="{{ url(config('api-mm.frontend_url')) }}">
              <img src="{{ url(config('api-mm.frontend_url')) . '/logo.png' }}" width="150" border="0" alt="Migration Assistant" />
            </a>
          </td>
        </tr>
        <tr>
          <td style="font:14px Arial, sans-serif; line-height:18px; color: #1f2326;">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="3" height="30" style="font-size:0; line-height:0;"></td>
              </tr>
              <tr>
                <td width="30" style="font-size:0; line-height:0;"></td>
                <td>
                  <table width="100%" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                      <td style="padding-bottom: 10px; font:18px Arial, sans-serif; line-height:18px; color: #1f2326;" valign="top">
                        <b>{{ $name ? 'Dear ' . $name . ',' : '' }}</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-bottom: 20px; font:14px Arial, sans-serif; line-height:18px; color: #1f2326;"
                          valign="top">
                        To reset your password, please click on the link below or copy and paste the address into your web browser.
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-bottom: 20px; font:14px Arial, sans-serif; line-height:18px; color: #1f2326;"
                          align="center" valign="top">
                        <a
                          href="{{ $resetPasswordUrl }}"
                          target="_blank"
                          style="color: #fff !important; display: inline-block; padding: 15px 20px; font:14px Arial, sans-serif; line-height:18px; font-weight: bold; text-decoration: none; border-radius: 4px; background-color: #F02040;">
                          Reset your password
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-bottom: 20px; font:14px Arial, sans-serif; line-height:18px; color: #1f2326;"
                          valign="top">
                        If you did not make this request, please log in and change your password.
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-top: 20px; padding-bottom: 20px; font:14px Arial, sans-serif; line-height:20px; color: #1f2326; border-top: 1px solid #ccc;" valign="top">
                        Sincerely,<br>
                        {{config('mail.from.name')}}<br>
                        <a style="color: #007bff; text-decoration: underline !important;" target="_blank" href="{{config('api-mm.app_domain')}}">{{config('api-mm.app_domain_name')}}</a>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-top: 20px; padding-bottom: 20px; font: 14px Arial, sans-serif; line-height:18px; color: #1f2326; border-top: 1px solid #ccc;" valign="top">
                        If you’re having trouble clicking the "Reset Your Password" button, copy and paste the URL below into your web browser:
                      </td>
                    </tr>
                    <tr>
                      <td style="word-break: break-all; padding-bottom: 10px; font: 14px Arial, sans-serif; line-height:18px; color: #1f2326;" valign="top">
                        {{ $resetPasswordUrl }}
                      </td>
                    </tr>

                    </tbody>
                  </table>
                </td>
                <td width="30" style="font-size:0; line-height:0;"></td>
              </tr>
              <tr>
                <td colspan="3" height="10" style="font-size:0; line-height:0;"></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td bgcolor="#f02040" style="padding: 15px; font:13px Arial, sans-serif; line-height:15px; color: #fff; text-align: center;">
            © {{ config('app.name') }} |
            <a style="color: #fff; text-decoration: underline !important;" target="_blank" href="{{config('api-mm.app_domain')}}">{{config('api-mm.app_domain_name')}}</a> |
            All rights reserved.
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
