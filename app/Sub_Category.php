<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_Category extends Model
{
    protected $table = 'sub_categories';

    public $timestamps = false;
    

    // dynamic dropdown
    public static function sub_category($id){
        return Sub_Category::where('category_id','=', $id)->get();
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function item()
    {
        return $this->hasMany('App\Item', 'sub_category_id', 'id');
    }

}
