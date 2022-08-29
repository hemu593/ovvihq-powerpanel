<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Complaint - {{$SITE_NAME}}</title>
        <style type="text/css">
            body {
                margin: 0;
                padding: 0;
                background: #ffffff;
                font-family: 'Segoe UI', 'Segoe WP', 'Segoe UI Regular', 'Helvetica Neue', Helvetica, Tahoma, 'Arial Unicode MS', Sans-serif;
            }
            table {
                border-collapse: collapse
            }
            table td {
                border-collapse: collapse
            }
            img {
                border: none;
            }
        </style>
    </head>

    <body>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="15" align="left" valign="top">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top"><table width="600" border="0" align="left" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="left" valign="middle" style="padding:15px 0;">
                            <a href="{{ url('/') }}" target="_blank" title="{{$SITE_NAME}}"><img src="{!! App\Helpers\resize_image::resize($FRONT_LOGO_ID) !!}" alt="{{$SITE_NAME}}" width="120px" height="120px" style="display:inline-block;" /></a>
                        </td>
                    </tr>
                    @if($user=='admin')
                        <tr>
                            <td align="left" valign="top" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:600; color:#000000; padding:10px 0;">Dear Administrator,</td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:20px; font-weight:400; color:#000000; padding:10px 0;">A new complaint has been submitted from {{ $first_name }} against {{$company}} and below are the details for it:</td>
                        </tr>
                    @else
                        <tr>
                            <td align="left" valign="top" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:600; color:#000000; padding:10px 0;">
                            Dear {{ $first_name }},
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:20px; font-weight:400; color:#000000; padding:10px 0;">
                                Your complaint has been submitted against {{$company}} and below are the details for it:
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td align="left" valign="top" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:13px; line-height:19.5px; font-weight:400; color:#000000; padding:5px 0 0 0;">
                            Complaints Details
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="padding:10px 0 0 0;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td width="30%" align="left" valign="middle" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:600; color:#000000; padding:0 0 10px 0;">Name:</td>
                                        <td width="70%" align="left" valign="middle" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:400; color:#000000; padding:0 0 10px 5px; text-transform:capitalize;">{{ $first_name }}</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="middle" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:600; color:#000000; padding:0 0 10px 0;">Email:</td>
                                        <td align="left" valign="middle" style="padding:0 0 10px 5px;"><a href="mailto:{{ $email }}" target="_blank" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:400; color:#000000; text-decoration:none;">{{ $email }}</a></td>
                                    </tr>
                                    @if(isset($phone_number) && !empty($phone_number))
                                        <tr>
                                            <td align="left" valign="middle" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:600; color:#000000; padding:0 0 10px 0;">Telephone Number :</td>
                                            <td align="left" valign="middle" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:400; color:#000000; padding:0 0 10px 5px;">{{ $phone_number }}</td>
                                        </tr>
                                    @endif
                                    @if(isset($complaint_pobox) && !empty($complaint_pobox))
                                        <tr>
                                            <td align="left" valign="middle" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:600; color:#000000; padding:0 0 10px 0;">PO Box & Pysical Address :</td>
                                            <td align="left" valign="middle" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:400; color:#000000; padding:0 0 10px 5px;">{{ $complaint_pobox }}</td>
                                        </tr>
                                    @endif
                                    @if(isset($company) && !empty($company))
                                        <tr>
                                            <td align="left" valign="middle" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:600; color:#000000; padding:0 0 10px 0;">Company Complained Against :</td>
                                            <td align="left" valign="middle" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:400; color:#000000; padding:0 0 10px 5px;">{{ $company }}</td>
                                        </tr>
                                    @endif
                                    @if(isset($dateOfComplaint) && !empty($dateOfComplaint))
                                    <tr>
                                        <td align="left" valign="middle" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:600; color:#000000; padding:0 0 10px 0;">Date complaint filed with Company :</td>
                                        <td align="left" valign="middle" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:400; color:#000000; padding:0 0 10px 5px;">{{ $dateOfComplaint }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($complaint_details) && !empty($complaint_details))
                                    <tr>
                                        <td align="left" valign="middle" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:600; color:#000000; padding:0 0 10px 0;">Full details of complaint:</td>
                                        <td align="left" valign="middle" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:400; color:#000000; padding:0 0 10px 5px;">{{ $complaint_details }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($complaint_response) && !empty($complaint_response))
                                    <tr>
                                        <td align="left" valign="middle" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:600; color:#000000; padding:0 0 10px 0;">Response by Company:</td>
                                        <td align="left" valign="middle" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:400; color:#000000; padding:0 0 10px 5px;">{{ $complaint_response }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:16px; line-height:20px; font-weight:600; color:#000000; padding:10px 0 0 0;">Best Regards,</td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="padding:0 0 15px 0;"><a href="#" target="_blank" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; font-size:14px; line-height:16px; font-weight:400; color:#000000; text-decoration:none;">{{ $SITE_NAME }}</a></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif;font-size:13px;line-height:19.5px;font-weight:400;color:#222222;padding:15px 0 0 0;border-top:1px solid #e8e8e8">{!!$FOOTER_COPYRIGHTS!!} {!! date('Y') !!} {{$SITE_NAME}}. All Rights Reserved.</td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif;font-size:13px;line-height:19.5px;font-weight:400;color:#222222;padding:0 0 0 0">Powered by <a href="https://www.netclues.ky/" rel="nofollow" style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif;font-size:13px;line-height:19.5px;font-weight:400;color:#222222;text-decoration:none" target="_blank">Netclues!</a></td>
                    </tr>
                </table></td>
            </tr>
        </table>
    </body>

</html>
