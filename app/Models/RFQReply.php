<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class RFQReply extends Model
{
    use HasFactory;
    use HasTrixRichText;
    protected $table = 'rfq_replies';
    protected $fillable = [
        'subject', 'body', 'attachments','reply_by','rfq_id'];

//    public function getBodyAttribute($value)
//    {
//        return str_replace('APP_URL',env('APP_URL'),$value);
//    }
//    public function setBodyAttribute($value)
//    {
//        return str_replace(env('APP_URL'),'APP_URL',$value);
//    }
    public function rfq(){
        return $this->hasOne(RFQ::class, 'id','rfq_id');
    }
//    public function _user(){
//        return $this->hasOne(User::class, 'id','user');
//    }
}
