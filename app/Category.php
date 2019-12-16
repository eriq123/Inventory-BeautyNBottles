<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public $timestamps = false;
    
    public function item()
    {
        return $this->hasMany('App\Item', 'category_id', 'id');
    }

    public function sub_category()
    {
        return $this->hasMany('App\Sub_Category', 'category_id', 'id');
    }

}
