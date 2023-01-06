<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $data->ref }} - {{$data->subject}}</title>
    <style>
        /*@charset "utf-8";*/
        /* CSS Document */

        .pdf_page {
            border: 2px solid #3b3b3b;
            padding: 20px;
            width: 700px;
            margin: 0 auto;
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
            position: relative;
            overflow: hidden;
            display: inline-block;
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

    </style>
</head>

<body>
<div class="pdf_page">
    <table cellpadding="0" cellspacing="0" style="border-spacing: 0" width="650">
        <tr>
            <td>
                <div class="top_logo">
                    <div class="logo"> <img src="{{ env('APP_URL').$data->c_logo }}" alt="{{ $data->ref }}" > </div>
                    <div class="left_input">
                        <p>Date: {{date('d-m-Y',strtotime($data->created_at))}}</p>
                        <p>REF: {{ $data->ref }}</p>
                    </div>
                    <div class="right_input">
                        <p>Project Name: {{$data->project_name}}</p>
                        <p>Package: {{$data->package}}</p>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <!--Next-->
                <div class="two_textarea">
                    <div class="left_textarea">
                        <p>To: <br> <b>Contact Name:</b> {{ $data->_vendor->contact_name }}<br>
                            <b>Company:</b> {{ $data->_vendor->company_name }}<br>


                        </p>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <!--Next-->
                <div class="subject_request">
                    <p><b>Subject: <u>{{$data->subject}}
                            </u></b></p>
                </div>
                <!--Next-->
            </td>
        </tr>
        <tr>
            <td>
                <div class="client_message">
                    {!! $data->body !!}
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="client_message">
                    <h5 style="padding: 0;margin: 0;">Best Regards:</h5>
                    <p style="display: inline-block;padding: 10px;color: white;">{{$data->_user->name}}<br>
                        {{$data->_user->position}}<br>
                        {{$data->_user->company}}<br>
                        M: {{$data->_user->phone}}<br>
                        E: {{$data->_user->email}}<br>
                    </p>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="line_last">
                    <p>{{$data->user_details}}</p>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
