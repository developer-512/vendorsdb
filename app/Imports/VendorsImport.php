<?php

namespace App\Imports;
use App\Models\Category;
use App\Models\Vendors;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class VendorsImport implements ToModel,WithHeadingRow, WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (Vendors::where('mobile_phone_1','=',$row['mobile_phone_1'])->count()>0) {
            return null;
        }
        if(trim($row['category'])!=''){
            $category = Category::firstOrCreate(
                ['category_name' =>  $row['category']],
            );
        }
        if(trim($row['sub_category'])!=''){
            $subcategory = Category::firstOrNew(['category_name' =>  $row['sub_category']]);

            $subcategory->parent = $category->id;

            $subcategory->save();
        }
        $cat=(isset($subcategory->id)?$subcategory->id:(isset($category->id)?$category->id:0));
            return new Vendors([
                'counter'=>$row['counter'],
                'category'=>$cat,
                'contact_name'=>$row['contact_name'],
                'keywords'=>$row['keywords'],
                'website'=>$row['website'],
                'first_name'=>$row['first_name'],
                'last_name'=>$row['last_name'],
                'date'=>date('Y-m-d'),
                'company_name'=>$row['company_name'],
                'email'=>$row['email'],
                'job_title'=>$row['job_title'],
                'business_phone'=>$row['business_phone'],
                'mobile_phone_1'=>$row['mobile_phone_1'],
                'mobile_phone_2'=>$row['mobile_phone_2'],
                'address'=>$row['address'],
                'city'=>$row['city'],
                'zip_code'=>$row['zip_code'],
                'country'=>$row['country'],
                'approval'=>(trim($row['approval'])=='Approved'?1:0),
                'active'=>(trim($row['active'])=='Active'?1:0),
                'data_by_user'=>auth()->id()
         ]);

    }

    public function uniqueBy()
    {
        return 'email';
    }
}
