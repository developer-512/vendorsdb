<?php

namespace App\Http\Controllers;


use App\Imports\VendorsImport;
use App\Models\Category;
use App\Models\User;
use App\Models\Vendors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Exports\VendorsExport;
use Maatwebsite\Excel\Facades\Excel;
use Form;
use DB;
use PDF;
class VendorsController extends Controller
{
    
     public function __construct()
    {
        $user_ids=User::all()->pluck('id');
        $user_admin= User::whereHas(
                        'roles', function($q){
                            $q->where('name', 'Admin');
                        }
                    )->first();
//        $vendors=Vendors::whereNotIn('data_by_user',[$user_ids])->update(['data_by_user' => $user_admin->id]);
//         $rfqs=DB::table('rfq')->whereNotIn('user',[$user_ids])->update(['user' => $user_admin->id]);
    }
    public function dashboard(){
        $total_cat=Category::count();
        $total_v=Vendors::count();
        return view('dashboard',compact('total_cat','total_v'));
    }
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['categories_array']=$this->category_sorting();
        $data['users_array']=User::all()->pluck('name','id');
//        if(isset($request->q)){
//            $vendors=$this->searchAll($request->q);
//        }elseif (isset($request->date1)||isset($request->date2)){
//            $vendors=$this->dateSearch($request);
//        }else{
//            $where=array();
//            if(isset($request->user_f)){
//                $where['data_by_user']=$request->user_f;
//            }if(isset($request->category_f)){
//                $where['category']=$request->category_f;
//            }
//            $vendors = Vendors::where($where)->orderBy('id','desc')->paginate(20);
//        }
        if(isset($request->ajax_list)){
            $vendor_d=Vendors::find($request->vendors_id);
            $vendors_ajax=array();
            if($vendor_d){
                $vendors=Vendors::where('company_name','=',$vendor_d->company_name)->get();
                foreach ($vendors as $vendor){
                    //$vendors_ajax[]=array('id'=>$vendor->email,'text'=>$vendor->contact_name.' - '.$vendor->email);
                    $vendors_ajax[$vendor->email]=(empty($vendor->contact_name)?$vendor->first_name.' '.$vendor->last_name:$vendor->contact_name).' - '.$vendor->email;
                }
            }
            echo Form::select('vendor_emails[]', $vendors_ajax,null, ['class' => 'form-control','multiple'=>'true']);
            exit;//return response()->json($vendors_ajax);
        }
        $data['search_query']=$search_query=$request->q;
        $sort_r=explode('-',$request->sort);
        $sort=isset($sort_r[0])&&$sort_r[0]!=''?$sort_r[0]:'id';
        $sort_type=isset($sort_r[1])&&$sort_r[1]!=''?$sort_r[1]:'desc';
        $data['vendors']=$this->search($request);
        if($request->sorting){
            if($sort_type=='desc'){
                $sort_type='asc';
            }else{
                $sort_type='desc';
            }
        }

