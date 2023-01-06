<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          All Request For Quotations
            @if(isset($search_query))
                <span class="text-right float-right">Search Results of {{$search_query}}</span>
                @endif
       </h2>

   </x-slot>

   <div>
    <div class="container">
        <div class="block mb-8">
            @if (session('info'))
                <div class="alert alert-success" role="alert">
                    {!! session('info') !!}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{session('error')}}
                </div>
            @endif
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <a href="{{ route('request_for_quotation.create') }}" class="btn btn-primary">Add New Request For Quotation</a>
                    </div>
                </div>
        </div>


        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="m-3 float-right">
                            {{ $rfqs->links() }}
                        </div>
                        <table class="table min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                                <tr>
                                    <th><button class="btn btn-danger btn-sm" onclick="massDestroy(document.getElementsByName('del'))">Delete</button></th>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                       RFQ ID
                                    </th>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                       REF
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Company Details
                                    </th><th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        By User
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
{{--                                   <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                    Address--}}
{{--                                    </th><th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                    Active--}}
{{--                                    </th><th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                    Approved--}}
{{--                                    </th>--}}

                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">
Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($rfqs as $request_for_quotation)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="del" class="form-control" value="{{ $request_for_quotation->id }}">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                           {{ $request_for_quotation->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                           {{ $request_for_quotation->ref }}
                                    </td>
{{--                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">--}}
{{--                                        {{ $request_for_quotation->company_name}}--}}
{{--                                    </td>--}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                        <b>Company:</b> {{ $request_for_quotation->_vendor->company_name }}<br>
                                        <b>Contact Name:</b> {{ $request_for_quotation->_vendor->contact_name }}<br>
                                        <b>Email:</b> {{ $request_for_quotation->_vendor->email }}<br>
                                        <b>Mobile:</b> {{ $request_for_quotation->_vendor->mobile_phone_1 }}<br>
                                        <b>Website:</b> {{ $request_for_quotation->_vendor->website }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                        @if(isset($request_for_quotation->_vendor->_category->parent)&&$request_for_quotation->_vendor->_category->parent>0)
                                            <b> Parent:</b> {{isset($request_for_quotation->_vendor->_category->get_parent->category_name)?$request_for_quotation->_vendor->_category->get_parent->category_name:'*Category Missing*'}}<br>
                                            <b>Sub Category:</b> {{ $request_for_quotation->_vendor->_category->category_name}}
                                        @else
                                            <b>{{ isset($request_for_quotation->_vendor->_category->category_name)?$request_for_quotation->_vendor->_category->category_name:'*Category Missing*'}}</b>
                                        @endif

                                    </td>
{{--                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">--}}
{{--                                        {!! ($request_for_quotation->address.' <br> '.$request_for_quotation->city.', '.$request_for_quotation->zip_code.' <br> '.$request_for_quotation->country)!!}--}}
{{--                                    </td>--}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                        {{$request_for_quotation->_user->name}}
                                    </td><td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                        {{$request_for_quotation->date}}
                                    </td>
{{--                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">--}}
{{--                                        <label class="c-switch c-switch-primary">--}}
{{--                                            <input type="checkbox" name="active" class="c-switch-input" onchange="ajax_call(this,{{$request_for_quotation->id}})" {{ $request_for_quotation->active==1?'checked':'' }}>--}}
{{--                                            <span class="c-switch-slider"></span>--}}
{{--                                        </label>--}}
{{--                                    </td>--}}
{{--                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">--}}
{{--                                        <label class="c-switch c-switch-danger">--}}
{{--                                            <input type="checkbox" name="approval" class="c-switch-input" onchange="ajax_call(this,{{$request_for_quotation->id}})" {{ $request_for_quotation->approval==1?'checked':'' }}>--}}
{{--                                            <span class="c-switch-slider"></span>--}}
{{--                                        </label>--}}
{{--                                    </td>--}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('request_for_quotation.show', $request_for_quotation->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2 btn btn-info">View</a>
                                        <a href="{{ route('request_for_quotation.edit', $request_for_quotation->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2 btn btn-secondary">Edit</a>
                                        <a href="{{ route('request_for_quotation.send', $request_for_quotation->id) }}" class="text-white mb-2 mr-2 btn btn-warning">Send RFQ</a>
                                        <a href="{{\Illuminate\Support\Facades\URL::signedRoute('rfq-reply',['rfq'=>$request_for_quotation->id])}}" target="_blank" class="text-white mb-2 mr-2 btn btn-warning">Replies</a>
                                        <a href="{{ env('APP_URL').$request_for_quotation->pdf_link }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2 btn btn-success">Download PDF</a>
                                        <form class="inline-block" action="{{ route('request_for_quotation.destroy', $request_for_quotation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2 btn btn-danger" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                                @empty


                                <tr class="text-info"> <td colspan="9" class="p-3 text-danger text-center" >No Request For Quotation found</td></tr>

                                @endforelse
                            </tbody>
                        </table>
                        <div class="m-3 float-right">
                            {{ $rfqs->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
       <form action="{{route('request_for_quotation.massdelete')}}" method="post" >
           @csrf
           <input type="hidden" name="del_vals" value="" id="delvals">
           <input type="submit" value="" class="d-none" id="delsubmit">
       </form>
        @push('scripts')
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script>
               {{--function ajax_call(el,id){--}}
               {{--    let val=0;--}}
               {{--    if(el.checked){--}}
               {{--        val=1--}}
               {{--    }--}}
               {{--    console.log(el.name+' -> '+val);--}}
               {{--    $.post('{{route('request_for_quotation.ajax')}}', {id: id,ctype:el.name,cvalue:val,_token:'{{ csrf_token() }}'}, function(result){--}}
               {{--        console.log(result);--}}
               {{--    });--}}
               {{--}--}}
               function massDestroy(e){
                   var vids=[];
                   let found=false;
                   for (var checkbox of e) {
                       if (checkbox.checked)  {
                           // alert(checkbox.value + ' ');
                           vids.push(checkbox.value);
                           found=true;
                       }
                   }
                   if(found){
                       document.getElementById('delvals').value=vids.join();
                       document.getElementById('delsubmit').click();
                       //
                       // $('delvals').val(vids.join());
                       // $('delsubmit').trigger('click');
                       {{--$.post('{{route('rfqs.massdelete')}}',{del:vids,_token:'{{csrf_token()}}'},function (response){--}}

                       {{--    if(response==='1'){--}}
                       {{--        console.log(response);--}}
                       {{--        //if you want to display flash message--}}
                       {{--        window.location.href = "{{route('rfqs.index')}}";--}}
                       {{--    }--}}
                       {{--});--}}
                       //console.log(vids);
                   }else{

                       alert('Please Select Vendors to Delete');
                   }

               }
            </script>
        @endpush
    </div>
</div>
</x-app-layout>
