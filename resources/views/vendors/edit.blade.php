<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Vendor
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('vendors.update', $vendor->id) }}">
                    @csrf
                    @method('put')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class=" overflow-hidden sm:rounded-md row">

                        <!-- Counter Field -->
                        <div class="col-sm-4">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
{{--                                    {!! Form::label('counter', 'Counter:') !!}--}}
                                    Vendor ID:
                                </span>
                                </div>

                                {!! Form::number('id', $vendor->id, ['class' => 'form-control','aria-describedby'=>"basiaddon1","disabled"=>"true"]) !!}
                            </div>
                        </div>


                        <!-- Category Field -->
                        <div class="form-group col-sm-4">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
Category:
                                </span>
                                </div>
                                {{--                            {!! Form::label('category', 'Category:') !!}--}}
                                {{--                            {!! Form::number('category', null, ['class' => 'form-control']) !!}--}}
                                {!! Form::select('category', $categories_array, old('category',$vendor->category), ['class' => 'form-control','placeholder' => 'Select Category...'])!!}

                            </div>
                        </div>

{{--                        <!-- Contact Name Field -->--}}
{{--                        <div class="form-group col-sm-4">--}}
{{--                            <div class="input-group mb-3 ">--}}
{{--                                <div class="input-group-prepend">--}}
{{--                                <span class="input-group-text" id="basiaddon1">--}}
{{--Contact Name:--}}
{{--                                </span>--}}
{{--                                </div>--}}
{{--                                --}}{{--                            {!! Form::label('contact_name', 'Contact Name:') !!}--}}
{{--                                {!! Form::text('contact_name', $vendor->contact_name, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <!-- Keywords Field -->
                        <div class="form-group col-sm-4">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
Keywords:
                                </span>
                                </div>

                                {{--                            {!! Form::label('keywords', 'Keywords:') !!}--}}
                                {!! Form::text('keywords', $vendor->keywords, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                            </div>
                        </div>
                        <!-- Keywords Field -->
                        <div class="form-group col-sm-4">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                Brands:
                                </span>
                                </div>

                                {{--                            {!! Form::label('keywords', 'Keywords:') !!}--}}
                                {!! Form::text('brands', $vendor->brands, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                            </div>
                        </div>

                        <!-- First Name Field -->
                        <div class="form-group col-sm-4">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    First Name:
                                </span>
                                </div>
                                {{--                                {!! Form::label('first_name', 'First Name:') !!}--}}
                                {!! Form::text('first_name', $vendor->first_name, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                            </div>
                        </div>

                        <!-- Last Name Field -->
                        <div class="form-group col-sm-4">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Last Name:
                                </span>
                                </div>
                                {{--                            {!! Form::label('last_name', 'Last Name:') !!}--}}
                                {!! Form::text('last_name', $vendor->last_name, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                            </div>
                        </div>
                    {{--
                                            <!-- Date Field -->
                                            <div class="form-group col-sm-4">
                                                <div class="input-group mb-3 ">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basiaddon1">
                                                        Date:
                                                    </span>
                                                    </div>

                                                {!! Form::text('date', null, ['class' => 'form-control','id'=>'date']) !!}
                                                </div>
                                            </div>

                                            @push('scripts')
                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                                                <script>
                                                $('#date').datetimepicker({
                                                        format: 'YYYY-MM-DD',
                                                    timepicker:false,
                                                        useCurrent: true,
                                                        icons: {
                                                            up: "icon-arrow-up-circle icons font-2xl",
                                                            down: "icon-arrow-down-circle icons font-2xl"
                                                        },
                                                        sideBySide: true
                                                    })
                                                </script>
                                        @endpush
                    --}}

                    <!-- Company Name Field -->
                        <div class="form-group col-sm-4">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Company Name:
                                </span>
                                </div>
                                {{--                            {!! Form::label('company_name', 'Company Name:') !!}--}}
                                {!! Form::text('company_name', $vendor->company_name, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                            </div>
                        </div>
                        <!-- Website Field -->
                        <div class="form-group col-sm-4">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Website:
                                </span>
                                </div>
                                {!! Form::text('website', $vendor->website, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                            </div>
                        </div>
                        <!-- Email Field -->
                        <div class="form-group col-sm-4">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Email:
                                </span>
                                </div>
                                {{--                            {!! Form::label('email', 'Email:') !!}--}}
                                {!! Form::email('email', $vendor->email, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                            </div>
                        </div>

                        <!-- Job Title Field -->
                        <div class="form-group col-sm-4">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Job Title:
                                </span>
                                </div>
                                {{--                            {!! Form::label('job_title', 'Job Title:') !!}--}}
                                {!! Form::text('job_title', $vendor->job_title, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                            </div>
                        </div>

                        <!-- Business Phone Field -->
                        <div class="form-group col-sm-4">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Business Phone:
                                </span>
                                </div>
                                {{--                            {!! Form::label('business_phone', 'Business Phone:') !!}--}}
                                {!! Form::text('business_phone', $vendor->business_phone, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                            </div>
                        </div>

                        <!-- Mobile Phone 1 Field -->
                        <div class="form-group col-sm-4">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Mobile Phone 1:
                                </span>
                                </div>
                                {{--                            {!! Form::label('mobile_phone_1', 'Mobile Phone 1:') !!}--}}
                                {!! Form::text('mobile_phone_1', $vendor->mobile_phone_1, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                            </div>
                        </div>

                        <!-- Mobile Phone 2 Field -->
                        <div class="form-group col-sm-4">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Mobile Phone 2:
                                </span>
                                </div>
                                {{--                            {!! Form::label('mobile_phone_2', 'Mobile Phone 2:') !!}--}}
                                {!! Form::text('mobile_phone_2', $vendor->mobile_phone_2, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Address Field -->
                        <div class="form-group col-sm-6 col-lg-6">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Address:
                                </span>
                                </div>
                                {{--                            {!! Form::label('address', 'Address:') !!}--}}
                                {!! Form::textarea('address', $vendor->address, ['class' => 'form-control','rows'=>8]) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <!-- City Field -->
                                <div class="form-group col-sm-12">
                                    <div class="input-group mb-3 ">
                                        <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    City:
                                </span>
                                        </div>
                                        {{--                            {!! Form::label('city', 'City:') !!}--}}
                                        {!! Form::text('city', $vendor->city, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                                    </div>
                                </div>

{{--                                <!-- Zip Code Field -->--}}
{{--                                <div class="form-group col-sm-12">--}}
{{--                                    <div class="input-group mb-3 ">--}}
{{--                                        <div class="input-group-prepend">--}}
{{--                                <span class="input-group-text" id="basiaddon1">--}}
{{--                                   Zip Code:--}}
{{--                                </span>--}}
{{--                                        </div>--}}
{{--                                        --}}{{--                            {!! Form::label('zip_code', 'Zip Code:') !!}--}}
{{--                                        {!! Form::text('zip_code', $vendor->zip_code, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <!-- Country Field -->
                                <div class="form-group col-sm-12">
                                    <div class="input-group mb-3 ">
                                        <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Country:
                                </span>
                                        </div>
                                        {{--                            {!! Form::label('country', 'Country:') !!}--}}
                                        {{--                {!! Form::text('country', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}--}}
                                        {!! Form::select('country', $countries, old('country',$vendor->country), ['class' => 'form-control','placeholder' => 'Select Country...'])!!}
                                    </div>
                                </div>
                            </div>
                        </div>


                    {{--                        <!-- Approval Field -->--}}
                    {{--                        <div class="form-group col-sm-6">--}}
                    {{--                            {!! Form::label('approval', 'Approval:') !!}--}}
                    {{--                            {!! Form::text('approval', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}--}}
                    {{--                        </div>--}}

                    {{--                        <!-- Active Field -->--}}
                    {{--                        <div class="form-group col-sm-6">--}}
                    {{--                            {!! Form::label('active', 'Active:') !!}--}}
                    {{--                            {!! Form::text('active', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}--}}
                    {{--                        </div>--}}

                    {{--                        <!-- Data By User Field -->--}}
                    {{--                        <div class="form-group col-sm-6">--}}
                    {{--                            {!! Form::label('data_by_user', 'Data By User:') !!}--}}
                    {{--                            {!! Form::number('data_by_user', null, ['class' => 'form-control']) !!}--}}
                    {{--                        </div>--}}

                    <!-- Submit Field -->
                        <div class="form-group col-sm-12 text-right ">
                            {!! Form::submit('Save', ['class' => 'btn btn-lg btn-primary']) !!}
                            <a href="{{ route('vendors.index') }}" class="btn btn-lg btn-secondary">Cancel</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>