<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Category
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">Category Name <sup>*</sup></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Category Name" aria-label="category_name" name="category_name" aria-describedby="basiaddon1" value="{{ old('category_name', '') }}">
                            @error('category_name')
                            <p class="alert-warning">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Details (optional)</span>
                            </div>
                            <textarea class="form-control" aria-label="With textarea" name="category_details">{{old('category_details','')}}</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Parent Category</label>
                            </div>
                            <select class="custom-select" name="parent" id="inputGroupSelect01">
                                <option value="0" selected>None</option>
                                @foreach ($categories as $cat)

                                <option value="{{$cat->id}}" {{old('parent')===$cat->id?'selected':''}}>{{$cat->category_name}}</option>
                                @endforeach

                            </select>
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