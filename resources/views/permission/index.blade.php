<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Permission List
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
                <a href="{{ route('permission.create') }}" class="btn btn-primary">Add New Permission</a>
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
                                        Title
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 text-black-100">
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                            {{ $permission->id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                            {{ $permission->title }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-50">
{{--                                            <a href="{{ route('permission.show', $permission->id) }}" class="btn btn-info text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>--}}
                                            <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-secondary text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>
                                            <form class="inline-block" action="{{ route('permission.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-danger text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
