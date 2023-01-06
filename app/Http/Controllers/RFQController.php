<?php

namespace App\Http\Controllers;

use App\Models\RFQ;
use App\Models\RFQReply;
use App\Models\User;
use App\Models\Vendors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use PDF;
use App\Mail\rfq_mail;


class RFQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $data['rfqs']=RFQ::paginate(20);
        return view('rfq.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $data['ref']=$this->ref_new();
       // $this->ref_new();

        $data['vendors']=Vendors::all()->pluck('company_name','id');
        $data['users']=User::all()->pluck('name','id');
        return view('rfq.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $body=$request->body;
        $vendor_emails=$request->vendor_emails;
        $request->merge([
            //'date' => date('Y-m-d'),
            'c_logo'=> str_replace(env('APP_URL'),'',$request->c_logo),
            'body'=> str_replace(env('APP_URL'),'WEBURL',$request->body),
            'vendor_emails'=>(is_array($request->vendor_emails)?implode(';',$request->vendor_emails):''),
        ]);
        $request->body=str_replace(env('APP_URL'),'WEBURL',$request->body);

        $validated = $request->validate([
            'ref'=>['required','string','max:255'],
            'project_name'=> ['nullable','string','max:255'],
            'project_code'=> ['nullable','string','max:255'],
            'pr_no'=> ['nullable','string','max:255'],
            'c_logo'=> ['nullable','string','max:255'],
            'attachments'=> ['nullable','array'],
            'package'=> ['nullable','string','max:255'],
            'vendor'=>['required','string','max:255'],
            'subject'=> ['nullable','string','max:255'],
            'body'=> ['nullable','string'],
            'emails'=> ['nullable','string'],
            'vendor_emails'=> ['nullable','string'],
            'user'=>['required','string','max:255'],
            'user_details'=> ['nullable','string'],
            'date'=> ['nullable']
        ]);
        $validated['attachments']=str_replace(env('APP_URL'),'WEBURL',implode('||',$validated['attachments']));
//        dd($validated);
        $rfq=RFQ::create($validated);
        //$rfq->body=str_replace('WEBURL',env('APP_URL'),$rfq->body);
        $rfq->_vendor->contact_name=(empty($rfq->_vendor->contact_name)?$rfq->_vendor->first_name.' '.$rfq->_vendor->last_name:$rfq->_vendor->contact_name);
        $link=$this->rqf_pdf($rfq);
        $rfq->update(['pdf_link'=>'/'.$link]);
        $pdf='<a href="'.env('APP_URL').'/'.$link.'">Download PDF</a>';

//        if(!empty($rfq->emails)) {
//            $emails = explode(';', $rfq->emails);
//            foreach ($emails as $email) {
//                $email = preg_replace("/\s+/", "", $email);
//                Mail::to($email)->send(new rfq_mail($rfq));
//            }
//        }
//        if(!empty($vendor_emails)){
//            // $emails=explode(';',$rfq->emails);
//            foreach ($vendor_emails as $email){
//                $email = preg_replace("/\s+/", "", $email);
//                Mail::to($email)->send(new rfq_mail($rfq));
//            }
//        }
        return redirect()->route('request_for_quotation.index')->with('info','Request For Quotation Created Successfully '.$pdf);
    }
    public function send(RFQ $rfq){
                if(!empty($rfq->emails)) {
            $emails = explode(';', $rfq->emails);
            foreach ($emails as $email) {
                $email = preg_replace("/\s+/", "", $email);
                Mail::to($email)->send(new rfq_mail($rfq));
            }
        }
        if(!empty($rfq->vendor_emails)){
            $vendor_emails=explode(';',$rfq->vendor_emails);
            foreach ($vendor_emails as $email){
                $email = preg_replace("/\s+/", "", $email);
                Mail::to($email)->send(new rfq_mail($rfq));
            }
        }
        return redirect()->route('request_for_quotation.index')->with('info','Request For Quotation Sent Successfully ');
    }
    private function rqf_pdf($data){
        //PDF::setOptions(['defaultPaperSize' => 'a4', 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('pdf.rfq_pdf', compact('data'));
        $pdf_name='Request_For_Quotation_-_'.str_replace(' ','_',$data->_vendor->company_name).'-'.time().'.pdf';
        $pdf_path='public/files/'.Auth::id().'/RFQ/'.$pdf_name;
        Storage::put($pdf_path, $pdf->output());
        //$pdf->save('/storage/files/'.$pdf_name);
        Storage::delete(str_replace('storage','public',$data->pdf_link));
        return str_replace('public','storage',$pdf_path);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RFQ  $request_for_quotation
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(RFQ $request_for_quotation)
    {
        $request_for_quotation->body=str_replace('WEBURL',env('APP_URL'),$request_for_quotation->body);

        $request_for_quotation->vendor_emails_data=Vendors::whereIn('email', explode(';',$request_for_quotation->vendor_emails))->get();
        return view('rfq.show', compact('request_for_quotation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RFQ  $request_for_quotation
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(RFQ $request_for_quotation)
    {
        $request_for_quotation->body=str_replace('WEBURL',env('APP_URL'),$request_for_quotation->body);
        $data['rfq']=$request_for_quotation;
        $data['vendors']=Vendors::all()->pluck('company_name','id');
        $data['users']=User::all()->pluck('name','id');
        return view('rfq.edit',$data);
    }
    public function dropzoneStore($rfq_id,$file)
    {
        $path = public_path('storage/files/RFQ_Reply_'.$rfq_id);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        //$file = $request->file('file');

        $name = uniqid() . '_rfq_reply_attachments.'.$file->extension();

        $file->move($path, $name);

        return [
            'name'          => $name,
            'path'          => ('/storage/files/RFQ_Reply_'.$rfq_id.'/'.$name),
            'original_name' => $file->getClientOriginalName(),
        ];
    }

    /**
     * @throws ValidationException
     */
    public function rfqReply(RFQ $rfq, Request $request){
//        dd($request->all());
        $input_data = $request->all();
//        $directory = "public/files/RFQ_Reply_1";
//        $files = Storage::allFiles($directory);
//        dd($files);
        $validator = Validator::make(
            $input_data, [
            'subject'=> 'required|string|max:255',
            'body'=> 'required|string',
            'attachments.*' => 'nullable|mimes:jpg,jpeg,png,bmp,pdf,doc,docx|max:20000',

        ],[
                'attachments.*.mimes' => 'Only Pdf,Doc,Docx,jpeg,png and bmp images are allowed',
                'attachments.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
            ]
        );

        if ($validator->fails()) {
            return back()->withInput();
            // Validation error..
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ) , 400);
        }
        $files=[];
        $validated = $validator->validated();
        if(count($validated['attachments'])>0){
            foreach ($validated['attachments'] as $attachment){
                $file=$this->dropzoneStore($rfq->id,$attachment);
                $files[]=$file['original_name'].'::'.$file['path'];
            }
        }
        $validated['attachments']=implode('||',$files);
        $validated['reply_by']=(Auth::check()?'a':'v');
        $validated['rfq_id']=$rfq->id;
        $reply=RFQReply::create($validated);
//        dd($reply);

        return redirect(URL::signedRoute('thank-you',['rfq'=>$rfq->id]));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RFQ  $request_for_quotation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, RFQ $request_for_quotation)
    {

        $vendor_emails=$request->vendor_emails;
        $request->merge([
            'c_logo'=> str_replace(env('APP_URL'),'',$request->c_logo),
            'body'=> str_replace(env('APP_URL'),'WEBURL',$request->body),
            'vendor_emails'=>(is_array($request->vendor_emails)?implode(';',$request->vendor_emails):''),

        ]);

        $request->body=str_replace(env('APP_URL'),'WEBURL',$request->body);


        $validated = $request->validate([
            'ref'=>['required','string',Rule::unique('rfq')->ignore($request_for_quotation->id),'max:255'],
            'project_name'=> ['nullable','string','max:255'],
            'project_code'=> ['nullable','string','max:255'],
            'pr_no'=> ['nullable','string','max:255'],
            'c_logo'=> ['nullable','string','max:255'],
            'attachments'=> ['nullable','array'],
            'package'=> ['nullable','string','max:255'],
            'vendor'=>['required','string','max:255'],
            'subject'=> ['nullable','string','max:255'],
            'body'=> ['nullable','string'],
            'emails'=> ['nullable','string'],
            'vendor_emails'=> ['nullable','string'],
            'user'=>['required','string','max:255'],
            'user_details'=> ['nullable','string','max:255'],
            'date'=> ['nullable']
        ]);
        $validated['attachments']=str_replace(env('APP_URL'),'WEBURL',implode('||',$validated['attachments']));
//        dd($validated);
        $request_for_quotation->update($validated);
        $data=$request_for_quotation;
        $request_for_quotation->_vendor->contact_name=(empty($request_for_quotation->_vendor->contact_name)?$request_for_quotation->_vendor->first_name.' '.$request_for_quotation->_vendor->last_name:$request_for_quotation->_vendor->contact_name);
        $link=$this->rqf_pdf($request_for_quotation);
        //return view('pdf.rfq_pdf',compact('data'));
        $request_for_quotation->update(['pdf_link'=>'/'.$link]);
//        if(!empty($rfq->emails)){
//            $emails=explode(';',$rfq->emails);
//            foreach ($emails as $email){
//                $email = preg_replace("/\s+/", "", $email);
//                Mail::to($email)->send(new rfq_mail($request_for_quotation));
//            }
//        }
//        if(!empty($vendor_emails)){
//           // $emails=explode(';',$rfq->emails);
//            foreach ($vendor_emails as $email){
//                $email = preg_replace("/\s+/", "", $email);
//                Mail::to($email)->send(new rfq_mail($request_for_quotation));
//            }
//        }
        $pdf='<a href="'.env('APP_URL').'/'.$link.'">Download PDF</a>';
        return redirect()->route('request_for_quotation.index')->with('info','Request For Quotation Updated Successfully '.$pdf);
    }

    public function send_rfq(RFQ $rfq){
        $request_for_quotation=$rfq;
        if(!empty($rfq->emails)){
            $emails=explode(';',$rfq->emails);
            foreach ($emails as $email){
                $email = preg_replace("/\s+/", "", $email);
                Mail::to($email)->send(new rfq_mail($request_for_quotation));
            }
        }
        if(!empty($rfq->vendor_emails)){
            // $emails=explode(';',$rfq->emails);
            foreach ($rfq->vendor_emails as $email){
                $email = preg_replace("/\s+/", "", $email);
                Mail::to($email)->send(new rfq_mail($request_for_quotation));
            }
        }
        return back()->with('info','Request For Quotation Sent Successfully ');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RFQ  $request_for_quotation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(RFQ $request_for_quotation)
    {
        $request_for_quotation->delete();
        return redirect()->route('request_for_quotation.index')->with('error','Request For Quotation Deleted');
    }

    public function massDestroy(Request $request){
        $output='';
        $success=false;
        if($request->del_vals){
            $del_vals=explode(',',$request->del_vals);
            $output= RFQ::whereIn('id',$del_vals)->delete();
        }
        return redirect()->route('request_for_quotation.index')->with('error','Request For Quotation Deleted Successfully');
    }



    public function active_approval(Request $request){
        RFQ::where('id','=',$request->id)->update([
            $request->ctype=>$request->cvalue
        ]);
        echo 'Success';
    }




    public function ref_new(){
        $ref_old=RFQ::latest()->first();
       if(!empty($ref_old)){
           $ref_old=explode('/',$ref_old['ref']);

           if(date('Y',strtotime($ref_old[1]))==date('Y')){ echo 'yes';
               $r=$ref_old[array_key_last($ref_old)]+1;
           }else{
               $r='1';
           }
       }else{
           $r='1';
       }


        //echo str_pad($r, 4, '0', STR_PAD_LEFT)."<hr>";exit;
        return 'REF/'.date('Y').'/'.str_pad($r, 4, '0', STR_PAD_LEFT);
        //echo $ref;exit;
    }
}
