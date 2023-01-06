<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $rfq->ref }} - {{$rfq->subject}}</title>
    <style>
        /*@charset "utf-8";*/
        /* CSS Document */

        .pdf_page {
            border: 2px solid #3b3b3b;
            padding: 20px;
            width: 80%;
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
            width: 35%;
            float: left;
            margin-left: 18%;
            border: 1px solid #9C9C9C;
            padding: 26px;
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

        .btn:not(:disabled):not(.disabled) {
            cursor: pointer;
        }
        [type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
            cursor: pointer;
        }
        button:not(:disabled), [type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled) {
            cursor: pointer;
        }
        .btn-outline-success {
            --bs-btn-color: #198754;
            --bs-btn-border-color: #198754;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #198754;
            --bs-btn-hover-border-color: #198754;
            --bs-btn-focus-shadow-rgb: 25,135,84;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #198754;
            --bs-btn-active-border-color: #198754;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #198754;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #198754;
            --bs-gradient: none;
        }
        .btn {
            --bs-btn-padding-x: 0.75rem;
            --bs-btn-padding-y: 0.375rem;
            --bs-btn-font-family: ;
            --bs-btn-font-size: 1rem;
            --bs-btn-font-weight: 400;
            --bs-btn-line-height: 1.5;
            --bs-btn-color: #212529;
            --bs-btn-bg: transparent;
            --bs-btn-border-width: 1px;
            --bs-btn-border-color: transparent;
            --bs-btn-border-radius: 0.375rem;
            --bs-btn-hover-border-color: transparent;
            --bs-btn-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15),0 1px 1px rgba(0, 0, 0, 0.075);
            --bs-btn-disabled-opacity: 0.65;
            --bs-btn-focus-box-shadow: 0 0 0 0.25rem rgba(var(--bs-btn-focus-shadow-rgb), .5);
            display: inline-block;
            padding: var(--bs-btn-padding-y) var(--bs-btn-padding-x);
            font-family: var(--bs-btn-font-family);
            font-size: var(--bs-btn-font-size);
            font-weight: var(--bs-btn-font-weight);
            line-height: var(--bs-btn-line-height);
            color: var(--bs-btn-color);
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            border: var(--bs-btn-border-width) solid var(--bs-btn-border-color);
            border-radius: var(--bs-btn-border-radius);
            background-color: var(--bs-btn-bg);
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>
</head>

<body>
<div class="pdf_page">
    <div class="top_logo">
        <div class="logo"> @if(!empty($rfq->c_logo))
                <img src="{{ env('APP_URL').$rfq->c_logo }}" alt="{{ $rfq->ref }}" >
            @else
                &nbsp;&nbsp;
            @endif </div>
        <div class="left_input">
            <p>Date: {{date('d-m-Y',strtotime($rfq->created_at))}}</p>
            <p>REF: {{ $rfq->ref }}</p>
        </div>
        <div class="right_input">
            <p>Project Name: {{$rfq->project_name}}</p>
            <p>Package: {{$rfq->package}}</p>
        </div>
    </div>
    <!--Next-->
    <div class="two_textarea">
        <div class="left_textarea">
            <p>To:
                <b>Contact Name:</b> {{ (empty($rfq->_vendor->contact_name)?$rfq->_vendor->first_name.' '.$rfq->_vendor->last_name:$rfq->_vendor->contact_name)}}<br>
                <b>Designation:</b> {{ $rfq->_vendor->job_title }}<br>
                <b>Company:</b> {{ $rfq->_vendor->company_name }}<br>
            </p>
        </div>
        {{--        <div class="right_textarea">--}}
        {{--            <p>To: Mr. Marwan Soliman &#10; Sr. Sales Manager &#10; Vocera</p>--}}
        {{--        </div>--}}
    </div>
    <!--Next-->
    <div class="subject_request">
        <p><b>Subject: <u>{{$rfq->subject}}
                </u></b></p>
    </div>
    <!--Next-->

    <div class="client_message">
        {!! str_replace('WEBURL',env('APP_URL'),$rfq->body);  !!}
    </div>
    <div class="client_message" style="text-align: center;margin: 10px 0">
        <a href="{{\Illuminate\Support\Facades\URL::signedRoute('rfq-reply',['rfq'=>$rfq->id])}}" target="_blank" class="btn btn-outline-success">Reply To This Request For Quotation</a>
    </div>
    <div class="client_message">
        <h5 style="padding: 0;margin: 0;">Best Regards:</h5>
        <p style="display: inline-block;padding: 10px;color: black;">{{$rfq->_user->name}}<br>
            {!! $rfq->_user->position?$rfq->_user->position.'<br>':''!!}
            {!! $rfq->_user->company?$rfq->_user->company.'<br>':''!!}
            {!! $rfq->_user->phone?'M: '.$rfq->_user->phone.'<br>':''!!}
            E: {{$rfq->_user->email}}<br>
        </p>
    </div>
    <div class="line_last">
        <p>{{$rfq->user_details}}</p>
    </div>
</div>
</body>
</html>