        $sort .= '-' . $sort_type;
        $data['sort']=$sort;
        $data['sort_type']=$sort_type;
        return view('vendors.index', $data);
    }
    private function search($request){
            $vendors=Vendors::query();
        $sort_r=explode('-',$request->sort);
        $sort=isset($sort_r[0])&&$sort_r[0]!=''?$sort_r[0]:'id';
        $sort_type=isset($sort_r[1])&&$sort_r[1]!=''?$sort_r[1]:'desc';

        $special_sort=true;
        if($sort=='category'){
////            $sort='_category_category_name';
//            $with_Array=['categories'=>function ($query) use ($sort_type) {
//                $query->orderBy('category_name', $sort_type);
//            }];

        }else{
//            $with_Array=['categories'];
            $special_sort=false;
        }
//        $vendors->withAggregate('_category','category_name');
//        $vendors->with($with_Array);
        if (isset($request->date1)||isset($request->date2)){
            $vendors->whereBetween('created_at', array(new \DateTime($request->get('date1')), new \DateTime($request->get('date2').' +1 day')));
        }
        if(isset($request->user_f)){
            $vendors->where('data_by_user','=',$request->user_f);
        }
        if(isset($request->category_f)){
            $categorys=Category::where('id','=',$request->category_f)->first();
            if($categorys->parent!=0){
                $vendors->where('category','=',$request->category_f);
            }else{
                $vendors->whereIn('category',$categorys->get_children->pluck('id'));
            }
        }
        if(isset($request->q)){
            $search_value=$request->q;
            $vendors->where('contact_name','like', '%'. $search_value.'%'); // Get all data of the class

            // $search_value = $request->q; // searchstring/'contact_name',
            $columns = array(
                'keywords','website',  'first_name',
                'last_name',  'date',  'company_name',
                'email',  'job_title',  'business_phone',
                'mobile_phone_1',  'mobile_phone_2',
                'address',  'city',  'zip_code',  'country',
            ); // could also be used like $columns = ['test', 'test2'];
            foreach ($columns as $column) {
                $results = $vendors->orWhere($column,'like', '%'. $search_value.'%');
            }
        }
        if($special_sort===false) {
            $vendors->orderBy($sort, $sort_type);
        }else{
            if($sort_type=='desc'){
                $vendors->orderByDesc(Category::select('categories.category_name')->whereColumn('categories.id', 'vendors.category')->latest()->take(1));
            }else{
                $vendors->orderBy(Category::select('categories.category_name')->whereColumn('categories.id', 'vendors.category')->oldest()->take(1));
            }
        }
//        echo $sort;
//        echo $vendors->toSql();
//        dd($vendors->getBindings());
//        dd($vendors->paginate(20));
        return $vendors->paginate(20);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories_array']=$this->category_sorting();
        $data['countries']=$this->countries();
        return view('vendors.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->merge([
            'date' => date('Y-m-d'),
            'approval'=>'0',
            'active'=>'0',
            'data_by_user'=>auth()->id(),
            'contact_name'=>(empty($request->contact_name)?$request->first_name.' '.$request->last_name:$request->contact_name)
        ]);
        $validated = $request->validate([
//            'category' => ['required'],
//            'company_name' => ['required'],
//            'mobile_phone_1' => ['required'],
//            'address' => ['required'],
//            'city' => ['required'],
//            'country' => ['required'],
            'counter' => ['nullable','integer'],
            'category' => ['required','integer'],
            'contact_name' => ['nullable','string','max:255'],
            'keywords' => ['nullable','string','max:255'],
            'brands' => ['nullable','string','max:255'],
            'website' => ['nullable','string','max:255'],
            'first_name' => ['nullable','string','max:255'],
            'last_name' => ['nullable','string','max:255'],
            'date' => ['nullable'],
            'company_name' => ['required','string','max:255'],
            'email' => ['nullable','string','unique:vendors','max:255'],
            'job_title' => ['nullable','string','max:255'],
            'business_phone' => ['nullable','string','max:255'],
            'mobile_phone_1' => ['required','string','unique:vendors','max:255'],
            'mobile_phone_2' => ['nullable','string','max:255'],
            'address' => ['required','string'],
            'city' => ['required','string','max:255'],
            'zip_code' => ['nullable','string','max:255'],
            'country' => ['required','string','max:255'],
            'approval' => ['nullable','string','max:255'],
            'active' => ['nullable','string','max:255'],
            'data_by_user' => ['nullable','integer']

            ]);
        Vendors::create($validated);
        return redirect()->route('vendors.index')->with('info','Vendor Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Vendors $vendor)
    {
        return view('vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendors  $vendors
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Vendors $vendor)
    {
        $data['vendor']=$vendor;
        $data['categories_array']=$this->category_sorting();
        $data['countries']=$this->countries();
        return view('vendors.edit',$data);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendors  $vendors
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Vendors $vendor)
    {
        $request->merge([
            'contact_name'=>(empty($request->contact_name)?$request->first_name.' '.$request->last_name:$request->contact_name)
        ]);
        $validated = $request->validate([
//            'category' => ['required'],
//            'company_name' => ['required'],
//            'mobile_phone_1' => ['required'],
//            'address' => ['required'],
//            'city' => ['required'],
//            'country' => ['required'],
            'counter' => ['nullable','integer'],
            'category' => ['required','integer'],
            'contact_name' => ['nullable','string','max:255'],
            'keywords' => ['nullable','string','max:255'],
            'brands' => ['nullable','string','max:255'],
            'website' => ['nullable','string','max:255'],
            'first_name' => ['nullable','string','max:255'],
            'last_name' => ['nullable','string','max:255'],
            'date' => ['nullable'],
            'company_name' => ['required','string','max:255'],
            'email' => ['nullable','string',Rule::unique('vendors')->ignore($vendor->id),'max:255'],
            'job_title' => ['nullable','string','max:255'],
            'business_phone' => ['nullable','string','max:255'],
            'mobile_phone_1' => ['required','string',Rule::unique('vendors')->ignore($vendor->id),'max:255'],
            'mobile_phone_2' => ['nullable','string','max:255'],
            'address' => ['required','string'],
            'city' => ['required','string','max:255'],
            'zip_code' => ['nullable','string','max:255'],
            'country' => ['required','string','max:255'],
            'approval' => ['nullable','string','max:255'],
            'active' => ['nullable','string','max:255'],
            'data_by_user' => ['nullable','integer']

        ]);
        $vendor->update($validated);
//        Vendors::create($validated);
        return redirect()->route('vendors.index')->with('info','Vendor Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendors  $vendors
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Vendors $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendors.index')->with('error','Vendor Deleted');
    }
    public function massDestroy(Request $request){
//        exit;
        $output='';
        $success=false;
        if($request->del_vals){

            $del_vals=explode(',',$request->del_vals);
            $output= Vendors::whereIn('id',$del_vals)->delete();
        }
        return redirect()->route('vendors.index')->with('error','Vendors Deleted Successfully');
    }
    public function exportexcel(){

        return Excel::download(new VendorsExport, 'vendors_export-'.time().'.xlsx');
    }
    public function vendors_pdf($IDs){
        $vendors=Vendors::whereIn('id',$IDs)->get();
//        return view('pdf.vendors', compact('vendors'));
        //PDF::setOptions(['defaultPaperSize' => 'a4', 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('pdf.vendors', compact('vendors'));
        $pdf_name='Vendors-Export_-_'.time().'.pdf';
        $pdf_path='public/files/'.Auth::id().'/RFQ/'.$pdf_name;
        return $pdf->stream($pdf_name);
        Storage::put($pdf_path, $pdf->output());
        //$pdf->save('/storage/files/'.$pdf_name);
        Storage::delete(str_replace('storage','public',$data->pdf_link));
        return str_replace('public','storage',$pdf_path);
    }
    public function massExport(Request $request){
        $ids=[];
        if($request->export_vals) {
            $ids = explode(',', $request->export_vals);
        }
        if(count($ids)<=0){
            $vendors=Vendors::query();
            $search_exist=false;
            if(isset($request->export_cat)){
               $search_exist=true;
                $categorys=Category::where('id','=',$request->export_cat)->first();
                if($categorys->parent!=0){
                    $vendors->where('category','=',$request->export_cat);
                }else{
                    $vendors->whereIn('category',$categorys->get_children->pluck('id'));
                }
            }
            if (isset($request->date1)||isset($request->date2)){
                $search_exist=true;
                $vendors->whereBetween('created_at', array(new \DateTime($request->get('date1')), new \DateTime($request->get('date2').' +1 day')));
            }
            if(isset($request->export_user)){
                $search_exist=true;
                $vendors->where('data_by_user','=',$request->export_user);
            }

            if(isset($request->q)){
                $search_exist=true;
                $search_value=$request->q;
                $vendors->where('contact_name','like', '%'. $search_value.'%'); // Get all data of the class

                // $search_value = $request->q; // searchstring/'contact_name',
                $columns = array(
                    'keywords','website',  'first_name',
                    'last_name',  'date',  'company_name',
                    'email',  'job_title',  'business_phone',
                    'mobile_phone_1',  'mobile_phone_2',
                    'address',  'city',  'zip_code',  'country',
                ); // could also be used like $columns = ['test', 'test2'];
                foreach ($columns as $column) {
                    $results = $vendors->orWhere($column,'like', '%'. $search_value.'%');
                }
            }
                if($search_exist){

                    $ids=$vendors->pluck('id')->toArray();
                }
//                dd($ids);
        }


        if(count($ids)>0){
            if(isset($request->pdf_export)&&$request->pdf_export==1){
                return $this->vendors_pdf($ids);
            }
            return (new VendorsExport)->Ids($ids)->download('vendors_export-'.time().'.xlsx');
        }
        return back()->with('error','No Vendors Found');
//        return Excel::download(new VendorsExport, 'vendors_export-'.time().'.xlsx');
    }
    public function importExcel(Request $request){
        try {
            Excel::import(new VendorsImport,$request->import_file);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            $errors=$e->getMessage();
//            $failures = $e->failures();
//            $errors='';
//            foreach ($failures as $failure) {
//               $errors.='Error Details:<br>Row:'. $failure->row(); // row that went wrong
//                $errors.='<br>Heading:'.$failure->attribute(); // either heading key (if using heading row concern) or column index
//                $errors.='<br>Detail:'. $failure->errors(); // Actual error messages from Laravel validator
//                $errors.='<br>Value:'. $failure->values(); // The values of the row that has failed.
//                $errors.='<hr>';
//            }
            if($errors==''){
                $errors='import failed';
            }
            return redirect()->back()->with('error', $errors);
        }

        //Session::put('success', 'Your file is imported successfully in database.');

        return redirect()->back()->with('info', 'Your file is imported successfully in database.');
    }
    public function active_approval(Request $request){
        Vendors::where('id','=',$request->id)->update([
            $request->ctype=>$request->cvalue
        ]);
        echo 'Success';
    }
    private function category_sorting(): array
    {
        $categories_array=array();
        $categories=Category::where('parent','=',0)->get();
        foreach ($categories as $category){
            $categories_array[$category->id]=$category->category_name;
            $sub_categories=Category::where('parent','=',$category->id)->get();
            if($sub_categories){
                foreach ($sub_categories as $sub_category) {
                    $categories_array[$sub_category->id]='&nbsp;&nbsp;&nbsp;'.$sub_category->category_name;
                }
            }
        }
        return $categories_array;
    }

    private function countries(){
        return array("Afghanistan"=>"Afghanistan","Albania"=>"Albania","Algeria"=>"Algeria","American Samoa"=>"American Samoa","Andorra"=>"Andorra","Angola"=>"Angola","Anguilla"=>"Anguilla","Antarctica"=>"Antarctica","Antigua and Barbuda"=>"Antigua and Barbuda","Argentina"=>"Argentina","Armenia"=>"Armenia","Aruba"=>"Aruba","Australia"=>"Australia","Austria"=>"Austria","Azerbaijan"=>"Azerbaijan","Bahamas"=>"Bahamas","Bahrain"=>"Bahrain","Bangladesh"=>"Bangladesh","Barbados"=>"Barbados","Belarus"=>"Belarus","Belgium"=>"Belgium","Belize"=>"Belize","Benin"=>"Benin","Bermuda"=>"Bermuda","Bhutan"=>"Bhutan","Bolivia"=>"Bolivia","Bosnia and Herzegovina"=>"Bosnia and Herzegovina","Botswana"=>"Botswana","Bouvet Island"=>"Bouvet Island","Brazil"=>"Brazil","British Antarctic Territory"=>"British Antarctic Territory","British Indian Ocean Territory"=>"British Indian Ocean Territory","British Virgin Islands"=>"British Virgin Islands","Brunei"=>"Brunei","Bulgaria"=>"Bulgaria","Burkina Faso"=>"Burkina Faso","Burundi"=>"Burundi","Cambodia"=>"Cambodia","Cameroon"=>"Cameroon","Canada"=>"Canada","Canton and Enderbury Islands"=>"Canton and Enderbury Islands","Cape Verde"=>"Cape Verde","Cayman Islands"=>"Cayman Islands","Central African Republic"=>"Central African Republic","Chad"=>"Chad","Chile"=>"Chile","China"=>"China","Christmas Island"=>"Christmas Island","Cocos [Keeling] Islands"=>"Cocos [Keeling] Islands","Colombia"=>"Colombia","Comoros"=>"Comoros","Congo - Brazzaville"=>"Congo - Brazzaville","Congo - Kinshasa"=>"Congo - Kinshasa","Cook Islands"=>"Cook Islands","Costa Rica"=>"Costa Rica","Croatia"=>"Croatia","Cuba"=>"Cuba","Cyprus"=>"Cyprus","Czech Republic"=>"Czech Republic","Côte d’Ivoire"=>"Côte d’Ivoire","Denmark"=>"Denmark","Djibouti"=>"Djibouti","Dominica"=>"Dominica","Dominican Republic"=>"Dominican Republic","Dronning Maud Land"=>"Dronning Maud Land","East Germany"=>"East Germany","Ecuador"=>"Ecuador","Egypt"=>"Egypt","El Salvador"=>"El Salvador","Equatorial Guinea"=>"Equatorial Guinea","Eritrea"=>"Eritrea","Estonia"=>"Estonia","Ethiopia"=>"Ethiopia","Falkland Islands"=>"Falkland Islands","Faroe Islands"=>"Faroe Islands","Fiji"=>"Fiji","Finland"=>"Finland","France"=>"France","French Guiana"=>"French Guiana","French Polynesia"=>"French Polynesia","French Southern Territories"=>"French Southern Territories","French Southern and Antarctic Territories"=>"French Southern and Antarctic Territories","Gabon"=>"Gabon","Gambia"=>"Gambia","Georgia"=>"Georgia","Germany"=>"Germany","Ghana"=>"Ghana","Gibraltar"=>"Gibraltar","Greece"=>"Greece","Greenland"=>"Greenland","Grenada"=>"Grenada","Guadeloupe"=>"Guadeloupe","Guam"=>"Guam","Guatemala"=>"Guatemala","Guernsey"=>"Guernsey","Guinea"=>"Guinea","Guinea-Bissau"=>"Guinea-Bissau","Guyana"=>"Guyana","Haiti"=>"Haiti","Heard Island and McDonald Islands"=>"Heard Island and McDonald Islands","Honduras"=>"Honduras","Hong Kong SAR China"=>"Hong Kong SAR China","Hungary"=>"Hungary","Iceland"=>"Iceland","India"=>"India","Indonesia"=>"Indonesia","Iran"=>"Iran","Iraq"=>"Iraq","Ireland"=>"Ireland","Isle of Man"=>"Isle of Man","Israel"=>"Israel","Italy"=>"Italy","Jamaica"=>"Jamaica","Japan"=>"Japan","Jersey"=>"Jersey","Johnston Island"=>"Johnston Island","Jordan"=>"Jordan","Kazakhstan"=>"Kazakhstan","Kenya"=>"Kenya","Kiribati"=>"Kiribati","Kuwait"=>"Kuwait","Kyrgyzstan"=>"Kyrgyzstan","Laos"=>"Laos","Latvia"=>"Latvia","Lebanon"=>"Lebanon","Lesotho"=>"Lesotho","Liberia"=>"Liberia","Libya"=>"Libya","Liechtenstein"=>"Liechtenstein","Lithuania"=>"Lithuania","Luxembourg"=>"Luxembourg","Macau SAR China"=>"Macau SAR China","Macedonia"=>"Macedonia","Madagascar"=>"Madagascar","Malawi"=>"Malawi","Malaysia"=>"Malaysia","Maldives"=>"Maldives","Mali"=>"Mali","Malta"=>"Malta","Marshall Islands"=>"Marshall Islands","Martinique"=>"Martinique","Mauritania"=>"Mauritania","Mauritius"=>"Mauritius","Mayotte"=>"Mayotte","Metropolitan France"=>"Metropolitan France","Mexico"=>"Mexico","Micronesia"=>"Micronesia","Midway Islands"=>"Midway Islands","Moldova"=>"Moldova","Monaco"=>"Monaco","Mongolia"=>"Mongolia","Montenegro"=>"Montenegro","Montserrat"=>"Montserrat","Morocco"=>"Morocco","Mozambique"=>"Mozambique","Myanmar [Burma]"=>"Myanmar [Burma]","Namibia"=>"Namibia","Nauru"=>"Nauru","Nepal"=>"Nepal","Netherlands"=>"Netherlands","Netherlands Antilles"=>"Netherlands Antilles","Neutral Zone"=>"Neutral Zone","New Caledonia"=>"New Caledonia","New Zealand"=>"New Zealand","Nicaragua"=>"Nicaragua","Niger"=>"Niger","Nigeria"=>"Nigeria","Niue"=>"Niue","Norfolk Island"=>"Norfolk Island","North Korea"=>"North Korea","North Vietnam"=>"North Vietnam","Northern Mariana Islands"=>"Northern Mariana Islands","Norway"=>"Norway","Oman"=>"Oman","Pacific Islands Trust Territory"=>"Pacific Islands Trust Territory","Pakistan"=>"Pakistan","Palau"=>"Palau","Palestinian Territories"=>"Palestinian Territories","Panama"=>"Panama","Panama Canal Zone"=>"Panama Canal Zone","Papua New Guinea"=>"Papua New Guinea","Paraguay"=>"Paraguay","People's Democratic Republic of Yemen"=>"People's Democratic Republic of Yemen","Peru"=>"Peru","Philippines"=>"Philippines","Pitcairn Islands"=>"Pitcairn Islands","Poland"=>"Poland","Portugal"=>"Portugal","Puerto Rico"=>"Puerto Rico","Qatar"=>"Qatar","Romania"=>"Romania","Russia"=>"Russia","Rwanda"=>"Rwanda","Réunion"=>"Réunion","Saint Barthélemy"=>"Saint Barthélemy","Saint Helena"=>"Saint Helena","Saint Kitts and Nevis"=>"Saint Kitts and Nevis","Saint Lucia"=>"Saint Lucia","Saint Martin"=>"Saint Martin","Saint Pierre and Miquelon"=>"Saint Pierre and Miquelon","Saint Vincent and the Grenadines"=>"Saint Vincent and the Grenadines","Samoa"=>"Samoa","San Marino"=>"San Marino","Saudi Arabia"=>"Saudi Arabia","Senegal"=>"Senegal","Serbia"=>"Serbia","Serbia and Montenegro"=>"Serbia and Montenegro","Seychelles"=>"Seychelles","Sierra Leone"=>"Sierra Leone","Singapore"=>"Singapore","Slovakia"=>"Slovakia","Slovenia"=>"Slovenia","Solomon Islands"=>"Solomon Islands","Somalia"=>"Somalia","South Africa"=>"South Africa","South Georgia and the South Sandwich Islands"=>"South Georgia and the South Sandwich Islands","South Korea"=>"South Korea","Spain"=>"Spain","Sri Lanka"=>"Sri Lanka","Sudan"=>"Sudan","Suriname"=>"Suriname","Svalbard and Jan Mayen"=>"Svalbard and Jan Mayen","Swaziland"=>"Swaziland","Sweden"=>"Sweden","Switzerland"=>"Switzerland","Syria"=>"Syria","São Tomé and Príncipe"=>"São Tomé and Príncipe","Taiwan"=>"Taiwan","Tajikistan"=>"Tajikistan","Tanzania"=>"Tanzania","Thailand"=>"Thailand","Timor-Leste"=>"Timor-Leste","Togo"=>"Togo","Tokelau"=>"Tokelau","Tonga"=>"Tonga","Trinidad and Tobago"=>"Trinidad and Tobago","Tunisia"=>"Tunisia","Turkey"=>"Turkey","Turkmenistan"=>"Turkmenistan","Turks and Caicos Islands"=>"Turks and Caicos Islands","Tuvalu"=>"Tuvalu","U.S. Minor Outlying Islands"=>"U.S. Minor Outlying Islands","U.S. Miscellaneous Pacific Islands"=>"U.S. Miscellaneous Pacific Islands","U.S. Virgin Islands"=>"U.S. Virgin Islands","Uganda"=>"Uganda","Ukraine"=>"Ukraine","Union of Soviet Socialist Republics"=>"Union of Soviet Socialist Republics","United Arab Emirates"=>"United Arab Emirates","United Kingdom"=>"United Kingdom","United States"=>"United States","Unknown or Invalid Region"=>"Unknown or Invalid Region","Uruguay"=>"Uruguay","Uzbekistan"=>"Uzbekistan","Vanuatu"=>"Vanuatu","Vatican City"=>"Vatican City","Venezuela"=>"Venezuela","Vietnam"=>"Vietnam","Wake Island"=>"Wake Island","Wallis and Futuna"=>"Wallis and Futuna","Western Sahara"=>"Western Sahara","Yemen"=>"Yemen","Zambia"=>"Zambia","Zimbabwe"=>"Zimbabwe","Åland Islands"=>"Åland Islands");
    }
    private function searchAll($search_value){
        $query = Vendors::where('contact_name','like', '%'. $search_value.'%'); // Get all data of the class

       // $search_value = $request->q; // searchstring/'contact_name',
        $columns = array(
              'keywords','website',  'first_name',
            'last_name',  'date',  'company_name',
            'email',  'job_title',  'business_phone',
            'mobile_phone_1',  'mobile_phone_2',
            'address',  'city',  'zip_code',  'country',
            ); // could also be used like $columns = ['test', 'test2'];
        foreach ($columns as $column) {
            $results = $query->orWhere($column,'like', '%'. $search_value.'%');
        }

        return $query->paginate(20);
    }
    private function dateSearch($request){
        return Vendors::whereBetween('created_at', array(new \DateTime($request->get('date1')), new \DateTime($request->get('date2').' +1 day')))
            ->paginate(20);
    }
}
