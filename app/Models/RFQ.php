<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class RFQ extends Model
{
    use HasFactory;
    use HasTrixRichText;
    protected $table = 'rfq';
    protected $fillable = ['ref', 'project_name', 'project_code', 'pr_no', 'c_logo','attachments', 'package', 'vendor', 'subject', 'body', 'user', 'user_details', 'date','pdf_link','emails','vendor_emails'];

//    public function getBodyAttribute($value)
//    {
//        return str_replace('APP_URL',env('APP_URL'),$value);
//    }
//    public function setBodyAttribute($value)
//    {
//        return str_replace(env('APP_URL'),'APP_URL',$value);
//    }
    public function _vendor(){
        return $this->hasOne(Vendors::class, 'id','vendor');
    }
    public function _user(){
        return $this->hasOne(User::class, 'id','user');
    }
    public function reply(){
        return $this->hasMany(RFQReply::class);
    }
}
