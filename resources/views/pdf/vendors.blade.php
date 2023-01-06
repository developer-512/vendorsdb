<!DOCTYPE html>
<html>
<head>
    <title>
        Vendors Export
    </title>
    <style>
        /*@charset "utf-8";*/
        /* CSS Document */

        .pdf_page {
            /*border: 2px solid #3b3b3b;*/
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
margin: 0;
            padding: 0;
        }
        table tr{
            padding: 0;
        }
        table tr td{
            padding: 0!important;
        }
        th{
            text-align: left;
            color: blue;
            padding: 0 10px 0 3px;
            width: 150px;
        }
        td{
            text-align: left;
            padding-top: 0;
            padding-bottom: 0;
        }

        .page_break { page-break-after: always;}
        .page_break:last-child { page-break-after: avoid;}

    </style>
    <!-- Styles -->
{{--    <link rel="stylesheet" href="{{ mix('css/dashboard.css') }}">--}}

</head>

<body>
<table cellpadding="0" class="pdf_page" cellspacing="0" border="0"  style="border-spacing: 0;table-layout: fixed;" >
    <tbody>
    <tr>
        <td>

                @foreach($vendors as $vendor)
                <table style="width: 100%;table-layout: fixed;" class="page_break" border="1">
                    <tr class="border-b">
                        <td>
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <th scope="col" class="bg-gray-500">

                                        {!! Form::label('counter', 'Vendor ID:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ $vendor->id }}</p>
                                    </td>
                                </tr>
                                <!-- Date Field -->
                                <tr class="border-b">
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('date', 'Date:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ $vendor->date }}</p>
                                    </td>
                                </tr>

                                 <tr>
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('company_name', 'Company Name:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ $vendor->company_name }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('contact_name', 'Contact Name:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ $vendor->contact_name }}</p>
                                    </td>
                                </tr>
                                <!-- Job Title Field -->
                                <tr class="border-b">
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('job_title', 'Job Title:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ $vendor->job_title }}</p>
                                    </td>
                                </tr>
                                <!-- Mobile Phone 1 Field -->
                                <tr class="border-b">
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('mobile_phone_1', 'Mobile Phone 1:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ $vendor->mobile_phone_1 }}</p>
                                    </td>
                                </tr>

                                <!-- Email Field -->
                                <tr class="border-b">
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('email', 'Email:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ $vendor->email }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
{{--                    <tr>--}}
{{--                        <td>--}}
{{--                            <table>--}}



{{--                                <!-- Business Phone Field -->--}}
{{--                                <tr class="border-b">--}}
{{--                                    <th scope="col" class="bg-gray-500">--}}
{{--                                        {!! Form::label('business_phone', 'Business Phone:') !!}--}}
{{--                                    </th>--}}
{{--                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">--}}
{{--                                        <p>{{ $vendor->business_phone }}</p>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}



{{--                                <!-- Mobile Phone 2 Field -->--}}
{{--                                <tr class="border-b">--}}
{{--                                    <th scope="col" class="bg-gray-500">--}}
{{--                                        {!! Form::label('mobile_phone_2', 'Mobile Phone 2:') !!}--}}
{{--                                    </th>--}}
{{--                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">--}}
{{--                                        <p>{{ $vendor->mobile_phone_2 }}</p>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            </table>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                    <tr>
                        <td>
                            <table>


                                <!-- Address Field -->
                                <tr class="border-b">
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('address', 'Address:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ $vendor->address }}</p>
                                    </td>
                                </tr>

                                <!-- City Field -->
                                <tr class="border-b">
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('city', 'City:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ $vendor->city }}</p>
                                    </td>
                                </tr>

{{--                                <!-- Zip Code Field -->--}}
{{--                                <tr class="border-b">--}}
{{--                                    <th scope="col" class="bg-gray-500">--}}
{{--                                        {!! Form::label('zip_code', 'Zip Code:') !!}--}}
{{--                                    </th>--}}
{{--                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">--}}
{{--                                        <p>{{ $vendor->zip_code }}</p>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}

                                <!-- Country Field -->
                                <tr class="border-b">
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('country', 'Country:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ $vendor->country }}</p>
                                    </td>
                                </tr>

                                <tr class="border-b">
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('website', 'Website:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ $vendor->website }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <!-- Category Field -->
                                <tr class="border-b">
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('category', 'Category:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p> @if(isset($vendor->categories->parent)&&$vendor->categories->parent>0)
                                                <b> Parent:</b> {{isset($vendor->categories->get_parent->category_name)?$vendor->categories->get_parent->category_name:'*Category Missing*'}}<br>
                                                <b>Sub Category:</b> {{ $vendor->categories->category_name}}
                                            @else
                                                <b>{{ isset($vendor->categories->category_name)?$vendor->categories->category_name:'*Category Missing*'}}</b>
                                            @endif</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <!-- Keywords Field -->
                                <tr class="border-b">
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('keywords', 'Keywords:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ $vendor->keywords }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <!-- Keywords Field -->
                                <tr class="border-b">
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('keywords', 'Brands:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ $vendor->brands }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>

                                <!-- Approval Field -->
                                <tr class="border-b">
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('approval', 'Approval:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ $vendor->approval==1?'Approved':'Not Approved' }}</p>
                                    </td>
                                </tr>

                                <!-- Active Field -->
                                <tr class="border-b">
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('active', 'Active:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ $vendor->active==1?'Active':'Not Active' }}</p>
                                    </td>
                                </tr>

                                <!-- Data By User Field -->
                                <tr class="border-b">
                                    <th scope="col" class="bg-gray-500">
                                        {!! Form::label('data_by_user', 'Data By User:') !!}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <p>{{ isset($vendor->_user->name)?$vendor->_user->name:'*Missing User*' }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                @endforeach

        </td>
    </tr>
    </tbody>
</table>
</body>
</html>