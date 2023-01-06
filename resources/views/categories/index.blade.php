<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Categories
       </h2>
   </x-slot>

   <div>
    <div class="container">
        <div class="block mb-8">
           @if (session('info'))
            <div class="alert alert-success" role="alert">
                {{session('info')}}
            </div>
            @elseif(session('error'))
                <div class="alert alert-success" role="alert">
                    {{session('error')}}
                </div>
            @endif
        </div>
        <div class="block mb-8">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Categories</a>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="table min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Parent Category
                                    </th>  <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sub Categories
                                    </th>
                                    
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">
Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($categories as $cat)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                        {{ $cat->id }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                        {{ $cat->category_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
{{--                                        {!! $cat->parent==0?'Parent':'Sub category of <strong>'.(isset($cat->get_parent->category_name)?$cat->get_parent->category_name:'*Category Missing*').'</strong>' !!}--}}
                                        @foreach($cat->get_children as $child_category)
                                            {{$child_category->category_name}}<br>
                                        @endforeach
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('categories.show', $cat->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2 btn btn-info">View</a>
                                        <a href="{{ route('categories.edit', $cat->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2 btn btn-secondary">Edit</a>
                                        <form class="inline-block" action="{{ route('categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2 btn btn-danger" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                                @empty


                                <tr class="text-info"> <td colspan="4" class="p-3 text-danger" >No Categories found</td></tr>

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</x-app-layout>
