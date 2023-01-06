<style>
    #cke_body{
        width: 90%;
    }
    #cke_user_details{
        width: 91%;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
{{--<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />--}}
@push('scripts')
{{--    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>--}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

@endpush
<!-- Ref Field -->
<div class="col-sm-6">
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
<!-- Subject Field -->
<div class="col-sm-6">
    <div class="input-group mb-3 ">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basiaddon1">
                 Subject:
            </span>
        </div>
        {!! Form::text('subject', (isset($rfq->subject)?'Reply to '.$rfq->subject:old('subject',null)), ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
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
        {!! Form::textarea('body', (old('body',null)), ['class' => 'form-control','id'=>'body']) !!}
        @push('scripts') <script>
            $(function (){
                var options = {
                    filebrowserImageBrowseUrl: '/filemanager?type=Images',
                    filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
                    filebrowserBrowseUrl: '/filemanager?type=Files',
                    filebrowserUploadUrl: '/filemanager/upload?type=Files&_token=',
                    removeButtons:'Image'
                };
               // CKEDITOR.config.removeButtons = 'Image';
                CKEDITOR.replace( 'body' ,options);

            })
        </script>@endpush
    </div>
</div>
<!-- User Details Field -->
<div class="col-sm-12 mt-2">
              <div class="input-group mb-3 ">
                  <div class="input-group-prepend">
            <span class="input-group-text" id="basiaddon1">
                Attachments (multiple files can be attached):
            </span>
                  </div>
                <input id="attachments" class="form-control " type="file" name="attachments[]" value="{{old('attachments',null)}}" multiple>

            </div>
</div>

<!-- Submit Field -->
<div class="col-sm-6 text-right">
    {!! Form::submit('Submit Reply', ['class' => 'btn btn-primary']) !!}
{{--    <a href="{{ route('request_for_quotation.index') }}" class="btn btn-secondary">Cancel</a>--}}
</div>

@push('scripts')

@endpush