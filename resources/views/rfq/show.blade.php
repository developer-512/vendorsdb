<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{ $request_for_quotation->ref }} - {{$request_for_quotation->subject}}
        </h2>
    </x-slot>
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
    </style>
    <div class="pdf_page">
        <div class="top_logo">
            <div class="logo">
                @if(!empty($request_for_quotation->c_logo))
                <img src="{{ env('APP_URL').$request_for_quotation->c_logo }}" alt="{{ $request_for_quotation->ref }}" >
                @else
                &nbsp;&nbsp;
                @endif
            </div>
            <div class="left_input">
                <p>Date: {{date('d-m-Y',strtotime($request_for_quotation->created_at))}}</p>
                <p>REF: {{ $request_for_quotation->ref }}</p>
            </div>
            <div class="right_input">
                <p>Project Name: {{$request_for_quotation->project_name}}</p>
                <p>Package: {{$request_for_quotation->package}}</p>
            </div>
        </div>
        <!--Next-->
        <div class="two_textarea">
            <div class="left_textarea">
                <p>To:
                    <b>Contact Name:</b> {{ (empty($request_for_quotation->_vendor->contact_name)?$request_for_quotation->_vendor->first_name.' '.$request_for_quotation->_vendor->last_name:$request_for_quotation->_vendor->contact_name)}}<br>
                    <b>Designation:</b> {{ $request_for_quotation->_vendor->job_title }}<br>
                    <b>Company:</b> {{ $request_for_quotation->_vendor->company_name }}<br>
                </p>
            </div>
            {{--        <div class="right_textarea">--}}
            {{--            <p>To: Mr. Marwan Soliman &#10; Sr. Sales Manager &#10; Vocera</p>--}}
            {{--        </div>--}}
        </div>
        <!--Next-->
        <div class="subject_request">
            <p><b>Subject: <u>{{$request_for_quotation->subject}}
                    </u></b></p>
        </div>
        <!--Next-->

        <div class="client_message">
            {!! str_replace('WEBURL',env('APP_URL'),$request_for_quotation->body);  !!}
        </div>

        <div class="client_message" style="display: inline-block">
            <h5 style="padding: 0;margin: 0;">Best Regards:</h5>
            <p style="display: inline-block;padding: 10px;color: black;">{{$request_for_quotation->_user->name}}<br>
                {!! $request_for_quotation->_user->position?$request_for_quotation->_user->position.'<br>':''!!}
                {!! $request_for_quotation->_user->company?$request_for_quotation->_user->company.'<br>':''!!}
                {!! $request_for_quotation->_user->phone?'M: '.$request_for_quotation->_user->phone.'<br>':''!!}
E: {{$request_for_quotation->_user->email}}<br>
</p>
</div>
<div class="client_message" style="display: inline-block;float: right">
<h5 style="padding: 0;margin: 0;">This RFQ is sent to:</h5>
<p style="display: inline-block;padding: 10px;color: black;">
@foreach($request_for_quotation->vendor_emails_data as $vendor_data)
    <b>{{(empty($vendor_data->contact_name)?$vendor_data->first_name.' '.$vendor_data->last_name:$vendor_data->contact_name).' - '.$vendor_data->email}}</b><br>
@endforeach
@php $emails=explode(';',$request_for_quotation->emails); @endphp
@foreach($emails as $email)
    {{$email}}<br>
    @endforeach

</p>
</div>
<div class="line_last">
<p>{{$request_for_quotation->user_details}}</p>
</div>
</div>
</x-app-layout>
