<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Request For Quotation
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
{{--                {!! var_dump($rfq)!!}--}}
{{--                @dd($rfq)--}}
                <form method="post" action="{{ route('request_for_quotation.update', [$rfq->id]) }}">
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
                        @include('rfq.rfq_fields')
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>