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
                  <table width="100%" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                      <td style="padding-bottom: 20px; font:18px Arial, sans-serif; line-height:24px; color: #1f2326;" valign="top">
                        <b>{{ $name ? 'Dear ' . $name . ',' : '' }}</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-bottom: 10px; font:14px Arial, sans-serif; line-height:18px; color: #1f2326;" valign="top">
                        Congratulations. It appears you meet the eligibility criteria of the following Canadian immigration pathway(s): <br>
                        <ul style="padding-left: 0; margin-left: 25px; margin-top: 14px; margin-bottom: 14px; list-style: outside disc; color: #1f2326; font:14px Arial, sans-serif; line-height:18px;">
                          @foreach ($programs as $program)
                          <li style="list-style-position: outside;">{{$program}}</li>
                          @endforeach
                        </ul>
                        Please visit MigrationAssistant to see for yourself. <br><br>
                        A representative from our Campbell Cohen Immigration Law Firm will contact you shortly to discuss how we can help you prepare your Canadian immigration application. <br><br>

                        will use its over 45 years of experience to support you. We have over 60 immigration lawyers, paralegals, and other professionals who are dedicated to helping our clients move to Canada.<br>
                        Our services to you include:

                        <ul style="padding-left: 0; margin-left: 25px; margin-top: 14px; margin-bottom: 14px; list-style: outside disc; color: #1f2326; font:14px Arial, sans-serif; line-height:18px;">
                          <li style="list-style-position: outside;">Answering any questions you may have.</li>
                          <li style="list-style-position: outside;">Collecting your documents and preparing your Express Entry profile.</li>
                          <li style="list-style-position: outside;">Providing you with advice on how to improve your Comprehensive Ranking System (CRS) score. A higher CRS score will strengthen your chances of receiving a permanent residence invitation under Express Entry.</li>
                          <li style="list-style-position: outside;">Avoiding mistakes on your application that may cause delays or refusals.</li>
                          <li style="list-style-position: outside;">Communicating with the Canadian government on your behalf.</li>
                        </ul>

                        We look forward to connecting with you shortly and answering your questions. <br><br>

                        Sincerely,<br>
                        {{config('mail.from.name')}}<br>
                        <a style="color: #007bff; text-decoration: underline !important;" href="{{config('api-mm.app_domain')}}">{{config('api-mm.app_domain_name')}}</a>
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
