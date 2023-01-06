<x-guest-layout>
    <x-slot name="header">

    </x-slot>
@push('styles')
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

@endpush

    <div class="mt-3">

        <div class="container">
            <div class="mt-5 row-cols-auto">
                <div class="col-12">
                    @if(count($replies)>0)
                        <div class="card">
                            <div class="card-header">
                                <h3>RFQ Replies</h3>
                            </div>
                            <div class="card-body">
                                @foreach($replies as $reply)
                                    <div class="card mt-2" >
                                        <div class="card-body">
                                            <h5 class="card-title">{{$reply->subject}}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">{{$reply->reply_by=='v'?'Vendor Reply':'Admin Reply'}} at {{date('d-M-Y H:i',strtotime($reply->created_at))}}</h6>
                                            <p class="card-text">{!! $reply->body !!}</p>
                                            @if($reply->attachments!='')
                                                <h6 class="card-subtitle mb-2 text-muted">Attachments:</h6>
                                                @foreach(explode('||',$reply->attachments) as $attachment)
                                                    @php $file=explode('::',$attachment); @endphp
                                                    <a href="{{asset($file[1])}}" target="_blank" class="card-link">{{$file[0]}}</a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="mt-5 row">
                <div class="col-12">
                    <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight mb-3">
                        Reply To Request For Quotation
                    </h2>
                    <form method="post" action="{{ \Illuminate\Support\Facades\URL::signedRoute('request_for_quotation.rfqReply',['rfq'=>$rfq->id]) }}" enctype="multipart/form-data">
                        @csrf
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

                            @include('rfq.reply_rfq_fields')

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @push('scripts')
        <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    @endpush
</x-guest-layout>