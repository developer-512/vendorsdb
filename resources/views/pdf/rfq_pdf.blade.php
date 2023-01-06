<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $data->ref }} - {{$data->subject}} - {{ $data->_vendor->company_name }}</title>
    <style>
        /*@charset "utf-8";*/
        /* CSS Document */

        .pdf_page {
            border: 2px solid #3b3b3b;
            padding: 10px;
            width: 100%;
            /*margin: 0 auto;*/
        }
        .pdf_page .top_logo {
            width: 100%;
            display: inline-block;
        }
        .pdf_page .top_logo img {
            width: 90%;
        }
        .pdf_page .top_logo .logo {
            width: 20%;
            float: left;
        }
        .pdf_page .top_logo .left_input {
            width: 40%;
            float: left;
        }
        .pdf_page .top_logo .right_input {
            width: 40%;
            float: left;
        }
        .pdf_page .top_logo p {
            width: 90%;
            padding: 10px;
            border: 1px solid #9C9C9C;
        }
        /*Next*/

        .pdf_page .two_textarea {
            width: 100%;
            display: inline-block;
        }
        .pdf_page .left_textarea p {
            /*width: 35%;*/
            /*float: left;*/
            /*margin-left: 18%;*/
            border: 1px solid #9C9C9C;
            padding: 13px;
        }
        .pdf_page .right_textarea p {
            width: 33%;
            border: 1px solid #9C9C9C;
            float: left;
            padding: 26px;
            margin-left: 33px;
        }
        .pdf_page textarea {
            padding: 10px 30px;
            width: 86%;
        }
        .pdf_page .right_textarea textarea {
            width: 90%;
        }
        .pdf_page .subject_request {
            text-align: center;
        }
        .pdf_page .subject_request p {
            letter-spacing: 2px;
        }
        .client_message .upload-btn-wrapper {
            /*position: relative;*/
            /*overflow: hidden;*/
            /*display: inline-block;*/
            max-width: 650px!important;
            width: 100%;

        }
        .client_message .btn {
            border: none;
            color: black;
            background-color: white;
            padding: 2px 8px;
            border-radius: 8px;
            font-size: 14px;
            /* font-weight: bold; */
            /* cursor: context-menu; */
            cursor: pointer;
        }
        .client_message .upload-btn-wrapper input[type=file] {
            left: 169px;
            top: 105px;
            opacity: 0;
            position: absolute;
            cursor: pointer;
        }
        .client_message input {
            border: none;
            border-bottom: 1px solid black;
            margin-top: 5px;
        }
        .line_last {
            border-top: 3px solid black;
            text-align: center;
        }
        .border-1{
            border: 1px solid;
            padding: 0 10px;
        }
        table{

        }
    </style>
</head>

<body>
    <table cellpadding="0" class="pdf_page" cellspacing="3"  style="border-spacing: 0;table-layout: fixed;" >
        <tbody>
        <tr>
            <td>
                <table style="width: 650px;table-layout: fixed;">
                    <tr>
                        <td style="width: 25%">
                            <table style="width: 150px;table-layout: fixed;">
                                <tr>
                                    <td>
                                        <div class="logo">
                                            @if(!empty($data->c_logo))
                                                <img src="{{ env('APP_URL').$data->c_logo }}" style="max-width:150px" alt="{{ $data->ref }}" >
                                            @else
                                                &nbsp;&nbsp;
                                            @endif
                                        </div>

                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 75%" >
                            <table cellspacing="3" style="width: 100%;table-layout: fixed;">
                                <tr>
                                    <td class="border-1">
                                        <p>Date: {{date('d-m-Y',strtotime($data->created_at))}}</p>
                                    </td>
                                    <td class="border-1">
                                        <p>Project Name: {{$data->project_name}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-1">
                                        <p>REF: {{ $data->ref }}</p>
                                    </td>
                                    <td class="border-1">
                                        <p>Package: {{$data->package}}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>

        </tr>
        <tr>
            <td>
                <table style="width: 100%;table-layout: fixed;">
                    <tr>
                        <td style="width: 25%">&nbsp;</td>
                        <td class="border-1" ><p>To: <br>
                                <b>Contact Name:</b> {{ (empty($data->_vendor->contact_name)?$data->_vendor->first_name.' '.$data->_vendor->last_name:$data->_vendor->contact_name)}}<br>
                                <b>Designation:</b> {{ $data->_vendor->job_title }}<br>
                                <b>Company:</b> {{ $data->_vendor->company_name }}<br>
                            </p></td>
                        <td style="width: 25%">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="600" style="width: 100%;table-layout: fixed;">
                    <tr>
                        <td>
                            <div class="subject_request" style="font-size: 11px">
                                <p><b>Subject: <u>{{$data->subject}}
                                        </u></b></p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="600" style="width: 100%;table-layout: fixed;">
                    <tr>
                        <td width="600">
                            <div class="client_message" style="font-size: 11px">
                                {!! str_replace('WEBURL',env('APP_URL'),$data->body); !!}
                            </div>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 100%;table-layout: fixed;">
                    <tr>
                        <td>
                            <div class="client_message" style="margin: 5px 0 10px 0;">
                                <h5 style="padding: 0;margin: 10px 0 0 0;">Best Regards:</h5>
                                <p style="display: inline-block;margin: 0">{{$data->_user->name}}<br>
                                    {!! $data->_user->position?$data->_user->position.'<br>':''!!}
                                    {!! $data->_user->company?$data->_user->company.'<br>':''!!}
                                    {!! $data->_user->phone?'M: '.$data->_user->phone.'<br>':''!!}
                                    E: {{$data->_user->email}}<br>
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="600" style="width: 100%;table-layout: fixed;">
                    <tr>
                        <td>
                            <div class="line_last">
                                <p>{{$data->user_details}}</p>
                            </div>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>
</html>
