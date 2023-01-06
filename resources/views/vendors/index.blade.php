<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          All Vendors
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
                    {{session('info')}}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{session('error')}}
                </div>
            @endif
        </div>
        <div class="block mb-8">
            <div class="row mb-3">
                <div class="col-sm-3">
                    <a href="{{ route('vendors.exportexcel') }}" class="btn btn-primary">Export All Vendors</a>
                </div>
                <div class="col-sm-1">
                    &nbsp;
                </div>
                <div class="col-sm-8">

                    <form action="{{route('importExcel')}}" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            @csrf
{{--                            <input type="text" class="form-control" placeholder="Search Here" name="q" id="searchq" aria-label="Search Here" aria-describedby="basiaddon2">--}}
                            <input type="file" name="import_file" id="fileupload" class="form-control" aria-describedby="basiaddon2">
                            <div class="input-group-append">
                                <span class="input-group-text btn btn-info" id="basiaddon21" onclick="if(document.getElementById('fileupload').value!==''){document.getElementById('sbmt-btn1').click()}">Upload Vendors Excel</span>
                            </div>
                            <input type="submit" value="" class="d-none" id="sbmt-btn1">

                        </div>
                    </form>
                </div>
            </div>
            <form action="" method="get">
            <div class="row mb-3">
                <div class="col-sm-3">
                    <a href="{{ route('vendors.create') }}" class="btn btn-primary">Add New Vendor</a>
                </div>
                <div class="col-sm-1">
                    &nbsp;
                </div>
                <div class="col-sm-8">

{{--                    <form action="" method="get">--}}
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search Here" name="q" id="searchq" aria-label="Search Here" aria-describedby="basiaddon2">
                            <div class="input-group-append">
                                <span class="input-group-text btn btn-info" id="basiaddon2" onclick="if(document.getElementById('searchq').value!==''){document.getElementById('sbmt-btn').click()}">Search</span>
                            </div>
                            <input type="submit" value="" class="d-none" id="sbmt-btn">


                        </div>
{{--                    </form>--}}
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <h4>Filter By Date</h4>
                </div>
                        <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">Date From </span>
                            </div>
                        <input type="date" id="startd" name="date1" class="form-control"
                               value="{!! isset(request()->date1)?request()->date1:'' !!}"
                                max="{!! date('Y-m-d') !!}">
                        </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basiaddon1">Date To </span>
                                </div>
                                <input type="date" id="endd" name="date2" class="form-control"
                                       value="{!! isset(request()->date2)?request()->date2:'' !!}"
                                       max="{!! date('Y-m-d') !!}">
                            </div>
                        </div>
                       <div class="col-sm-2">
                           <div class="input-group mb-3 text-right">

{{--                               <button type="submit" value="Filter Vendors" class="btn btn-info" id="">Filter</button>--}}

