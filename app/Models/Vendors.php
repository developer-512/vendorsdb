<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendors extends Model
{
    use HasFactory;
    protected $table = 'vendors';
    protected $fillable = ['counter',  'category',
        'contact_name',  'keywords','brands','website',  'first_name',
        'last_name',  'date',  'company_name',
        'email',  'job_title',  'business_phone',
        'mobile_phone_1',  'mobile_phone_2',
        'address',  'city',  'zip_code',  'country',
        'approval',  'active',  'data_by_user' ];

    public function _category(){
        return $this->hasOne(Category::class, 'id','category');
    }
    public function categories(){
        return $this->hasOne(Category::class, 'id','category');
    }
    public function _user(){
        return $this->hasOne(User::class, 'id','data_by_user');
    }
    public function parent_category(){

    }


}
