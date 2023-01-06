<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Vendor: {{ $vendor->company_name }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 ">

            <div class="container  mb-3">
                <div class="row">
                    <div class="col-sm">
                        <a href="{{ route('vendors.index') }}" class="btn btn-info rounded">Back to list</a>
                    </div>
                </div>
            </div>
            <div class="container bg-white">

                <div class="row">
                    <div class="col-sm">
                        <table class="table min-w-full divide-y divide-gray-200 w-full">
                            <!-- Counter Field -->
                            <tr class="border-b">
                                <th scope="col" class="bg-gray-500">

                                    {!! Form::label('counter', 'Vendor ID:') !!}
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <p>{{ $vendor->id }}</p>
                                </td>
                            </tr>

                            <!-- Category Field -->
                            <tr class="border-b">
                                <th scope="col" class="bg-gray-500">
                                    {!! Form::label('category', 'Category:') !!}
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <p>{{ $vendor->_category->category_name }}</p>
                                </td>
                            </tr>

                            <!-- Contact Name Field -->
                            <tr class="border-b">
                                <th scope="col" class="bg-gray-500">
                                    {!! Form::label('contact_name', 'Contact Name:') !!}
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <p>{{ $vendor->contact_name }}</p>
                                </td>
                            </tr>

                            <!-- Keywords Field -->
                            <tr class="border-b">
                                <th scope="col" class="bg-gray-500">
                                    {!! Form::label('keywords', 'Keywords:') !!}
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <p>{{ $vendor->keywords }}</p>
                                </td>
                            </tr>

                            <!-- First Name Field -->
                            <tr class="border-b">
                                <th scope="col" class="bg-gray-500">
                                    {!! Form::label('first_name', 'First Name:') !!}
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <p>{{ $vendor->first_name }}</p>
                                </td>
                            </tr>

                            <!-- Last Name Field -->
                            <tr class="border-b">
                                <th scope="col" class="bg-gray-500">
                                    {!! Form::label('last_name', 'Last Name:') !!}
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <p>{{ $vendor->last_name }}</p>
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

                            <!-- Company Name Field -->
                            <tr class="border-b">
                                <th scope="col" class="bg-gray-500">
                                    {!! Form::label('company_name', 'Company Name:') !!}
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <p>{{ $vendor->company_name }}</p>
                                </td>
                            </tr> <tr class="border-b">
                                <th scope="col" class="bg-gray-500">
                                    {!! Form::label('website', 'Website:') !!}
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <p>{{ $vendor->website }}</p>
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

                            <!-- Job Title Field -->
                            <tr class="border-b">
                                <th scope="col" class="bg-gray-500">
                                    {!! Form::label('job_title', 'Job Title:') !!}
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <p>{{ $vendor->job_title }}</p>
                                </td>
                            </tr>

                            <!-- Business Phone Field -->
                            <tr class="border-b">
                                <th scope="col" class="bg-gray-500">
                                    {!! Form::label('business_phone', 'Business Phone:') !!}
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <p>{{ $vendor->business_phone }}</p>
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

                            <!-- Mobile Phone 2 Field -->
                            <tr class="border-b">
                                <th scope="col" class="bg-gray-500">
                                    {!! Form::label('mobile_phone_2', 'Mobile Phone 2:') !!}
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <p>{{ $vendor->mobile_phone_2 }}</p>
                                </td>
                            </tr>

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

                            <!-- Zip Code Field -->
                            <tr class="border-b">
                                <th scope="col" class="bg-gray-500">
                                    {!! Form::label('zip_code', 'Zip Code:') !!}
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <p>{{ $vendor->zip_code }}</p>
                                </td>
                            </tr>

                            <!-- Country Field -->
                            <tr class="border-b">
                                <th scope="col" class="bg-gray-500">
                                    {!! Form::label('country', 'Country:') !!}
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <p>{{ $vendor->country }}</p>
                                </td>
                            </tr>

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


                        {{--                       <table class="table min-w-full divide-y divide-gray-200 w-full">--}}
                        {{--                           <tr class="border-b">--}}
                        {{--                               <th scope="col" class="bg-gray-500">--}}
                        {{--                                   ID--}}
                        {{--                               </th>--}}
                        {{--                               <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">--}}
                        {{--                                   {{ $category->id }}--}}
                        {{--                               </td>--}}
                        {{--                           </tr>--}}
                        {{--                           <tr class="border-b">--}}
                        {{--                               <th scope="col" class="bg-gray-500">--}}
                        {{--                                   Name--}}
                        {{--                               </th>--}}
                        {{--                               <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">--}}
                        {{--                                   {{ $category->category_name }}--}}
                        {{--                               </td>--}}
                        {{--                           </tr>--}}
                        {{--                           <tr class="border-b">--}}
                        {{--                               <th scope="col" class="bg-gray-500">--}}
                        {{--                                   Parent--}}
                        {{--                               </th>--}}
                        {{--                               <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">--}}
                        {{--                                   {{ isset($category->get_parent->category_name)?$category->get_parent->category_name:'' }}--}}

                        {{--                               </td>--}}
                        {{--                           </tr>--}}

                        {{--                       </table>--}}
                    </div>
                </div><!--/.row-->
            </div>

            {{--            <div class="block mt-8">--}}
            {{--                <a href="{{ route('categories.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to list</a>--}}
            {{--            </div>--}}
        </div>
    </div>
</x-app-layout>
