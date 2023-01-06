<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['category_name','category_details','parent'];

//    public function parent(){
//        return $this->hasMany(__CLASS__,'parent');
//    }
    public function get_parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent');
    }

    public function get_children()
    {
        return $this->hasMany(__CLASS__, 'parent');
    }
}
