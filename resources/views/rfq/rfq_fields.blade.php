<style>
    #cke_body{
        width: 90%;
    }
    #cke_user_details{
        width: 91%;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
<!-- Ref Field -->
<div class="col-sm-4">
    <div class="input-group mb-3 ">
        <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Ref No:
                                </span>
        </div>
    {!! Form::text('ref', (isset($rfq->ref)?$rfq->ref:$ref), ['class' => 'form-control','aria-describedby'=>"basiaddon1","disabled"=>"true"]) !!}
    {!! Form::hidden('ref', (isset($rfq->ref)?$rfq->ref:$ref), ['class' => 'form-control','aria-describedby'=>"basiaddon1"]) !!}
    </div>
</div>
<!-- Vendor Field -->
<div class="col-sm-4">
    <div class="input-group mb-3 ">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basiaddon1">
                 Vendor:
            </span>
        </div>
        {!! Form::select('vendor',$vendors, (isset($rfq->vendor)?$rfq->vendor:null), ['class' => 'form-control','placeholder' => 'Select Vendor...','onchange'=>"v_id_update(this.value)"]) !!}
    </div>
</div>
<!-- Subject Field -->
<div class="col-sm-4">
    <div class="input-group mb-3 ">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basiaddon1">
                 Subject:
            </span>
        </div>
        {!! Form::text('subject', (isset($rfq->subject)?$rfq->subject:null), ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- Body Field -->
<div class="col-sm-12">
    <div class="input-group mb-3 ">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basiaddon1">
                 Body:
            </span>
        </div>
        {!! Form::textarea('body', (isset($rfq->body)?$rfq->body:null), ['class' => 'form-control']) !!}
        @push('scripts') <script>
            var options = {
                filebrowserImageBrowseUrl: '/filemanager?type=Images',
                filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/filemanager?type=Files',
                filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
            };
            CKEDITOR.replace( 'body' ,options);
        </script>@endpush
    </div>
</div>
<!-- Project Name Field -->
<div class="col-sm-4">
    <div class="input-group mb-3 ">
        <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Project Name:
                                </span>
        </div>
    {!! Form::text('project_name', (isset($rfq->project_name)?$rfq->project_name:null), ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>
<!-- Project Code Field -->
<div class="col-sm-4">
    <div class="input-group mb-3 ">
        <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Project Code:
                                </span>
        </div>
    {!! Form::text('project_code', (isset($rfq->project_code)?$rfq->project_code:null), ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>
<!-- Pr No Field -->
<div class="col-sm-4">
    <div class="input-group mb-3 ">
        <div class="input-group-prepend">
                                <span class="input-group-text" id="basiaddon1">
                                    Pr No:
                                </span>
        </div>
    {!! Form::text('pr_no', (isset($rfq->pr_no)?$rfq->pr_no:null), ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- C Logo Field -->
<div class="col-sm-4">
    <div class="input-group mb-3 ">
{{--        <div class="input-group-prepend">--}}
{{--               <span class="input-group-text" id="basiaddon1">--}}
{{--                                    Company Logo:--}}
{{--               </span>--}}
{{--        </div>--}}
{{--    {!! Form::file('c_logo', (isset($rfq->c_logo)?$rfq->c_logo:null), ['class' => 'form-control']) !!}--}}

   <span class="input-group-btn">
     <span id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
        Choose Company Logo
     </span>
   </span>
            <input id="thumbnail" class="form-control" type="text" name="c_logo" value="{{(isset($rfq->c_logo)?$rfq->c_logo:null)}}">
        <img id="holder" style="margin-top:15px;max-height:100px;">
    </div>
    @push('scripts') <script>
        var route_prefix = "/filemanager";
        lfm('lfm', 'image', {prefix: route_prefix,type:'image'});
    </script>@endpush
</div>

<!-- Package Field -->
<div class="col-sm-4">
    <div class="input-group mb-3 ">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basiaddon1">
                 Package:
            </span>
        </div>
    {!! Form::text('package', (isset($rfq->package)?$rfq->package:null), ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>
<!-- Date Field -->
<div class="col-sm-4">
    <div class="input-group mb-3 ">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basiaddon1">
                End Date:
            </span>
        </div>
        {!! Form::date('date', (isset($rfq->date)?$rfq->date:null), ['class' => 'form-control','id'=>'date']) !!}
    </div>
</div>

<!-- User Details Field -->
<div class="col-sm-6">
    <div class="input-group mb-3 ">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basiaddon1">
                Emails (use ; as separator):
            </span>
        </div>
        {!! Form::textarea('emails', (isset($rfq->emails)?$rfq->emails:null), ['class' => 'form-control','rows'=>4]) !!}
    </div>
</div>
<div class="col-sm-6">
    <div class="input-group mb-3 ">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basiaddon1">
               Company Emails :
            </span>
        </div>
        <span id="emails">
             @if(isset($rfq->vendor))

            @else
                {!! Form::select('vendor_emails[]', [],null, ['class' => 'form-control','multiple'=>'true','placeholder' => 'Select a Vendor First...']) !!}
            @endif

        </span>


        @push('scripts')
        <script>
            var v_id='{{(isset($rfq->vendor)?$rfq->vendor:0)}}';
            function v_id_update(vid){
                v_id =vid;
                $.get( '{{route('vendors.index')}}?ajax_list=1&vendors_id='+v_id, function( r ) {
                    //console.log(r);
                    $('#emails').html('');
                   $('#emails').append(r);
                });
            }
            {{--$('.js-data-example-ajax').select2({--}}
            {{--    ajax: {--}}
            {{--        url: '{{route('vendors.index')}}?ajax_list=1&vendors_id='+v_id,--}}
            {{--        dataType: 'json'--}}
            {{--        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example--}}
            {{--    },--}}
            {{--    tags:true--}}
            {{--});--}}
            $( document ).ready(function() {
                if(v_id!=='0'){
                    v_id_update(v_id);
                }
            });
        </script>
        @endpush
{{--        {!! Form::textarea('emails', (isset($rfq->emails)?$rfq->emails:null), ['class' => 'form-control','rows'=>2]) !!}--}}
    </div>
</div>


<!-- User Field -->

    <div class="col-sm-6">
        <div class="input-group mb-3 ">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basiaddon1">
                 User:
            </span>
            </div>
    {!! Form::select('user', $users,(isset($rfq->user)?$rfq->user:null), ['class' => 'form-control']) !!}
        </div>
    </div>


<!-- User Details Field -->
<div class="col-sm-6">
    <div class="input-group mb-3 ">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basiaddon1">
                User Company Details:
            </span>
        </div>
    {!! Form::textarea('user_details', (isset($rfq->user_details)?$rfq->user_details:null), ['class' => 'form-control','rows'=>3]) !!}
    </div>
</div>
<div class="col-sm-12">
    <div class="row">
        <div class="col sm-8" id="attachments-div">
            @if(isset($rfq->attachments))
                @foreach(explode('||',$rfq->attachments) as $key => $attachment)
            <div class="input-group mb-3 " id="newtt-{{$key}}">
                <span class="input-group-btn">
             <span id="lfm-file-{{$key}}" data-input="attachments-{{$key}}" data-preview="attachments-holder-{{$key}}" class="btn btn-primary">
                Update Attachment
             </span>
           </span>
                <input id="attachments-{{$key}}" class="form-control" type="text" name="attachments[]" value="{{$attachment}}">
                <img id="attachments-holder-{{$key}}" style="margin-top:15px;max-height:100px;">
            </div>
                @endforeach
            @else
              <div class="input-group mb-3 ">
        <span class="input-group-btn">
     <span id="lfm-file" data-input="attachments" data-preview="attachments-holder" class="btn btn-primary">
        Add Attachment
     </span>
   </span>
                <input id="attachments" class="form-control" type="text" name="attachments[]" value="">
                <img id="attachments-holder" style="margin-top:15px;max-height:100px;">
            </div>
            @push('scripts') <script>
                var route_prefix = "/filemanager";
                lfm('lfm-file', 'file', {prefix: route_prefix,type:'file'});
            </script>@endpush
            @endif
        </div>
        <div class="col-sm-3" id="add-remove-div">
            <span class="btn btn-primary btn-block mb-3" onclick="add_more_attachments()">Add More Attachment</span>
            @if(isset($rfq->attachments))
                @foreach(explode('||',$rfq->attachments) as $key => $attachment)
                    <span class="btn btn-danger btn-block mb-3"  onclick="remove_this_attachments('#newatt-{{$key}}',this)">Remove This Attachment</span>
                @endforeach
             @endif
            <div id="n-attach" style="display:none;">
                <div class="input-group mb-3 " id="newatt-zzzz">
                    <span class="input-group-btn">
                         <span id="lfm-file-zzzz" data-input="attachments-zzzz" data-preview="attachments-holder-zzzz" class="btn btn-primary">
                            Add Attachment
                         </span>
                        </span>
                    <input id="attachments-zzzz" class="form-control" type="text" name="attachments[]" value="">
                    <img id="attachments-holder-zzzz" style="margin-top:15px;max-height:100px;">
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Submit Field -->
<div class="col-sm-6 text-right">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('request_for_quotation.index') }}" class="btn btn-secondary">Cancel</a>
</div>

@push('scripts')
    <script>
        var attach=0;
        var new_Attach_html='';
        function get_new_html(){
            return '           <div class="input-group mb-3 " id="newatt-'+attach+'">'
                +'<span class="input-group-btn">'
                +' <span id="lfm-file-'+attach+'" data-input="attachments-'+attach+'" data-preview="attachments-holder-'+attach+'" class="btn btn-primary">'
                +  'Add Attachment'
                + '</span>'
                + '</span>'
                +'<input id="attachments-'+attach+'" class="form-control" type="text" name="attachments[]" value="">'
                +' <img id="attachments-holder-'+attach+'" style="margin-top:15px;max-height:100px;">'
                + '</div>';
        }
        $('#n-attach').remove();
        function new_file_uploader(id){
            var route_prefix = "/filemanager";
            lfm(id, 'file', {prefix: route_prefix,type:'file'});
        }
        function add_more_attachments(){
            attach+=1;
            var attach_id=attach;
            var html_=get_new_html();
            console.info(html_);
            $('#attachments-div').append(html_);
            $('#add-remove-div').append('<span class="btn btn-danger btn-block mb-3"  onclick="remove_this_attachments(\'#newatt-'+attach_id+'\',this)">Remove This Attachment</span>');
            new_file_uploader('lfm-file-'+attach);

        }
        function remove_this_attachments(id,btn){
            $(id).remove();$(btn).remove();
        }
        @if(isset($rfq->attachments))
                attach={{count(explode('||',$rfq->attachments))}};
            @foreach(explode('||',$rfq->attachments) as $key => $attachment)
                new_file_uploader('lfm-file-{{$key}}');
            @endforeach
        @endif
    </script>
@endpush