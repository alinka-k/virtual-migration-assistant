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
  a{
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
      <table width="600" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="box-shadow: 0 0 5px rgba(0,0,0,0.05);">
        <tr>
          <td height="30" style="font-size:0; line-height:0;"></td>
        </tr>
        <tr>
          <td align="center" style="font-size:0; line-height:0;">
            <a href="{{ url(config('api-mm.frontend_url')) }}">
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
                  <table>
                    <tbody>
                    <tr>
                      <td style="padding-bottom: 10px; font:14px Arial, sans-serif; line-height:18px; color: #1f2326; width: 80px;" valign="top">
                        <b style="color:#1f2326;">Full name:</b>
                      </td>
                      <td style="padding-bottom: 10px; font:14px Arial, sans-serif; line-height:18px; color: #1f2326;" valign="top">
                        {{$fullName}}
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-bottom: 10px; font:14px Arial, sans-serif; line-height:18px; color: #1f2326; width: 80px;" valign="top">
                        <b style="color:#1f2326;">E-mail:</b>
                      </td>
                      <td style="padding-bottom: 10px; font:14px Arial, sans-serif; line-height:18px; color: #1f2326;" valign="top">
                        <a href="mailto:{{$email}}" style="text-align: left; color: #007bff !important; text-decoration: underline !important;">{{$email}}</a>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-bottom: 10px; font:14px Arial, sans-serif; line-height:18px; color: #1f2326; width: 80px;" valign="top">
                        <b style="color: #1f2326;">Question:</b>
                      </td>
                      <td style="padding-bottom: 10px; font:14px Arial, sans-serif; line-height:18px; color: #1f2326;" valign="top">
                        {{$question}}
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-bottom: 10px; padding-top: 10px; border-top: 1px solid #ccc; font:14px Arial, sans-serif; line-height:18px; color: #1f2326;" colspan="2"  valign="top">
                        <b style="color: #1f2326;">{{ $shouldReceiveNewsletter ? 'Send' : 'Don\'t send'}}</b> me the free Canadian Immigration Newsletter by email
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
            <a style="color: #fff !important; text-decoration: underline !important;" target="_blank" href="{{config('api-mm.app_domain')}}">{{config('api-mm.app_domain_name')}}</a> |
            All rights reserved.
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
