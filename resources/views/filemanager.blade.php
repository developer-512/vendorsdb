<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{request()->type}} Manager
        </h2>
    </x-slot>
    <iframe src="/filemanager?type={{request()->type}}" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
</x-app-layout>
