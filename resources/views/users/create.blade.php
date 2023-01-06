<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create User
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('users.store') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md  bg-white">
                        <div class="row m-3 p-3">
                        <div class="col-sm-12 ">
                        <div class="input-group mb-3 ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Name:
                                </span>
                            </div>
                            <input type="text" name="name" id="name" class="form-control " placeholder="user name"
                                   value="{{ old('name', '') }}" />
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Email:
                                </span>
                                </div>
                            <input type="email" name="email" id="email" class="form-control" placeholder="email"
                                   value="{{ old('email', '') }}" />
                            @error('email')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>

                            <div class="col-sm-12">
                                <div class="input-group mb-3 ">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="basiaddon1">
                                        Company:
                                    </span>
                                    </div>
                                    <input type="text" name="company" id="name" class="form-control " placeholder="company"
                                           value="{{ old('company', '') }}" />
                                    @error('company')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="input-group mb-3 ">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="basiaddon1">
                                        Position at Company:
                                    </span>
                                    </div>
                                    <input type="text" name="position" id="name" class="form-control " placeholder="position"
                                           value="{{ old('position', '') }}" />
                                    @error('position')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="input-group mb-3 ">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="basiaddon1">
                                        Contact No:
                                    </span>
                                    </div>
                                    <input type="text" name="phone" id="name" class="form-control " placeholder="Contact No."
                                           value="{{ old('phone', '') }}" />
                                    @error('phone')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        <div class="col-sm-12">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Password:
                                </span>
                                </div>
                            <input type="password" name="password" id="password" class="form-control" placeholder="password" />
                            @error('password')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Role:
                                </span>
                                </div>
                            <select name="roles" class="form-control "  >
                                @foreach($roles as $id => $role)
                                    <option value="{{ $id }}" >{{ $role }}</option>
                                @endforeach
                            </select>
                        {{--    <select name="roles[]" id="roles" class="form-multiselect block" multiple="multiple">
                                @foreach($roles as $id => $role)
                                    <option value="{{ $id }}"{{ in_array($id, old('roles', [])) ? ' selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select> --}}
                            @error('roles')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>
                    </div>
                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