{{--                               @if(isset(request()->date1))--}}
{{--                                   &nbsp;&nbsp; <a href="{{ route('vendors.index') }}" class="btn btn-warning">Clear</a>--}}
{{--                               @endif--}}
                           </div>
                       </div>
                </div>
{{--            </form>--}}
{{--            <form action="" method="get">--}}
                <div class="row">
                    <div class="col-sm-2">
                        <h4>User and Category Filter</h4>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">Filter By User </span>
                            </div>
                            {!! Form::select('user_f', $users_array, (isset(request()->user_f)?request()->user_f:''), ['class' => 'form-control','placeholder' => 'Filter By User...','onchange'=>'$("#exportuser").val(this.value);'])!!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">Filter By Category </span>
                            </div>
                            {!! Form::select('category_f', $categories_array, (isset(request()->category_f)?request()->category_f:''), ['class' => 'form-control','placeholder' => 'Filter By Category...','onchange'=>'$("#exportcat").val(this.value);'])!!}
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group mb-3 text-right">

                            <button type="submit" value="Filter Vendors" class="btn btn-info" id="">Filter</button>

                            @if(isset(request()->category_f)||isset(request()->user_f))
                                &nbsp;&nbsp; <a href="{{ route('vendors.index') }}" class="btn btn-warning">Clear</a>

                                @elseif(isset(request()->date1))
                                    &nbsp;&nbsp; <a href="{{ route('vendors.index') }}" class="btn btn-warning">Clear</a>
                                @elseif(isset($search_query))
                                    &nbsp;&nbsp; <a href="{{ route('vendors.index') }}" class="btn btn-warning">Clear Search</a>
                                @endif
                           @if(count($vendors)>0)
                                @if(isset(request()->category_f)||isset(request()->user_f)||isset(request()->date1)||isset($search_query))
                                    <br> <button type="button" onclick="$('#massExportForm').submit();" value="Filter Vendors" class="btn btn-primary mt-2" id="">Export Filtered Vendors</button>
                                 @endif
                            @endif
                        </div>
                    </div>
                </div>
            </form>
            </div>

        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="m-3 float-right">
                            {{ $vendors->appends(request()->merge(['sort' => $sort])->all())->links() }}
                        </div>
                        <table class="table min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                                <tr>
                                    <th>
                                        <button class="btn btn-primary btn-sm my-1" onclick="document.getElementById('pdf_export').value=0;massExport(document.getElementsByName('del'))">Export</button>
                                        <button class="btn btn-warning btn-sm my-1" onclick="document.getElementById('pdf_export').value=1;massExport(document.getElementsByName('del'))">Export PDF</button>

                                        <button class="btn btn-danger btn-sm" onclick="massDestroy(document.getElementsByName('del'))">Delete</button>
                                    </th>
                                    <th scope="col" width="50"  class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{request()->fullUrlWithQuery(['sort' => 'id-'.$sort_type,'sorting'=>1])}}">Vendor ID</a>
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{request()->fullUrlWithQuery(['sort' => 'company_name-'.$sort_type,'sorting'=>1])}}">Company</a>
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{request()->fullUrlWithQuery(['sort' => 'category-'.$sort_type,'sorting'=>1])}}">Category</a>
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Vendor Details
                                    </th>
{{--                                   <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                    Address--}}
{{--                                    </th>--}}
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Active
                                    </th><th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Approved
                                    </th>

                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">
Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($vendors as $vendor)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="del" class="form-control" value="{{ $vendor->id }}">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                           {{ $vendor->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                        {{ $vendor->company_name}}
                                    </td> <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">

                                        @if(isset($vendor->categories->parent)&&$vendor->categories->parent>0)
                                            <b> Parent:</b> {{isset($vendor->categories->get_parent->category_name)?$vendor->categories->get_parent->category_name:'*Category Missing*'}}<br>
                                            <b>Sub Category:</b> {{ $vendor->categories->category_name}}
                                        @else
                                            <b>{{ isset($vendor->categories->category_name)?$vendor->categories->category_name:'*Category Missing*'}}</b>
                                        @endif

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                        <b>Contact Name:</b> {{ ($vendor->contact_name?$vendor->contact_name.' ':$vendor->first_name.' '.$vendor->last_name) }}<br>
                                        <b>Full Name:</b> {{ $vendor->first_name.' '.$vendor->last_name }}<br>
                                        <b>Email:</b> {{ $vendor->email }}<br>
                                        <b>Mobile:</b> {{ $vendor->mobile_phone_1 }}
                                        <b>Website:</b> {{ $vendor->website }}
                                    </td>

{{--                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">--}}
{{--                                        {!! ($vendor->address.' <br> '.$vendor->city.', '.$vendor->zip_code.' <br> '.$vendor->country)!!}--}}
{{--                                    </td>--}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                        <label class="c-switch c-switch-primary">
                                            <input type="checkbox" name="active" class="c-switch-input" onchange="ajax_call(this,{{$vendor->id}})" {{ $vendor->active==1?'checked':'' }}>
                                            <span class="c-switch-slider"></span>
                                        </label>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-black-50">
                                        <label class="c-switch c-switch-danger">
                                            <input type="checkbox" name="approval" class="c-switch-input" onchange="ajax_call(this,{{$vendor->id}})" {{ $vendor->approval==1?'checked':'' }}>
                                            <span class="c-switch-slider"></span>
                                        </label>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('vendors.show', $vendor->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2 btn btn-info">View</a>
                                        <a href="{{ route('vendors.edit', $vendor->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2 btn btn-secondary">Edit</a>
                                        <form class="inline-block" action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2 btn btn-danger" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                                @empty


                                <tr class="text-info"> <td colspan="9" class="p-3 text-danger text-center" >No Vendors found</td></tr>

                                @endforelse
                            </tbody>
                        </table>
                        <div class="m-3 float-right">
                            {{ $vendors->appends(request()->merge(['sort' => $sort])->all())->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
       <form action="{{route('vendors.massdelete')}}" method="post" >
           @csrf
           <input type="hidden" name="del_vals" value="" id="delvals">
           <input type="submit" value="" onclick="return confirm('Are you sure you want to Delete these Vendors?')" class="d-none" id="delsubmit">
       </form>
       <form action="{{route('vendors.massExport')}}" method="post" id="massExportForm">
           @csrf
           <input type="hidden" name="export_vals" value="" id="exportvals">
           <input type="hidden" name="export_cat" value="{{(isset(request()->category_f)?request()->category_f:'')}}" id="exportcat">
           <input type="hidden" name="export_user" value="{{(isset(request()->user_f)?request()->user_f:'')}}" id="exportuser">
           <input type="hidden" class="form-control" placeholder="Search Here" name="q" value="{{(isset(request()->q)?request()->q:'')}}">
           <input type="hidden"  name="date1" class="form-control" value="{!! isset(request()->date1)?request()->date1:'' !!}">
           <input type="hidden"  name="date2" class="form-control" value="{!! isset(request()->date2)?request()->date2:'' !!}">
           <input type="hidden" name="pdf_export" id="pdf_export" value="0">
           <input type="submit" value=""  class="d-none" id="exportsubmit">

       </form>
        @push('scripts')
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script>
               function ajax_call(el,id){
                   let val=0;
                   if(el.checked){
                       val=1
                   }
                   console.log(el.name+' -> '+val);
                   $.post('{{route('vendors.ajax')}}', {id: id,ctype:el.name,cvalue:val,_token:'{{ csrf_token() }}'}, function(result){
                       console.log(result);
                   });
               }
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
                       {{--$.post('{{route('vendors.massdelete')}}',{del:vids,_token:'{{csrf_token()}}'},function (response){--}}

                       {{--    if(response==='1'){--}}
                       {{--        console.log(response);--}}
                       {{--        //if you want to display flash message--}}
                       {{--        window.location.href = "{{route('vendors.index')}}";--}}
                       {{--    }--}}
                       {{--});--}}
                       //console.log(vids);
                   }else{

                       alert('Please Select Vendors to Delete');
                   }
               }
               function massExport(e){
                   var v_ids=[];
                   let found=false;
                   for (var checkbox of e) {
                       if (checkbox.checked)  {
                           // alert(checkbox.value + ' ');
                           v_ids.push(checkbox.value);
                           found=true;
                       }
                   }
                   if(found){
                       document.getElementById('exportvals').value=v_ids.join();
                       document.getElementById('exportsubmit').click();
                       //
                       // $('delvals').val(vids.join());
                       // $('delsubmit').trigger('click');
                       {{--$.post('{{route('vendors.massdelete')}}',{del:vids,_token:'{{csrf_token()}}'},function (response){--}}

                       {{--    if(response==='1'){--}}
                       {{--        console.log(response);--}}
                       {{--        //if you want to display flash message--}}
                       {{--        window.location.href = "{{route('vendors.index')}}";--}}
                       {{--    }--}}
                       {{--});--}}
                       //console.log(vids);
                   }else{

                       alert('Please Select Vendors to Export');
                   }
               }
            </script>
        @endpush
    </div>
</div>
</x-app-layout>
