<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Show Category
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 ">

            <div class="container  mb-5">
                <div class="row">
                    <div class="col-sm">
                        <a href="@if($category->parent==0){{ route('categories.index') }}@else{{ route('categories.show', $category->parent) }}@endif" class="btn btn-info ">Back to list</a>
                    </div>
                </div>
            </div>
            <div class="container bg-white mb-5 p-2">

                <div class="row">
                   <div class="col-sm">
                       <table class="table min-w-full divide-y divide-gray-200 w-full">
                           <tr class="border-b">
                               <th scope="col" class="bg-gray-500">
                                   ID
                               </th>
                               <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                   {{ $category->id }}
                               </td>
                           </tr>
                           <tr class="border-b">
                               <th scope="col" class="bg-gray-500">
                                   Name
                               </th>
                               <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                   {{ $category->category_name }}
                               </td>
                           </tr>
                           @if($category->parent!=0)
                           <tr class="border-b">
                               <th scope="col" class="bg-gray-500">
                                   Parent
                               </th>
                               <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                   {{ isset($category->get_parent->category_name)?$category->get_parent->category_name:'' }}

                               </td>
                           </tr>
                               @endif

                       </table>
                   </div>
                </div><!--/.row-->
            </div>

{{--            <div class="block mt-8">--}}
{{--                <a href="{{ route('categories.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to list</a>--}}
{{--            </div>--}}
        </div>
    </div>
    @if($category->parent==0)
    <div class="container bg-white p-3">
        <div class="row">

            <div class="col-sm-12">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Sub Categories
                </h2>
            </div>
        </div>
        <div class="row">

            <div class="col-sm-12">
                <table class="table min-w-full divide-y divide-gray-200 w-full">
                    <thead>
                    <tr>
                        <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sub Category
                        </th>
                        <th scope="col" width="200" class="px-6 py-3 bg-gray-50">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($category->get_children as $cat)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                {{ $cat->id }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                {{ $cat->category_name }}
                            </td>
                            {{--                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">--}}
                            {{--                                --}}{{--                                        {!! $cat->parent==0?'Parent':'Sub category of <strong>'.(isset($cat->get_parent->category_name)?$cat->get_parent->category_name:'*Category Missing*').'</strong>' !!}--}}
                            {{--                                @foreach($cat->get_children as $child_category)--}}
                            {{--                                    {{$child_category->category_name}}<br>--}}
                            {{--                                @endforeach--}}
                            {{--                            </td>--}}

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


                        <tr class="text-info"> <td colspan="4" class="p-3 text-danger" >No Sub Categories found</td></tr>

                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        @endif
</x-app-layout>
